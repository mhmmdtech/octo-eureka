@extends('admin.layouts.app')

@section('head-tags')
<meta
   name="description"
   content="Rich and authoritative source of information from the world of bodybuilding"
 />
 <meta name="robots" content="NOINDEX,NOFOLLOW" />
 <title>Reliable Source In The World Of Bodybuilding | LegendBody</title>
@endsection

@section('content')
<header
    class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1 mg-top-1"
>
  <h3 class="dashboard__title dark-color font-weight-600 font-size-2">
    Dashboard
  </h3>
  <div
    class="dashboard__action-btns d-flex flex-wrap justify-content-center flex-grow-1 mg-left-auto"
  >
    <button
      data-theme-switcher="light"
      type="button"
      class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer mg-right-1 dark-bg light-color dark-shadow"
    >
      Light
    </button>
    <button
      data-theme-switcher="dark"
      type="button"
      class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer mg-right-1 dark-bg light-color dark-shadow"
    >
      Dark
    </button>
  </div>
</header>
        <div
          class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
        >
          <div
            class="analytic-card flex-grow-1 primary-bg dark-shadow radius-rounded-small select-none mg-1"
          >
            <header
              class="analytic-card__header w-100 d-flex flex-wrap align-items-center justify-content-space-between pd-1"
            >
              <h4
                class="analytic-card__title font-weight-600 font-size-1 dark-color"
              >
                Actived Members
              </h4>
              <svg class="analytic-card__icon dark-fill">
                <use
                  xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-user')  ?>"
                ></use>
              </svg>
            </header>
            <div class="analytic-card__body pd-bottom-1">
              <span
                class="analytic-card__value font-weight-600 dark-color d-block text-center font-size-3"
                ><?= $activedMembersCount ?></span
              >
            </div>
          </div>
          <div
            class="analytic-card flex-grow-1 primary-bg dark-shadow radius-rounded-small select-none mg-1"
          >
            <header
              class="analytic-card__header w-100 d-flex flex-wrap align-items-center justify-content-space-between pd-1"
            >
              <h4
                class="analytic-card__title font-weight-600 font-size-1 dark-color"
              >
                Published Posts
              </h4>
              <svg class="analytic-card__icon dark-fill">
                <use
                  xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-post')  ?>"
                ></use>
              </svg>
            </header>
            <div class="analytic-card__body pd-bottom-1">
              <span
                class="analytic-card__value font-weight-600 dark-color d-block text-center font-size-3"
                ><?= $publishedPostsCount ?></span
              >
            </div>
          </div>
          <div
            class="analytic-card flex-grow-1 primary-bg dark-shadow radius-rounded-small select-none mg-1"
          >
            <header
              class="analytic-card__header w-100 d-flex flex-wrap align-items-center justify-content-space-between pd-1"
            >
              <h4
                class="analytic-card__title font-weight-600 font-size-1 dark-color"
              >
                Published Categories
              </h4>
              <svg class="analytic-card__icon dark-fill">
                <use
                xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-category')  ?>"
                ></use>
              </svg>
            </header>
            <div class="analytic-card__body pd-bottom-1">
              <span
                class="analytic-card__value font-weight-600 dark-color d-block text-center font-size-3"
                ><?= $publishedCategoriesCount ?></span
              >
            </div>
          </div>
          <div
            class="analytic-card flex-grow-1 primary-bg dark-shadow radius-rounded-small select-none mg-1"
          >
            <header
              class="analytic-card__header w-100 d-flex flex-wrap align-items-center justify-content-space-between pd-1"
            >
              <h4
                class="analytic-card__title font-weight-600 font-size-1 dark-color"
              >
                Total Members
              </h4>
              <svg class="analytic-card__icon dark-fill">
                <use
                xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-user')  ?>"
                ></use>
              </svg>
            </header>
            <div class="analytic-card__body pd-bottom-1">
              <span
                class="analytic-card__value font-weight-600 dark-color d-block text-center font-size-3"
                ><?= $totalMembersCount ?></span
              >
            </div>
          </div>
          <div
            class="analytic-card flex-grow-1 primary-bg dark-shadow radius-rounded-small select-none mg-1"
          >
            <header
              class="analytic-card__header w-100 d-flex flex-wrap align-items-center justify-content-space-between pd-1"
            >
              <h4
                class="analytic-card__title font-weight-600 font-size-1 dark-color"
              >
                Total Posts
              </h4>
              <svg class="analytic-card__icon dark-fill">
                <use
                xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-post')  ?>"
                ></use>
              </svg>
            </header>
            <div class="analytic-card__body pd-bottom-1">
              <span
                class="analytic-card__value font-weight-600 dark-color d-block text-center font-size-3"
                ><?= $totalPostsCount ?></span
              >
            </div>
          </div>
          <div
            class="analytic-card flex-grow-1 primary-bg dark-shadow radius-rounded-small select-none mg-1"
          >
            <header
              class="analytic-card__header w-100 d-flex flex-wrap align-items-center justify-content-space-between pd-1"
            >
              <h4
                class="analytic-card__title font-weight-600 font-weight-600 font-size-1 dark-color"
              >
                Total Categories
              </h4>
              <svg class="analytic-card__icon dark-fill">
                <use
                xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-category')  ?>"
                ></use>
              </svg>
            </header>
            <div class="analytic-card__body pd-bottom-1">
              <span
                class="analytic-card__value font-weight-600 dark-color d-block text-center font-size-3"
                ><?= $totalCategoriesCount ?></span
              >
            </div>
          </div>
        </div>
        <div
          class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
        >
          <div
            class="analytic-table__wrapper flex-grow-1 js-simplebar mg-1 primary-bg dark-shadow radius-rounded-small"
            data-simplebar-title="Latest Posts Scrollable Table"
          >
            <table
              class="analytic-table w-100 font-weight-600 font-size-1 dark-color"
            >
              <caption class="text-left font-size-2 pd-1">
                Latest Posts
              </caption>
              <thead class="border-gray border-bottom-1px">
                <th scope="col" class="pd-1">#</th>
                <th scope="col" class="pd-1">Title</th>
                <th scope="col" class="pd-1">Category</th>
                <th scope="col" class="pd-1">Author</th>
                <th scope="col" class="pd-1">Status</th>
                <th scope="col" class="pd-1">Created At</th>
                <th scope="col" class="pd-1">Updated At</th>
              </thead>
              <tbody class="list-border-bottom">
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div
            class="analytic-table__wrapper flex-grow-1 js-simplebar mg-1 primary-bg dark-shadow radius-rounded-small"
            data-simplebar-title="Popular Posts Scrollable Table"
          >
            <table
              class="analytic-table w-100 font-weight-600 font-size-1 dark-color"
            >
              <caption class="text-left font-size-2 pd-1">
                Popular Posts
              </caption>
              <thead class="border-gray border-bottom-1px">
                <th scope="col" class="pd-1">#</th>
                <th scope="col" class="pd-1">Title</th>
                <th scope="col" class="pd-1">Category</th>
                <th scope="col" class="pd-1">Author</th>
                <th scope="col" class="pd-1">Status</th>
                <th scope="col" class="pd-1">Created At</th>
                <th scope="col" class="pd-1">Updated At</th>
              </thead>
              <tbody class="list-border-bottom">
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">How to learn CSS?</td>
                  <td class="text-center pd-1">Web Development</td>
                  <td class="text-center pd-1">John Doe</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/02/10</td>
                  <td class="text-center pd-1">-</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div
            class="analytic-table__wrapper flex-grow-1 js-simplebar mg-1 primary-bg dark-shadow radius-rounded-small"
            data-simplebar-title="Active Authors Scrollable Table"
          >
            <table
              class="analytic-table w-100 font-weight-600 font-size-1 dark-color"
            >
              <caption class="text-left font-size-2 pd-1">
                Active Authors
              </caption>
              <thead class="border-gray border-bottom-1px">
                <th scope="col" class="pd-1">#</th>
                <th scope="col" class="pd-1">Fullname</th>
                <th scope="col" class="pd-1">Total Posts</th>
                <th scope="col" class="pd-1">Status</th>
                <th scope="col" class="pd-1">Joined At</th>
              </thead>
              <tbody class="list-border-bottom">
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div
            class="analytic-table__wrapper flex-grow-1 js-simplebar mg-1 primary-bg dark-shadow radius-rounded-small"
            data-simplebar-title="Popular Authors Scrollable Table"
          >
            <table
              class="analytic-table w-100 font-weight-600 font-size-1 dark-color"
            >
              <caption class="text-left font-size-2 pd-1">
                Popular Authors
              </caption>
              <thead class="border-gray border-bottom-1px">
                <th scope="col" class="pd-1">#</th>
                <th scope="col" class="pd-1">Fullname</th>
                <th scope="col" class="pd-1">Total Posts</th>
                <th scope="col" class="pd-1">Posts Viewers</th>
                <th scope="col" class="pd-1">Status</th>
                <th scope="col" class="pd-1">Joined At</th>
              </thead>
              <tbody class="list-border-bottom">
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">2000</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">2000</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">2000</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">2000</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
                <tr class="border-gray">
                  <td class="text-center pd-1" scope="row">1</td>
                  <td class="text-center pd-1">Amanda Cereny</td>
                  <td class="text-center pd-1">10</td>
                  <td class="text-center pd-1">2000</td>
                  <td class="text-center pd-1">Active</td>
                  <td class="text-center pd-1">2020/07/02</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
@endsection
