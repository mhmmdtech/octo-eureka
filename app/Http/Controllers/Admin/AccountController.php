<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ChangePasswordRequest;
use System\Auth\Auth;
use App\Http\Services\MailService;
use App\Member;
use System\Config\Config;

class AccountController extends AdminController
{

    public function profile()
    {
        $member = Auth::member();
        return view('admin.account.profile', compact('member'));
    }

    public function update($slug)
    {
        dd('It Will Be Updated Soon');
    }

    public function password()
    {
        $member = Auth::member();
        return view('admin.account.change-password', compact('member'));
    }
    public function set_password($slug)
    {
        $request = new ChangePasswordRequest();
        $inputs = $request->all();
        $member = Auth::member();
        if (password_verify($request->password, $member->password)) {
            error('password', 'Old password is same as new password');
            return back();
        }
        $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        $inputs['id'] = $member->id;
        Member::update($inputs);
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p>Your Password Was Successfully Changed On ' . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Account Edition', $message);
        return redirect('dashboard');
    }
}
