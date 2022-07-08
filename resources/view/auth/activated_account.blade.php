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
@endsection

@section('content')
    <header
      class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1"
    >
      <h3 class="dashboard__title dark-color font-size-2 font-weight-600">
        Members Activated Account
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
      <?php if ($result['status'] === "success") {?>
        <p class="success-color font-size-2 text-capitalize font-weight-600"><?= $result['message'] ?></p>
      <?php } elseif ($result['status'] === "error") { ?>
        <p class="danger-color font-size-2 text-capitalize font-weight-600"><?= $result['message'] ?></p>
      <?php } ?>
    </main>
@endsection
