<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Services\FileDownload;
use App\Http\Services\FileUpload;
use App\Http\Services\MailService;
use App\Post_Attachment;
use App\Post_Thumbnail;
use System\Auth\Auth;
use System\Config\Config;

class PostController extends AdminController
{

    public function index()
    {
        $posts = Post::all();
        $totalPostsCount = count(Post::total());
        $publishedPostsCount = Post::where('is_published', '=', '1')->count();
        $suspendedPostsCount = Post::where('is_published', '=', '0')->count();
        $deletedPostsCount = Post::whereNull('deleted_at')->count();
        $deletedPostsCount = $totalPostsCount - $deletedPostsCount;
        return view('admin.post.index', compact('posts', 'totalPostsCount', 'publishedPostsCount', 'suspendedPostsCount', 'deletedPostsCount'));
    }


    public function show($slug)
    {
        $post = Post::findBySlug($slug);
        return view('admin.post.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    public function store()
    {
        $request = new PostRequest();
        $inputs = $request->all();
        $inputs['slug'] = slugify($request->title);
        $inputs['author_id'] = Auth::member()->id;
        $inputs['is_published'] = 0;
        $post =  Post::create($inputs);

        $file = $request->file('thumbnail');
        $path = 'admin-assets/assets/images/posts/' . $post->slug . "/" . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10, 99);
        $largeWide = FileUpload::UploadAndFitImage($file, $path, 'large_wide_' . $name, 1920, 1080);
        $mediumWide = FileUpload::UploadAndFitImage($file, $path, 'medium_wide_' . $name, 1280, 720);
        $smallWide = FileUpload::UploadAndFitImage($file, $path, 'small_wide_' . $name, 800, 450);
        $lastInsertId = $post->id;
        $thumbnails = [
            'post_id' => $lastInsertId,
            'small' => $smallWide,
            'medium' => $mediumWide,
            'large' => $largeWide,
        ];
        Post_Thumbnail::create($thumbnails);

        $attachments = $request->file('attachments');
        if (!empty($attachments['name'][0])) {
            $attachments = reArrayFiles($attachments);
            $path = 'admin-assets/assets/attachments/posts/' . $post->slug . "/" . date('Y/M/d');
            foreach ($attachments as $attachment) {
                $name = $post->slug . '_' . date('Y_m_d_H_i_s_') . rand(10, 99);
                $attachmentPath =  FileUpload::uploadFile($attachment, $path, $name);
                $attachmentResultArray = [
                    'post_id' => $lastInsertId,
                    'name' => $name,
                    'path' => $attachmentPath,
                    'type' => $attachment['type'],
                    'size' => $attachment['size'],
                ];
                Post_Attachment::create($attachmentResultArray);
            }
        }

        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Create ' . $post->title . " Post On " . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Post Creation', $message);


        return redirect('admin/posts');
    }

    public function edit($slug)
    {
        $post = Post::findBySlug($slug);
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update($slug)
    {
        $request = new PostRequest();
        $inputs = $request->all();
        $post = Post::findBySlug($slug);
        $inputs['id'] = $post->id;
        if ($post->slug !== slugify($inputs['title'])) {
            $inputs['slug'] = slugify($inputs['title']);
            rename(__DIR__ . '/../../../../public/admin-assets/assets/images/posts/' . $post->slug, __DIR__ . '/../../../../public/admin-assets/assets/images/posts/' . $inputs['slug']);
        }
        $post = Post::update($inputs);

        $file = $request->file('thumbnail');
        if (!empty($file['tmp_name'])) {
            FileUpload::removeFile($post->thumbnail()->small);
            FileUpload::removeFile($post->thumbnail()->medium);
            FileUpload::removeFile($post->thumbnail()->large);
            $path = 'admin-assets/assets/images/posts/' . $post->slug . "/" . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10, 99);
            $largeWide = FileUpload::UploadAndFitImage($file, $path, 'large_wide_' . $name, 1920, 1080);
            $mediumWide = FileUpload::UploadAndFitImage($file, $path, 'medium_wide_' . $name, 1280, 720);
            $smallWide = FileUpload::UploadAndFitImage($file, $path, 'small_wide_' . $name, 800, 450);
            $thumbnails = [
                'id' => $post->thumbnail()->id,
                'post_id' => $post->id,
                'small' => $smallWide,
                'medium' => $mediumWide,
                'large' => $largeWide,
            ];
            Post_Thumbnail::update($thumbnails);
        }

        $attachments = $request->file('attachments');
        if (!empty($attachments['name'][0])) {
            $attachments = reArrayFiles($attachments);
            $path = 'admin-assets/assets/attachments/posts/' . $post->slug . "/" . date('Y/M/d');
            foreach ($attachments as $attachment) {
                $name = $post->slug . '_' . date('Y_m_d_H_i_s_') . rand(10, 99);
                $attachmentPath =  FileUpload::uploadFile($attachment, $path, $name);
                $attachmentResultArray = [
                    'post_id' => $post->id,
                    'name' => $name,
                    'path' => $attachmentPath,
                    'type' => $attachment['type'],
                    'size' => $attachment['size'],
                ];
                Post_Attachment::create($attachmentResultArray);
            }
        }

        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Edit ' . $post->title . " Post On " . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Post Edition', $message);



        return redirect('admin/posts');
    }

    public function destroy($slug)
    {
        Post::deleteBySlug($slug);
        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Delete  Post On ' . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Post Deletion', $message);

        return back();
    }

    public function publish($slug)
    {
        $post = Post::findBySlug($slug);
        if ($post->is_published == 0) {
            Post::update(['id' => $post->id, 'is_published' => 1]);
        } else {
            Post::update(['id' => $post->id, 'is_published' => 0]);
        }

        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Change ' . $post->title . " Status On " . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Post Edition', $message);


        return back();
    }
    public function choice($slug)
    {
        $post = Post::findBySlug($slug);
        if ($post->is_choiced == 0) {
            Post::update(['id' => $post->id, 'is_choiced' => 1]);
        } else {
            Post::update(['id' => $post->id, 'is_choiced' => 0]);
        }

        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Change ' . $post->title . " Choice Status On " . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Post Edition', $message);


        return back();
    }
    public function attachments($slug)
    {
        $attachment = Post_Attachment::findBySlug($slug);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $attachment->path)) {
            FileDownload::download($attachment->path);
        } else {
            return redirect('admin/posts');
        }
    }
}
