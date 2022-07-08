@extends('admin.layouts.app')

@section('head-tags')
<meta
   name="description"
   content="Rich and authoritative source of information from the world of bodybuilding"
 />
 <meta name="robots" content="NOINDEX,NOFOLLOW" />
 <title>Reliable Source In The World Of Bodybuilding | LegendBody</title>
@endsection

@section('css-tags')
<link rel="stylesheet" href="<?= asset('admin-assets/css/print.css') ?>">
@endsection

@section('script-tags')
<script defer src="<?= asset('admin-assets/js/components/print.js') ?>"></script>
@endsection

@section('content') 
        <header
          class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1 mg-top-1 not-printed"
        >
          <h3 class="dashboard__title font-weight-600 font-size-2 dark-color">Member</h3>
          <div
            class="dashboard__action-btns d-flex flex-wrap justify-content-center flex-grow-1 mg-left-auto"
          >
            <button
            type="button"
            id="print-button"
            class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer mg-right-1 dark-bg light-color dark-shadow"
            >
              Print
            </button>
            <a
            href="<?= route('admin.members.edit', ['username' => $member->username]) ?>"
            class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer mg-right-1 dark-bg light-color dark-shadow"
            >
              Edit Member
            </a>
            <a
            href="<?= route('admin.members.index') ?>"
              class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
            >
              Back To Members
            </a>
          </div>
        </header>
        <section
          class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
        >
          <div
            class="member-panel d-flex flex-column align-items-center flex-shrink-1 mg-1 pd-1 radius-rounded-small primary-bg dark-shadow"
          >
            <div
              class="user-giant-avatar flex-shrink-1 primary-bg dark-shadow radius-circle"
            >
              <img
              src="<?= asset($member->avatar) ?>"
              alt=""
              />
            </div>
            <h1
              class="dark-color member-panel__name font-weight-600 mg-top-1 text-center font-size-2"
            >
              <?= $member->fullname() ?>
            </h1>
            <ul
              class="member-panel__info-wrapper mg-0 font-weight-600 list-style-none font-size-1 pd-horizontal-1"
            >
              <li class="pd-vertical-1">Username: <?= $member->username ?></li>
              <li class="pd-vertical-1">Role: <?= $member->role ?></li>
              <li class="pd-vertical-1">Email: <?= $member->email ?></li>
              <li class="pd-vertical-1">Registered At: <?= date("Y M d", strtotime($member->created_at)) ?></li>
            </ul>
          </div>
        </section>
@endsection
