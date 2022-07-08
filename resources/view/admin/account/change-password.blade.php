@extends('admin.layouts.app')

@section('head-tags')
<meta
   name="description"
   content="Rich and authoritative source of information from the world of bodybuilding"
 />
 <meta name="robots" content="NOINDEX,NOFOLLOW" />
 <title>Reliable Source In The World Of Bodybuilding | LegendBody</title>
@endsection

@section('script-tags')
<script defer src="<?= asset('admin-assets/js/utilities/FormHandler.js') ?>"></script>
<script defer src="<?= asset('admin-assets/js/pages/SettingAccountForm.js') ?>"></script>
@endsection

@section('content')
        <header
          class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1 mg-top-1"
        >
          <h3 class="dashboard__title font-weight-600 font-size-2 dark-color">Change Password</h3>
          <div
            class="dashboard__action-btns d-flex flex-wrap justify-content-center flex-grow-1 mg-left-auto"
          >
            <a
            href="<?= route('admin.dashboard') ?>"
              class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
            >
              Back To Dashboard
            </a>
          </div>
        </header>
        <div
          class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
        >
          <form
            id="setting-account-form"
            autocomplete="off"
            autocapitalize="off"
            class="dashboard-form w-100 font-weight-600 d-flex flex-wrap justify-content-space-evenly pd-bottom-1"
            novalidate
            action="<?= route('admin.account.set.password', ['username' => $member->username]) ?>" 
            method="post" 
            enctype="multipart/form-data"
          >
          <input type="hidden" name="_method" value="put">
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="password"
                >Password</label
              >
              <input
                type="password"
                name="password"
                id="password"
                autocomplete="off"
                placeholder="Write Category Password"
                class="dashboard-form__input w-100 border-1px outline-none-attention dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
              />
              <div
                class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('password') ?>"
              >
                <span class="primary-color--dark"><?= errorText('password') ?></span>
              </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="confirm_password"
                >Password Confirmation</label
              >
              <input
                type="password"
                name="confirm_password"
                id="confirm_password"
                autocomplete="off"
                placeholder="Write Category Password Confirmation"
                class="dashboard-form__input w-100 border-1px outline-none-attention dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
              />
              <div
                class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('confirm_password') ?>"
              >
                <span class="primary-color--dark"><?= errorText('confirm_password') ?></span>
              </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1 full-width"
            >
              <button
                type="submit"
                id="submit-btn"
                class="dashboard-form__submit outline-none-attention font-size-1 pd-1 mg-horizontal-auto dark-bg light-color dark-shadow radius-rounded-small dark-border-1px cursor-pointer"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
@endsection
