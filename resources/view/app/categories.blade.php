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
        <?php if (!empty($parentCategories)) { ?>
          <section class="category-cards__wrapper overflow-hidden">
            <h3 class="d-block dark-color font-size-3 pd-left-1 font-weight-600">
              Parent Categories
            </h3>
            <div class="category-cards pd-1 card-column">
            <?php foreach($parentCategories as $parentCategory) {?>
              <a
                href="<?= route('home.category', ['slug' => $parentCategory->slug]) ?>"
                class="category-cards__item w-100 pos-relative justify-self-center primary-bg dark-shadow radius-rounded-small"
              >
                <figure class="category-cards__cover w-100 h-100 pos-relative">
                  <img
                    src="<?= asset($parentCategory->thumbnail()->small) ?>"
                    class="w-100 h-100 fit-cover"
                    alt=""
                  />
                </figure>
                <div
                  class="category-cards__content light-color pd-1 w-100 h-100 pos-absolute top-0 left-0 d-flex flex-wrap align-content-end dark-solid-overlay"
                >
                  <div class="pos-absolute top-0 left-0 primary-bg"></div>
                  <h2 class="font-size-2 font-weight-600 flex-grow-1">
                    <?= $parentCategory->title ?>
                  </h2>
                  <p class="font-size-1 font-weight-600 flex-grow-1">
                    <?= $parentCategory->description ?>
                  </p>
                </div>
              </a>
            <?php } ?>
            </div>
          </section>
        <?php } ?>
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
@endsection
