@extends('auth.layouts.app')

@section('head-tags')
<meta
   name="description"
   content="Rich and authoritative source of information from the world of bodybuilding"
 />
 <meta name="robots" content="NOINDEX,NOFOLLOW" />
 <title>Reliable Source In The World Of Bodybuilding | LegendBody</title>
@endsection

@section('script-tags')
  <script defer src="<?= asset('auth-assets/js/pages/MembersLoginHandler.js') ?>"></script>
  <script defer src="<?= asset('auth-assets/js/components/PasswordHandler.js') ?>"></script>
@endsection

@section('content')
    <header
      class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1"
    >
      <h3 class="dashboard__title dark-color font-size-2 font-weight-600">
        Members Login Page
      </h3>
      <div
        class="dashboard__action-btns mg-left-auto flex-grow-1 d-flex flex-wrap justify-content-center"
      >
        <a
          href="<?= route('home.index') ?>"
          class="dashboard__action-btn outline-none-attention font-weight-600 radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
        >
          Back To Home Page
        </a>
      </div>
    </header>
    <main
      class="web-main w-100 d-flex align-items-center justify-content-center"
    >
      <div
        class="auth-form__card d-flex flex-column flex-grow-1 border-1px border-gray primary-bg dark-shadow radius-rounded-small pd-1"
      >
        <div class="auth-form__result text-center <?= errorClass('login') ?>">
          <span class="danger-color font-size-1 font-weight-600">
            <?php if (errorExists('login')) {?>
              <?php foreach (allErrors() as $error) { ?>
                <?= $error ?>
              <?php } ?>
            <?php } else{ ?>
              <?= "&nbsp" ?>
            <?php } ?>
          </span>
        </div>
        <form
          id="members-login-form"
          autocomplete="off"
          autocapitalize="off"
          autocorrect="off"
          class="auth-form__form d-flex flex-wrap font-weight-600 w-100"
          novalidate
          spellcheck="false"
          role="form"
          aria-label="LegendBody Members Login Form"
          action="<?= route('auth.login') ?>"
          method="post"
        >
          <div class="auth-form__input-group d-flex flex-wrap w-100">
            <label
              class="auth-form__label d-block font-size-1 pd-left-1 dark-color"
              for="username"
              id="usernameLabel"
              >Username</label
            >
            <input
              type="text"
              name="username"
              id="username"
              placeholder="Write Username"
              class="auth-form__input outline-none-attention w-100 border-1px border-gray dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
              aria-labelledby="usernameLabel"
              value="<?= old('username') ?>"
              />
            <div
              class="auth-form__error font-size-1 pd-left-1 danger-color <?= errorClass('username') ?>"
            >
              <span class="primary-color--dark"><?= errorText('username') ?></span>
            </div>
          </div>
          <div class="auth-form__input-group d-flex pos-relative flex-wrap w-100 mg-top-1">
            <label
              class="auth-form__label d-block font-size-1 pd-left-1 dark-color"
              for="password"
              id="passwordLabel"
              >Password</label
            >
            <input
              type="password"
              name="password"
              id="password"
              data-type="password"
              placeholder="Write Password"
              class="auth-form__input outline-none-attention w-100 border-1px border-gray dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
              aria-labelledby="passwordLabel"
              value="<?= old('password') ?>"
              />
              <button
              type="button"
              data-password-toggler
              class="auth-form__password-toggler pos-absolute border-none cursor-pointer outline-none-attention"
              data-action="toggle"
              data-status="hide"
            >
              <svg data-status="closed-eye" class="d-none dark-fill">
                <use
                  xlink:href="<?= asset('auth-assets/assets/icons/auth-sprite.svg#closed-eye') ?>"
                ></use>
              </svg>
              <svg data-status="opened-eye" class="dark-fill">
                <use
                xlink:href="<?= asset('auth-assets/assets/icons/auth-sprite.svg#opened-eye') ?>"
                ></use>
              </svg>
            </button>
            <div
              class="auth-form__error font-size-1 pd-left-1 danger-color <?= errorClass('password') ?>"
            >
              <span class="primary-color--dark"><?= errorText('password') ?></span>
            </div>
          </div>
          <div class="auth-form__input-group d-flex flex-wrap w-100 mg-top-1">
            <button
              type="submit"
              id="submit-btn"
              class="auth-form__submit outline-none-attention font-size-1 pd-1 mg-horizontal-auto dark-bg light-color dark-shadow radius-rounded-small dark-border-1px cursor-pointer"
            >
              Submit
            </button>
          </div>
          <div class="auth-form__input-group d-flex flex-wrap w-100 mg-top-1">
            <a
              href="<?= route("auth.forget.view") ?>"
              class="dark-color font-size-1 auth-form__forget-link pos-relative d-block text-center mg-horizontal-auto"
            >
              I Forget My Information</a
            >
          </div>
        </form>
      </div>
    </main>
@endsection
