<?php

namespace App\Http\Controllers\Auth;

use System\Auth\Auth;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    protected $roles = ['master'];
    protected $redirectToLogin = "/login";
    protected $redirectToApp = "/home";
    protected $redirectToAdmin = "/dashboard";

    protected function checkAndRedirectByRole()
    {
        if (Auth::checkLogin()) {
            if (in_array(Auth::member()->role, $this->roles)) {
                return redirect($this->redirectToAdmin);
            } else {
                return redirect($this->redirectToApp);
            }
        }
    }
}
