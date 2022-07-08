<nav
        id="sidebar-panel"
        class="sidebar-panel pos-fixed primary-bg js-simplebar not-printed"
        data-simplebar-title="Admin Dashboard Sidebar Scrollable Panel"
      >
        <ul class="sidebar-panel__list flex-grow-1 mg-0 pd-0" role="list">
            <li class="sidebar-panel__item <?= sidebarActive(route('home.categories'), false) ?>">
                <a
                  class="sidebar-panel__link w-100 outline-none-attention d-flex align-items-center pd-1 light-color"
                  href="<?= route("home.categories") ?>"
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
            <li class="sidebar-panel__item <?= sidebarActive(route('home.posts'), false) ?>">
                <a
                  class="sidebar-panel__link w-100 outline-none-attention d-flex align-items-center pd-1 light-color"
                  href="<?= route("home.posts") ?>"
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