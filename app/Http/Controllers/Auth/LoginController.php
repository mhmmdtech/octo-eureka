<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\Auth\LoginRequest;
use App\Member;
use System\Auth\Auth;

class LoginController extends AuthController
{

    public function __construct()
    {
        $this->checkAndRedirectByRole();
    }

    public function view()
    {
        return view("auth.login");
    }

    public function login()
    {
        $request = new LoginRequest();
        $inputs = $request->all();
        if (Auth::loginByUsername($inputs['username'], $inputs['password'])) {
            $employee = Member::where('username', $inputs['username'])->get();
            $employee = $employee[0];
            if (in_array(Auth::member()->role, $this->roles)) {
                return redirect($this->redirectToAdmin);
            } else {
                return redirect($this->redirectToApp);
            }
        } else {
            return back();
        }
    }

    public function activation($verify_token)
    {
        $member = Member::where('verify_token', $verify_token)->where('verify_token_expiry', '>=', date('Y-m-d H:i:s'))->get();
        $result = [];
        if (empty($member)) {
            $result = ['status' => 'error', 'message' => 'Your token is invalid or expired'];
            return view("auth.activated_account", compact('result'));
        }
        $member = $member[0];
        Member::update(['id' => $member->id, 'status' => 1]);
        $result = ['status' => 'success', 'message' => 'Your Member account has been activated'];
        return view("auth.activated_account", compact('result'));
    }
}
