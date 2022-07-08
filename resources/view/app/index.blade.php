@extends('app.layouts.app')

@section('head-tags')
<meta
   name="description"
   content="Rich and authoritative source of information from the world of bodybuilding"
 />
 <meta name="robots" content="NOINDEX,NOFOLLOW" />
 <title>Reliable Source In The World Of Bodybuilding | LegendBody</title>
@endsection

@section('script-tags')
<script defer src="<?= asset('app-assets/js/components/HomeHero.js') ?>"></script>
<script defer src="<?= asset('app-assets/js/components/CategoryCards.js') ?>"></script>
@endsection

@section('content')
        <?php if (!empty($choicedPosts)) { ?>
        <section class="home-hero__wrapper">
          <h3 class="d-block dark-color font-size-3 pd-left-1 font-weight-600">
            Editor's Choice
          </h3>
          <div class="home-hero w-100 pd-1">
          <?php foreach($choicedPosts as $choicedPost) {?>
            <a
              href="<?= route('home.post', ['slug' => $choicedPost->slug]) ?>"
              class="d-block home-hero__item radius-rounded-small primary-bg dark-shadow"
            >
              <figure class="home-hero__cover w-100 h-100 pos-relative">
                <img
                  src="<?= asset($choicedPost->thumbnail()->small) ?>"
                  class="w-100 h-100 fit-cover"
                  alt=""
                />
                <figcaption
                  class="light-color font-size-2 pd-2 w-100 pos-absolute bottom-0 left-0 text-capitalize"
                >
                  <?= $choicedPost->title ?>
                </figcaption>
                <div
                  class="home-hero__overlay w-100 h-100 pos-absolute top-0 left-0 radius-rounded-small"
                ></div>
              </figure>
            </a>  
          <?php } ?>
          </div>
        </section>
        <?php } ?>
        <?php if (!empty($categories)) { ?>
        <section class="category-cards__wrapper overflow-hidden">
          <h3 class="d-block dark-color font-size-3 pd-left-1 font-weight-600">
            Categories
          </h3>
          <div class="category-cards pd-1 card-column">
          <?php foreach($categories as $category) {?>
            <a
              href="<?= route('home.category', ['slug' => $category->slug]) ?>"
              class="category-cards__item w-100 pos-relative justify-self-center primary-bg dark-shadow radius-rounded-small"
            >
              <figure class="category-cards__cover w-100 h-100 pos-relative">
                <img
                  src="<?= asset($category->thumbnail()->small) ?>"
                  class="w-100 h-100 fit-cover"
                  alt=""
                />
              </figure>
              <div
                class="category-cards__content light-color pd-1 w-100 h-100 pos-absolute top-0 left-0 d-flex flex-wrap align-content-end dark-solid-overlay"
              >
                <div class="pos-absolute top-0 left-0 primary-bg"></div>
                <h2 class="font-size-2 font-weight-600 flex-grow-1">
                  <?= $category->title ?>
                </h2>
                <p class="font-size-1 font-weight-600 flex-grow-1">
                  <?= $category->description ?>
                </p>
              </div>
            </a>
          <?php } ?>
          </div>
        </section>
        <?php } ?>
        <?php if (!empty($lastPosts)) { ?>
        <section class="blog-cards__wrapper">
          <h3 class="d-block dark-color font-size-3 pd-left-1 font-weight-600">
            Latest Posts
          </h3>
          <div class="blog-cards pd-1 card-column">
          <?php foreach($lastPosts as $latestPost) {?>
            <a
              href="<?= route('home.post', ['slug' => $latestPost->slug]) ?>"
              class="blog-cards__item w-100 d-flex flex-column justify-self-center align-self-stretch primary-bg dark-shadow radius-rounded-small"
            >
              <div class="blog-cards__cover radius-rounded-top-small">
                <img
                  src="<?= asset($latestPost->thumbnail()->small) ?>"
                  class="w-100 h-100 fit-cover"
                  alt=""
                />
              </div>
              <div
                class="blog-cards__content d-flex flex-column flex-grow-1 pd-1"
              >
                <div class="blog-cards__tags d-flex">
                  <span
                    class="blog-cards__tag align-self-start blog-cards__tag--background-color-blue light-color font-size-1 font-weight-500 radius-rounded-small text-capitalize"
                  >
                    Technology
                  </span>
                </div>
                <h4
                  class="blog-cards__title mg-top-1 dark-color font-size-2 font-weight-600 text-capitalize"
                >
                  <?= $latestPost->title ?>
                </h4>
                <p class="font-size-1 mg-top-1 dark-color font-weight-500">
                  <?= $latestPost->description ?>
                </p>
              </div>
              <div class="blog-cards__footer d-flex pd-1">
                <img
                  src="<?= asset($latestPost->author()->avatar) ?>"
                  alt="user__image"
                  class="blog-cards__user-avatar fit-cover radius-circle mg-right-1"
                />
                <div
                  class="blog-cards__user-info d-flex flex-column dark-color justify-content-space-evenly"
                >
                  <h5
                    class="font-size-1 font-weight-600 mg-0 pd-0 text-capitalize"
                  >
                    <?= $latestPost->author()->username ?>
                  </h5>
                  <span class="font-size-1 font-weight-500"><?= date("Y M d", strtotime($latestPost->created_at)) ?></span>
                </div>
              </div>
            </a>
          <?php } ?>
          </div>
        </section>
        <?php } ?>
@endsection

