<?php

namespace System\Auth;

use App\Member;
use System\Session\Session;


class Auth
{

    private $redirectTo = "/login";

    private function memberMethod()
    {
        if (!Session::get('member')) {
            return redirect($this->redirectTo);
        }
        $member = Member::find(Session::get('member'));
        if (empty($member)) {
            Session::remove('member');
            return redirect($this->redirectTo);
        } else
            return $member;
    }

    private function checkMethod()
    {
        if (!Session::get('member')) {
            return redirect($this->redirectTo);
        }
        $member = Member::find(Session::get('member'));
        if (empty($member)) {
            Session::remove('member');
            return redirect($this->redirectTo);
        } else
            return true;
    }

    private function checkLoginMethod()
    {
        if (!Session::get('member')) {
            return false;
        }
        $member = Member::find(Session::get('member'));
        if (empty($member)) {
            return false;
        } else
            return true;
    }

    private function loginByEmailMethod($email, $password)
    {
        $member = Member::where('email', $email)->get();
        if (empty($member)) {
            error('login', 'User not found');
            return false;
        }
        if (password_verify($password, $member[0]->password) && $member[0]->status == 1) {
            Session::set("member", $member[0]->id);
            return true;
        } else {
            error("login", 'Password is incorrect');
            return false;
        }
    }
    private function loginByUsernameMethod($username, $password)
    {
        $member = Member::where('username', $username)->get();
        if (empty($member)) {
            error('login', 'User not found');
            return false;
        }
        if (password_verify($password, $member[0]->password) && $member[0]->status == 1) {
            Session::set("member", $member[0]->id);
            return true;
        } else {
            error("login", 'Something Isn\'t Correct');
            return false;
        }
    }

    private function loginByIdMethod($id)
    {
        $member = Member::find($id);
        if (empty($member)) {
            error("login", "User not found");
            return false;
        } else {
            Session::set("member", $member->id);
            return true;
        }
    }

    private function logoutMethod()
    {
        Session::remove('member');
    }

    public function __call($name, $arguments)
    {
        return $this->methodCaller($name, $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return $instance->methodCaller($name, $arguments);
    }

    private function methodCaller($method, $arguments)
    {
        $suffix = 'Method';
        $methodName = $method . $suffix;
        return call_user_func_array(array($this, $methodName), $arguments);
    }
}
