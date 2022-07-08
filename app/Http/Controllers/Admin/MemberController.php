<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use App\Http\Requests\Admin\MemberRequest;
use App\Http\Services\FileUpload;
use App\Http\Services\MailService;
use System\Config\Config;

class MemberController extends AdminController
{

    public function index()
    {
        $members = Member::all();
        $totalMembersCount = count(Member::total());
        $activedMembersCount = Member::where('status', '=', '1')->count();
        $deactivedMembersCount = Member::where('status', '=', '0')->count();
        $deletedMembersCount = Member::whereNull('deleted_at')->count();
        $deletedMembersCount = $totalMembersCount - $deletedMembersCount;
        return view('admin.member.index', compact('members', 'totalMembersCount', 'activedMembersCount', 'deactivedMembersCount', 'deletedMembersCount'));
    }
    public function create()
    {
        return view('admin.member.create');
    }
    public function store()
    {
        $request = new MemberRequest();
        $inputs = $request->all();
        $path = 'admin-assets/assets/images/members/' . $inputs['username'];
        $name = date('Y_m_d_H_i_s_') . rand(10, 99);
        $inputs['avatar'] = FileUpload::UploadAndFitImage($request->file('avatar'), $path, $name, 640, 640);
        $inputs['status'] = 0;
        $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        $inputs['verify_token'] = generateToken();
        $inputs['verify_token_expiry'] = date("Y-m-d H:i:s", strtotime(' + 10 min'));
        Member::create($inputs);
        $message =
            '<h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p style="text-transform:capitalize;">' . $inputs['role'] . ' Account Was Successfully Created For You At ' . Config::get('app.BASE_URL') . '</p>
            <p style="text-transform:capitalize;"> please click below for account activation </p>
            <a href="' . route('auth.activation', ['verify_token' => $inputs['verify_token']]) . '">Click Here For Account Activation</a>';
        $mailService = new MailService();
        $mailService->send($inputs['email'], Config::get('app.APP_TITLE') . ' Account Registeration & Activation', $message);
        return redirect('admin/members');
    }
    public function show($username)
    {
        $member = Member::findBySlug($username);
        return view('admin.member.show', compact('member'));
    }
    public function edit($username)
    {
        $member = Member::findBySlug($username);
        return view('admin.member.edit', compact('member'));
    }
    public function update($username)
    {
        $request = new MemberRequest();
        $inputs = $request->all();
        $member = Member::findBySlug($username);
        $inputs['id'] = $member->id;
        $file = $request->file('avatar');
        if ($inputs['role'] === "") {
            unset($inputs['role']);
        }
        if (!empty($file['tmp_name'])) {
            FileUpload::removeFile($member->avatar);
            $path = 'admin-assets/assets/images/members/' . $member->username;
            $name = date('Y_m_d_H_i_s_') . rand(10, 99);
            $inputs['avatar'] = FileUpload::UploadAndFitImage($request->file('avatar'), $path, $name, 640, 640);
        }
        Member::update($inputs);
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p style="text-transform:capitalize;">Your ' . $member->role . ' Account Was Successfully Edited On ' . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Account Edition', $message);
        return redirect('admin/members');
    }
    public function destroy($username)
    {
        $member = Member::findBySlug($username);
        Member::deleteBySlug($username);
        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p style="text-transform:capitalize;">Your ' . $member->role . ' Account Was Successfully Deleted On ' . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Account Deletion', $message);
        return back();
    }
    public function changeStatus($username)
    {
        $member = Member::findBySlug($username);
        if ($member->status == 0) {
            $member = Member::update(['id' => $member->id, 'status' => 1, 'actived_at' => date('Y-m-d H:i:s')]);
        } else {
            $member = Member::update(['id' => $member->id, 'status' => 0, 'actived_at' => ""]);
        }

        $message = '
            <h2>Hello From ' . Config::get('app.APP_TITLE') . '</h2>
            <p style="text-transform:capitalize;">Your Emlpoyee Activation Status Was Successfully Updated On ' . Config::get('app.BASE_URL') . '</p>';
        $mailService = new MailService();
        $mailService->send($member->email, Config::get('app.APP_TITLE') . ' Account Status Changed', $message);

        return back();
    }
}
