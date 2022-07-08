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
          <h3 class="dashboard__title dark-color font-weight-600 font-size-2">Post</h3>
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
            href="<?= route('admin.posts.edit', ['slug' => $post->slug]) ?>"
            class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer mg-right-1 dark-bg light-color dark-shadow"
            >
              Edit Post
            </a>
            <a
            href="<?= route('admin.posts.index') ?>"
            class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
            >
              Back To Posts
            </a>
          </div>
        </header>
        <div
          class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
        >
          <article class="post__wrapper d-flex flex-column mg-1">
           <?php foreach ($post->attachments() as $attachment) {?>
              <a href="<?= route('admin.posts.attachments', ['slug' => $attachment->name])  ?>">Download</a>
            <?php } ?>
            <figure class="post__cover dark-shadow radius-rounded-small">
              <img
              src="<?= asset($post->thumbnail()->small) ?>"
              class="w-100 h-100 fit-cover"
              alt=""
            />
            </figure>
            <div
              class="post__content font-weight-600 font-size-1 pd-1 dark-color"
            >
              <h1 class="post__title font-size-2 dark-color"><?= $post->title ?></h1>
              <h2 class="post__subtitle font-size-1">
                <?= $post->description ?>
              </h2>
              <p class="post__text">
                <?= html_entity_decode($post->body) ?>
              </p>
             
            </div>
          </article>
        </div>
@endsection
