<?php

namespace App\Http\Controllers\App;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Services\FileDownload;
use App\Post;
use App\Post_Attachment;
use App\Post_View;
use System\Database\DBBuilder\DBBuilder;


class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::whereNull('parent_id')->where('is_published', 1)->get();
        $choicedPosts = Post::where('is_published', 1)->where('is_choiced', 1)->orderBy('created_at', 'desc')->limit(0, 4)->get();
        $lastPosts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->limit(0, 6)->get();
        $hotPosts = Post::where('is_published', 1)->orderBy('views', 'desc')->limit(0, 4)->get();
        return view("app.index", compact('categories', 'choicedPosts', 'lastPosts', 'hotPosts'));
    }
    public function categories()
    {
        $parentCategories = Category::whereNull('parent_id')->where('is_published', 1)->get();
        $subCategories = Category::whereNotNull('parent_id')->where('is_published', 1)->get();
        return view("app.categories", compact('parentCategories', 'subCategories'));
    }
    public function posts()
    {
        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->get();
        return view("app.posts", compact('posts'));
    }
    public function category($slug)
    {
        $category = Category::findBySlug($slug);
        $subCategories = Category::where('parent_id', $category->id)->where('is_published', 1)->get();;
        $posts = Post::where('category_id', $category->id)->where('is_published', 1)->get();
        return view("app.category", compact('category', 'subCategories', 'posts'));
    }

    public function post($slug)
    {
        $post = Post::findBySlug($slug);
        $userVisited = Post_View::where('post_id', $post->id)->where('visitor_detector', getMacAddress())->get();
        $visitor_detector = getMacAddress() !== "" ? getMacAddress() : "unknown";
        if (empty($userVisited) || $userVisited[0]->visitor_detector === 'unknown') {
            $postViewDetails = [
                'post_id' => $post->id,
                'visitor_detector' => $visitor_detector,
            ];
            Post_View::create($postViewDetails);
            Post::update(['id' => $post->id, 'views' => $post->views + 1]);
        }
        return view("app.post", compact('post'));
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
