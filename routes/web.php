<?php

use System\Router\Web\Route;

//Admin
Route::get('/dashboard', 'Admin\AdminController@dashboard', 'admin.dashboard');
// Admin Category Routes
Route::get('/admin/categories', 'Admin\CategoryController@index', 'admin.categories.index');
Route::get('/admin/categories/show/{slug}', 'Admin\CategoryController@show', 'admin.categories.show');
Route::get('/admin/categories/create', 'Admin\CategoryController@create', 'admin.categories.create');
Route::post('/admin/categories/store', 'Admin\CategoryController@store', 'admin.categories.store');
Route::get('/admin/categories/edit/{slug}', 'Admin\CategoryController@edit', 'admin.categories.edit');
Route::put('/admin/categories/update/{slug}', 'Admin\CategoryController@update', 'admin.categories.update');
Route::delete('/admin/categories/delete/{slug}', 'Admin\CategoryController@destroy', 'admin.categories.delete');
Route::put('/admin/categories/publish/{slug}', 'Admin\CategoryController@publish', 'admin.categories.publish');
// Admin members Routes
Route::get('/admin/members', 'Admin\MemberController@index', 'admin.members.index');
Route::get('/admin/members/create', 'Admin\MemberController@create', 'admin.members.create');
Route::post('/admin/members/store', 'Admin\MemberController@store', 'admin.members.store');
Route::get('/admin/members/show/{username}', 'Admin\MemberController@show', 'admin.members.show');
Route::get('/admin/members/edit/{username}', 'Admin\MemberController@edit', 'admin.members.edit');
Route::put('/admin/members/update/{username}', 'Admin\MemberController@update', 'admin.members.update');
Route::delete('/admin/members/delete/{username}', 'Admin\MemberController@destroy', 'admin.members.delete');
Route::put('/admin/members/change-status/{username}', 'Admin\MemberController@changeStatus', 'admin.members.change.status');
// Admin posts routes
Route::get('/admin/posts', 'Admin\PostController@index', 'admin.posts.index');
Route::get('/admin/posts/show/{slug}', 'Admin\PostController@show', 'admin.posts.show');
Route::get('/admin/posts/create', 'Admin\PostController@create', 'admin.posts.create');
Route::post('/admin/posts/store', 'Admin\PostController@store', 'admin.posts.store');
Route::get('/admin/posts/edit/{slug}', 'Admin\PostController@edit', 'admin.posts.edit');
Route::put('/admin/posts/update/{slug}', 'Admin\PostController@update', 'admin.posts.update');
Route::delete('/admin/posts/delete/{slug}', 'Admin\PostController@destroy', 'admin.posts.delete');
Route::put('/admin/posts/publish/{slug}', 'Admin\PostController@publish', 'admin.posts.publish');
Route::put('/admin/posts/choice/{slug}', 'Admin\PostController@choice', 'admin.posts.choice');
Route::get('admin/posts/attachments/{slug}', 'Admin\PostController@attachments', 'admin.posts.attachments');
// Admin Account Settings
Route::get('/admin/account', 'Admin\AccountController@profile', 'admin.account');
Route::put('/admin/account/update/{username}', 'Admin\AccountController@update', 'admin.account.update');
Route::get('/admin/account/change_password', 'Admin\AccountController@password', 'admin.account.password');
Route::put('/admin/account/set_password/{username}', 'Admin\AccountController@set_password', 'admin.account.set.password');
//Auth routes
Route::get('/login', 'Auth\LoginController@view', 'auth.login.view');
// Route::post('/login', 'Auth\LoginController@login', 'auth.login');
Route::get('/activation/{verify_token}', 'Auth\LoginController@activation', 'auth.activation');
Route::get('/logout', 'Auth\LogoutController@logout', 'auth.logout');
Route::get('/forget', 'Auth\ForgetController@view', 'auth.forget.view');
Route::post('/forget', 'Auth\ForgetController@forget', 'auth.forget');
Route::get('/reset-password/{forget_token}', 'Auth\ResetPasswordController@view', 'auth.reset-password.view');
Route::post('/reset-password/{forget_token}', 'Auth\ResetPasswordController@resetPassword', 'auth.reset-password');
// App Routes
Route::get('', 'App\HomeController@index', 'home.index');
Route::get('/', 'App\HomeController@index', 'home.index');
Route::get('/home', 'App\HomeController@index', 'home.index');
Route::get('/categories', 'App\HomeController@categories', 'home.categories');
Route::get('/categories/{slug}', 'App\HomeController@category', 'home.category');
Route::get('/posts', 'App\HomeController@posts', 'home.posts');
Route::get('/posts/{slug}', 'App\HomeController@post', 'home.post');
Route::get('/posts/attachments/{slug}', 'App\HomeController@attachments', 'home.posts.attachments');
