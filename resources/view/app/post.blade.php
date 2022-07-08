@extends('app.layouts.app')

@section('head-tags')
<meta
   name="description"
   content="Rich and authoritative source of information from the world of bodybuilding"
 />
 <meta name="robots" content="NOINDEX,NOFOLLOW" />
 <title>Reliable Source In The World Of Bodybuilding | LegendBody</title>
@endsection

@section('css-tags')
<link rel="stylesheet" href="<?= asset('app-assets/css/print.css') ?>">
@endsection

@section('script-tags')
<script defer src="<?= asset('app-assets/js/components/print.js') ?>"></script>
@endsection

@section('content')
        <article class="post__wrapper d-flex flex-column mg-1 align-self-center" >
         
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
@endsection
