<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ForgetRequest;
use App\Http\Services\MailService;
use App\Member;
use System\Config\Config;
use System\Session\Session;

class ForgetController extends AuthController
{
    public function __construct()
    {
        $this->checkAndRedirectByRole();
    }

    public function view()
    {
        return view('auth.forget');
    }

    public function forget()
    {
        if (Session::get('forget.time') != false && Session::get('forget.time') > time()) {
            error('forget', 'please wait 2 min and try again');
            return back();
        } else {
            Session::set('forget.time', time() + 120);
            $request = new ForgetRequest();
            $inputs = $request->all();
            $member = Member::where('email', $inputs['email'])->get();
            if (empty($member)) {
                error('forget', 'User not found');
                return back();
            }
            $member = $member[0];
            $forget_token = generateToken();
            $forget_token_expiry = date("Y-m-d H:i:s", strtotime(' + 10 min'));
            Member::update(['id' => $member->id, 'forget_token' => $forget_token, 'forget_token_expiry' => $forget_token_expiry]);


            $message = '
                    <h2>' . Config::get('app.APP_TITLE') . ' Member Account Forget Link</h2>
                    <p style="text-transform:capitalize;">Please Click Below For Set New Password  </p>
                    <p style="text-transform:capitalize;">
                        <a href="' . route('auth.reset-password.view', ['forget_token' => $forget_token]) . '">Set New Password</a>
                    </p> 
                    ';
            $mailService = new MailService();
            $mailService->send($inputs['email'], 'Set New Password At ' . Config::get('app.APP_TITLE'), $message);
            flash('forget', 'Please Check Your Email');
            return back();
        }
    }
}
