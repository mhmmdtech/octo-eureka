<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en" > <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en" > <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en" > <![endif]-->
<!--[if lt IE 9]>
  <script src="<?=  asset('admin-assets/js/utilities/html5shiv-printshiv.min.js')  ?>"></script>
<![endif]-->
<html lang="en" dir="ltr" class="no-js">
  <head>
    @include('admin.layouts.head-tags')
    @yield('head-tags')

    @include('admin.layouts.css-tags')
    @yield('css-tags')
    
    @include('admin.layouts.script-tags')
    @yield('script-tags')
  </head>
  <body
  class="w-100 pos-relative d-flex flex-column jusitfy-content-start align-items-center"
  >
    <header class="header primary-bg dark-shadow pd-horizontal-1 pos-fixed not-printed">
      <div class="header__hamburger cursor-pointer" tabindex="1">
        <span class="header__hamburger-line radius-rounded dark-bg"></span>
        <span class="header__hamburger-line radius-rounded dark-bg"></span>
        <span class="header__hamburger-line radius-rounded dark-bg"></span>
      </div>
      <ul class="header__nav" role="list">
        <li class="header__item header__dropdown pos-relative" dropdown>
          <a
            class="header__link d-flex align-items-center"
            dropdown-toggler
            href="javascript:void(0)"
          >
            <img
              src="<?= asset(\System\Auth\Auth::member()->avatar) ?>"
              class="header__avatar radius-circle"
              alt="<?= \System\Auth\Auth::member()->username ?>'s <?= System\Config\Config::get('app.APP_TITLE') ?> Profile"
            />
            <span class="dark-color font-size-1"><?= \System\Auth\Auth::member()->username ?></span>
            <svg class="dark-fill">
              <use
              xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#navbar-chevron-down')  ?>"
              ></use>
            </svg>
          </a>
          <ul
            class="header__dropdown-menu primary-bg dark-shadow radius-rounded border-gray hide pos-absolute pd-vertical-1"
            dropdown-menu
            role="list"
          >
          <li class="header__dropdown-item <?= sidebarActive(route('home.index'), false) ?>" dropdown-item>
            <a
            href="<?= route('home.index') ?>"
            class="header__dropdown-link d-flex align-items-center pd-1"
            >
              <svg class="header__dropdown-icon dark-fill">
                <use
                  xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-dashboard')  ?>"
                ></use>
              </svg>
              <span class="dark-color header__dropdown-link-text font-size-1"
                >Home</span
              >
            </a>
          </li>
            <li class="header__dropdown-item <?= sidebarActive(route('admin.account')) ?>" dropdown-item>
              <a
              href="<?= route('admin.account') ?>"
              class="header__dropdown-link d-flex align-items-center pd-1"
              >
                <svg class="header__dropdown-icon dark-fill">
                  <use
                    xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-user')  ?>"
                  ></use>
                </svg>
                <span class="dark-color header__dropdown-link-text font-size-1"
                  >Account</span
                >
              </a>
            </li>
            <li class="header__dropdown-item <?= sidebarActive(route('auth.logout'), false) ?>" dropdown-item>
              <a
                href="<?= route('auth.logout') ?>"
                class="header__dropdown-link d-flex align-items-center pd-1"
              >
                <svg class="header__dropdown-icon dark-fill">
                  <use
                    xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#navbar-logout')  ?>"
                  ></use>
                </svg>
                <span class="dark-color header__dropdown-link-text font-size-1">
                  Logout
                </span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <div
    class="web-body w-100 flex-grow-1 d-flex justify-content-start align-items-start pos-relative primary-bg"
    >
      @include('admin.layouts.sidebar')    
      <main class="web-main w-100 d-flex flex-column">
        @yield('content')
        <footer
    class="dashboard-footer text-center w-100 mg-top-auto font-weight-600 pd-1 d-flex align-items-center flex-column not-printed"
  >
    <p class="dashboard-footer__text dark-color font-size-1">
      Copyright &copy; <?= date('Y') ?> <?= System\Config\Config::get('app.APP_TITLE') ?>. All rights reserved.
    </p>
    <p class="dashboard-footer__text dark-color font-size-1 mg-top-1">
      Powered By <?= System\Config\Config::get('app.DEVELOPER_TEAM') ?>
    </p>
  </footer>
      </main>
    </div>
  </body>
</html>
