<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use System\Auth\Auth;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Services\FileUpload;
use App\Category_Thumbnail;
use App\Http\Services\MailService;
use System\Config\Config;

class CategoryController extends AdminController
{

    public function index()
    {
        $categories = Category::all();
        $totalCategoriesCount = count(Category::total());
        $publishedCategoriesCount = Category::where('is_published', '=', '1')->count();
        $suspendedCategoriesCount = Category::where('is_published', '=', '0')->count();
        $deletedCategoriesCount = Category::whereNull('deleted_at')->count();
        $deletedCategoriesCount = $totalCategoriesCount - $deletedCategoriesCount;
        return view('admin.category.index', compact('categories', 'totalCategoriesCount', 'publishedCategoriesCount', 'suspendedCategoriesCount', 'deletedCategoriesCount'));
    }

    public function show($slug)
    {
        $category = Category::findBySlug($slug);
        return view('admin.category.show', compact('category'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.create', compact('categories'));
    }

    public function store()
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        if (empty($request->parent_id)) unset($inputs['parent_id']);
        $inputs['slug'] = slugify($request->title);
        $inputs['is_published'] = 0;
        $inputs['author_id'] = Auth::member()->id;
        $category = Category::create($inputs);

        $file = $request->file('thumbnail');
        $path = 'admin-assets/assets/images/categories/' . $category->slug . "/" . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10, 99);
        $largeTall = FileUpload::UploadAndFitImage($file, $path, 'large_tall_' . $name, 1080, 1920);
        $mediumTall = FileUpload::UploadAndFitImage($file, $path, 'medium_tall_' . $name, 920, 1220);
        $smallTall = FileUpload::UploadAndFitImage($file, $path, 'small_tall_' . $name, 600, 800);
        $lastInsertId = $category->id;
        $thumbnails = [
            'category_id' => $lastInsertId,
            'small' => $smallTall,
            'medium' => $mediumTall,
            'large' => $largeTall,
        ];
        Category_Thumbnail::create($thumbnails);

        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Create ' . $category->title . " Category On " . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Category Creation', $message);

        return redirect('admin/categories');
    }

    public function edit($slug)
    {
        $category = Category::findBySlug($slug);
        $categories = Category::whereNull('parent_id')->get();
        foreach ($categories as $key => $value) {
            if ($value->id == $category->id) {
                unset($categories[$key]);
            }
        }
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update($slug)
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        $category = Category::findBySlug($slug);
        $inputs['id'] = $category->id;
        if ($category->slug !== slugify($inputs['title'])) {
            $inputs['slug'] = slugify($inputs['title']);
            rename(__DIR__ . '/../../../../public/admin-assets/assets/images/categories/' . $category->slug, __DIR__ . '/../../../../public/admin-assets/assets/images/categories/' . $inputs['slug']);
        }
        $category =  Category::update($inputs);

        $file = $request->file('thumbnail');
        if (!empty($file['tmp_name'])) {
            FileUpload::removeFile($category->thumbnail()->small);
            FileUpload::removeFile($category->thumbnail()->medium);
            FileUpload::removeFile($category->thumbnail()->large);
            $path = 'admin-assets/assets/images/categories/' . $category->slug . "/" . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10, 99);
            $largeTall = FileUpload::UploadAndFitImage($file, $path, 'large_tall_' . $name, 1080, 1920);
            $mediumTall = FileUpload::UploadAndFitImage($file, $path, 'medium_tall_' . $name, 920, 1220);
            $smallTall = FileUpload::UploadAndFitImage($file, $path, 'small_tall_' . $name, 600, 800);
            $thumbnails = [
                'id' => $category->thumbnail()->id,
                'category_id' => $category->id,
                'small' => $smallTall,
                'medium' => $mediumTall,
                'large' => $largeTall,
            ];
            Category_Thumbnail::update($thumbnails);
        }

        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Update ' . $category->title . " Category On " . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Category Edition', $message);

        return redirect('admin/categories');
    }
    public function destroy($slug)
    {
        Category::deleteBySlug($slug);
        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Delete Category On ' . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Category Deletion', $message);
        dd('d');
        return back();
    }
    public function publish($slug)
    {
        $category = Category::findBySlug($slug);
        if ($category->is_published == 0) {
            Category::update(['id' => $category->id, 'is_published' => 1]);
        } else {
            Category::update(['id' => $category->id, 'is_published' => 0]);
        }

        $member = Auth::member();
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>You Successfully Change ' . $category->title . " Category Status On " . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Category Edition', $message);
        return back();
    }
}
