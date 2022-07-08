<?php

namespace App\Http\Controllers\Auth;


use System\Auth\Auth;

class LogoutController extends AuthController
{

    public function logout()
    {
        Auth::logout();
        return redirect($this->redirectToApp);
    }
}
