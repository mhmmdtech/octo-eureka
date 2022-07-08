<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Services\MailService;
use App\Member;
use System\Config\Config;

class ResetPasswordController
{

    private $redirectToLogin = '/login';

    public function view($forget_token)
    {
        $member = Member::where('forget_token', $forget_token)->where('forget_token_expiry', '>=', date('Y-m-d H:i:s'))->get();
        if (empty($member)) {
            $result = ['status' => 'error', 'message' => 'Your token is invalid or expired'];
            return view("auth.activated_account", compact('result'));
        }
        $member = $member[0];
        return view('auth.reset_password', compact('forget_token'));
    }

    public function resetPassword($forget_token)
    {
        $request = new ResetPasswordRequest();
        $inputs = $request->all();
        $member = Member::where('forget_token', $forget_token)->where('forget_token_expiry', '>=', date('Y-m-d H:i:s'))->get();
        if (empty($member)) {
            error('reset_password', 'User not found');
            return back();
        }
        $member = $member[0];
        if (password_verify($request->password, $member->password)) {
            error('reset_password', 'Old password is same as new password');
            return back();
        }
        $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        $inputs['id'] = $member->id;
        Member::update($inputs);
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>Your Password Was Successfully Changed On ' . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Account Password Update', $message);
        return redirect($this->redirectToLogin);
    }
}
