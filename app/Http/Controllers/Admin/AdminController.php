<?php

namespace App\Http\Controllers\Admin;

use System\Auth\Auth;
use App\Http\Controllers\Controller;
use System\Database\DBBuilder\DBBuilder;
use App\Category;
use App\Member;
use App\Post;


class AdminController extends Controller
{
    private $roles = ['master'];
    private $redirectToLogin = "/login";
    public function __construct()
    {
        Auth::check();
        if (Auth::member()->status == 0) {
            Auth::logout();
            return redirect($this->redirectToLogin);
        } elseif (!in_array(Auth::member()->role, $this->roles)) {
            Auth::logout();
            return redirect($this->redirectToLogin);
        }
    }

    public function dashboard()
    {
        $totalCategoriesCount = count(Category::total());
        $publishedCategoriesCount = Category::where('is_published', '=', '1')->count();
        $totalMembersCount = count(Member::total());
        $activedMembersCount = Member::where('status', '=', '1')->count();
        $totalPostsCount = count(Post::total());
        $publishedPostsCount = Post::where('is_published', '=', '1')->count();
        return view("admin.dashboard", compact('totalCategoriesCount', 'publishedCategoriesCount', 'totalMembersCount', 'activedMembersCount', 'totalPostsCount', 'publishedPostsCount'));
    }
}
