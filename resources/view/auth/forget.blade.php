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
  <script defer src="<?= asset('auth-assets/js/pages/MembersForgetHandler.js') ?>"></script>
@endsection

@section('content')
    <header
      class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1"
    >
      <h3 class="dashboard__title dark-color font-size-2 font-weight-600">
        Members Forget Information
      </h3>
      <div
        class="dashboard__action-btns mg-left-auto flex-grow-1 d-flex flex-wrap justify-content-center"
      >
        <a
          href="<?= route('auth.login.view') ?>"
          class="dashboard__action-btn outline-none-attention font-weight-600 radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
        >
          Back To Login Page
        </a>
      </div>
    </header>
    <main
      class="web-main w-100 d-flex align-items-center justify-content-center"
    >
      <div
        class="auth-form__card d-flex flex-column flex-grow-1 border-1px border-gray primary-bg dark-shadow radius-rounded-small pd-1"
      >
          <?php if (errorExists('forget')) {?>
          <div class="auth-form__result text-center <?= errorClass('forget') ?>">
            <?php foreach (allErrors() as $error) { ?>
              <span class="danger-color font-size-1 font-weight-600"><?= $error ?></span>
            <?php } ?>
          </div>
          <?php } elseif (flashExists('forget')) { ?>
          <div class="auth-form__result text-center <?= flashClass('forget') ?>">
            <?php foreach (allFlashes() as $flash) { ?>
              <span class="success-color font-size-1 font-weight-600"><?= $flash ?></span>
            <?php } ?>
          </div>
          <?php } else{ ?>
          <div class="auth-form__result text-center">
            <span class="dark-color font-size-1 font-weight-600">&nbsp;</span>
          </div>
          <?php } ?>
        <form
        id="members-forget-form"
        autocomplete="off"
        autocapitalize="off"
        autocorrect="off"
        class="auth-form__form d-flex flex-wrap font-weight-600 w-100"
        novalidate
        spellcheck="false"
        role="form"
        aria-label="LegendBody Members Forget Form"
        action="<?= route('auth.forget') ?>"
        method="post"
        >
          <div class="auth-form__input-group d-flex flex-wrap w-100">
            <label
              class="auth-form__label d-block font-size-1 pd-left-1 dark-color"
              for="email"
              id="emailLabel"
              >Email</label
            >
            <input
              type="text"
              name="email"
              id="email"
              placeholder="Write Email"
              class="auth-form__input outline-none-attention w-100 border-1px border-gray dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
              aria-labelledby="emailLabel"
              value="<?= old('email') ?>"
              />
              <div
              class="auth-form__error font-size-1 pd-left-1 danger-color <?= errorClass('email') ?>"
            >
              <span class="primary-color--dark"><?= errorText('email') ?></span>
            </div>
          </div>
          <div class="auth-form__input-group d-flex flex-wrap w-100 mg-top-1">
            <button
              type="submit"
              id="submit-btn"
              class="auth-form__submit outline-none-attention font-size-1 pd-1 mg-horizontal-auto dark-bg light-color dark-shadow radius-rounded-small dark-border-1px cursor-pointer"
            >
              Send
            </button>
          </div>
        </form>
      </div>
    </main>
@endsection
