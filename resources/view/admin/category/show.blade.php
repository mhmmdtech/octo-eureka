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
<h3 class="dashboard__title font-weight-600 font-size-2 dark-color">Category</h3>
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
  href="<?= route('admin.categories.edit', ['slug' => $category->slug]) ?>"
  class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer mg-right-1 dark-bg light-color dark-shadow"
  >
    Edit Category
  </a>
  <a
  href="<?= route('admin.categories.index') ?>"
    class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
  >
    Back To Categories
  </a>
</div>
</header>
<div
class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
>
<article class="post__wrapper d-flex flex-column mg-1">
  <figure class="post__cover dark-shadow radius-rounded-small">
    <img
    src="<?= asset($category->thumbnail()->small) ?>"
    alt=""
  />
  </figure>
  <div
    class="post__content font-weight-600 font-size-1 pd-1 dark-color"
  >
    <h1 class="post__title font-size-2 dark-color"><?= $category->title ?></h1>
    <h2 class="post__subtitle dark-color font-size-1">
      <?= $category->description ?>
    </h2>
  
  </div>
</article>
</div>
@endsection
