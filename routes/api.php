<?php

use System\Router\Api\Route;

// Route::get('', 'HomeController@index', 'index');
// Route::get('create', 'HomeController@create', 'create');
// Route::post('store', 'HomeController@store', 'store');
// Route::get('edit/{id}', 'HomeController@edit', 'edit');
Route::post('/login', 'Auth\LoginController@login', 'auth.login');
