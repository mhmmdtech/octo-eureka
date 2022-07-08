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
<script defer src="<?= asset('app-assets/js/components/CategoryCards.js') ?>"></script>
@endsection
@section('content')
        <?php if (!empty($subCategories)) { ?>
          <section class="category-cards__wrapper overflow-hidden">
            <h3 class="d-block dark-color font-size-3 pd-left-1 font-weight-600">
              SubCategories
            </h3>
            <div class="category-cards pd-1 card-column">
            <?php foreach($subCategories as $subCategory) {?>
              <a
                href="<?= route('home.category', ['slug' => $subCategory->slug]) ?>"
                class="category-cards__item w-100 pos-relative justify-self-center primary-bg dark-shadow radius-rounded-small"
              >
                <figure class="category-cards__cover w-100 h-100 pos-relative">
                  <img
                    src="<?= asset($subCategory->thumbnail()->small) ?>"
                    class="w-100 h-100 fit-cover"
                    alt=""
                  />
                </figure>
                <div
                  class="category-cards__content light-color pd-1 w-100 h-100 pos-absolute top-0 left-0 d-flex flex-wrap align-content-end dark-solid-overlay"
                >
                  <div class="pos-absolute top-0 left-0 primary-bg"></div>
                  <h2 class="font-size-2 font-weight-600 flex-grow-1">
                    <?= $subCategory->title ?>
                  </h2>
                  <p class="font-size-1 font-weight-600 flex-grow-1">
                    <?= $subCategory->description ?>
                  </p>
                </div>
              </a>
            <?php } ?>
            </div>
          </section>
        <?php } ?>
        <?php if (!empty($posts)) { ?>
          <section class="blog-cards__wrapper">
            <h3 class="d-block dark-color font-size-3 pd-left-1 font-weight-600">
              All Posts
            </h3>
            <div class="blog-cards pd-1 card-column">
            <?php foreach($posts as $post) {?>
              <a
                href="<?= route('home.post', ['slug' => $post->slug]) ?>"
                class="blog-cards__item w-100 d-flex flex-column justify-self-center align-self-stretch primary-bg dark-shadow radius-rounded-small"
              >
                <div class="blog-cards__cover radius-rounded-top-small">
                  <img
                    src="<?= asset($post->thumbnail()->small) ?>"
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
                    <?= $post->title ?>
                  </h4>
                  <p class="font-size-1 mg-top-1 dark-color font-weight-500">
                    <?= $post->description ?>
                  </p>
                </div>
                <div class="blog-cards__footer d-flex pd-1">
                  <img
                    src="<?= asset($post->author()->avatar) ?>"
                    alt="user__image"
                    class="blog-cards__user-avatar fit-cover radius-circle mg-right-1"
                  />
                  <div
                    class="blog-cards__user-info d-flex flex-column dark-color justify-content-space-evenly"
                  >
                    <h5
                      class="font-size-1 font-weight-600 mg-0 pd-0 text-capitalize"
                    >
                      <?= $post->author()->username ?>
                    </h5>
                    <span class="font-size-1 font-weight-500"><?= date("Y M d", strtotime($post->created_at)) ?></span>
                  </div>
                </div>
              </a>
            <?php } ?>
            </div>
          </section>
        <?php } ?>
@endsection
