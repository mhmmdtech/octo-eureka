<nav
id="sidebar-panel"
class="sidebar-panel pos-fixed primary-bg js-simplebar not-printed"
data-simplebar-title="Admin Dashboard Sidebar Scrollable Panel"
>
<a
  class="sidebar-panel__brand outline-none-attention font-size-2 d-block pd-1"
  href="<?= route('home.index') ?>"
>
  <h3 class="dark-color"><?= System\Config\Config::get('app.APP_TITLE') ?></h3>
</a>
<ul class="sidebar-panel__list flex-grow-1 mg-0 pd-0" role="list">
  <li class="sidebar-panel__item <?= sidebarActive(route('admin.dashboard'), false) ?>">
    <a
      class="sidebar-panel__link w-100 outline-none-attention d-flex align-items-center pd-1 light-color"
      href="<?= route('admin.dashboard') ?>"
      >
      <svg class="sidebar-panel__icon dark-fill">
        <use
          xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-dashboard')  ?>"

        ></use>
      </svg>
      <span
        class="sidebar-panel__text dark-color font-size-1 font-weight-600"
        >Dashboard</span
      >
    </a>
  </li>

  <li class="sidebar-panel__item <?= sidebarActive(route('admin.categories.index')) ?>">
    <a
      class="sidebar-panel__link w-100 outline-none-attention d-flex align-items-center pd-1 light-color"
      href="<?= route('admin.categories.index') ?>"
    >
      <svg class="sidebar-panel__icon dark-fill">
        <use
          xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-category')  ?>"
        ></use>
      </svg>
      <span
        class="sidebar-panel__text dark-color font-size-1 font-weight-600"
        >Categories</span
      >
    </a>
  </li>

  <li class="sidebar-panel__item <?= sidebarActive(route('admin.members.index')) ?>">
    <a
      class="sidebar-panel__link w-100 outline-none-attention d-flex align-items-center pd-1 light-color"
      href="<?= route('admin.members.index') ?>"
    >
      <svg class="sidebar-panel__icon dark-fill">
        <use
          xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-user')  ?>"
        ></use>
      </svg>
      <span
        class="sidebar-panel__text dark-color font-size-1 font-weight-600"
        >Members</span
      >
    </a>
  </li>

  <li class="sidebar-panel__item <?= sidebarActive(route('admin.posts.index')) ?>">
    <a
      class="sidebar-panel__link w-100 outline-none-attention d-flex align-items-center pd-1 light-color"
      href="<?= route('admin.posts.index') ?>"
    >
      <svg class="sidebar-panel__icon dark-fill">
        <use
        xlink:href="<?=  asset('admin-assets/assets/icons/sidebar-icons.svg#sidebar-post')  ?>"
        ></use>
      </svg>
      <span
        class="sidebar-panel__text dark-color font-size-1 font-weight-600"
        >Posts</span
      >
    </a>
  </li>

</ul>
</nav>
<div
class="web-backdrop w-100 h-100 pos-absolute dark-overlay hide not-printed"
></div>