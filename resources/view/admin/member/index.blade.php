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
          <h3 class="dashboard__title font-weight-600 font-size-2 dark-color">Members</h3>
          <div
            class="dashboard__action-btns d-flex flex-wrap justify-content-center flex-grow-1 mg-left-auto"
          >
            <a
              href="<?= route('admin.members.create') ?>"
              class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
            >
              Add Member
            </a>
          </div>
        </header>
        <sesction
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
                Deactived Members
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
                ><?= $deactivedMembersCount ?></span
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
                Deleted Members
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
                ><?= $deletedMembersCount ?></span
              >
            </div>
          </div>
        </sesction>
        <section
          class="dashboard__wrapper d-flex flex-wrap justify-content-space-around"
        >
          <div
            class="analytic-table__wrapper flex-grow-1 mg-1 js-simplebar primary-bg dark-shadow radius-rounded-small"
            data-simplebar-title="All Members Scrollable Table"
          >
            <table
              class="analytic-table w-100 font-weight-600 font-size-1 dark-color"
            >
              <caption class="text-left font-size-2 pd-1">
                All Members
              </caption>
              <thead class="border-gray border-bottom-1px">
                <th scope="col" class="pd-1">#</th>
                <th scope="col" class="pd-1">Fullname</th>
                <th scope="col" class="pd-1">Role</th>
                <th scope="col" class="pd-1">Status</th>
                <th scope="col" class="pd-1">Registered At</th>
                <th scope="col" class="pd-1">Actions</th>
              </thead>
              <tbody class="list-border-bottom">
                <?php foreach($members as $member) { ?>
                <tr role="row" class="border-gray">
                  <td class="text-center pd-1" scope="row"><?= $member->id ?></td>
                  <td class="text-center pd-1"><?= $member->fullname() ?></td>
                  <td class="text-center pd-1"><?= $member->role ?></td>
                  <td class="text-center pd-1"><?= $member->status() ?></td>
                  <td class="text-center pd-1"><?= date("Y M d", strtotime($member->created_at)) ?></td>
                  <td class="text-center pd-1">
                    <a
                    href="<?= route('admin.members.show', ['username' => $member->username]) ?>"
                    class="analytic-table__action-btn dark-bg light-color radius-rounded-small cursor-pointer font-size-1 pd-1 d-inline-block"
                      >Preview</a
                    >
                    <a
                    href="<?= route('admin.members.edit', ['username' => $member->username]) ?>"
                    class="analytic-table__action-btn dark-bg light-color radius-rounded-small cursor-pointer font-size-1 pd-1 d-inline-block"
                      >Edit</a
                    >
                    <form class="d-inline-block" action="<?= route('admin.members.delete', ['username' => $member->username]) ?>" method="post">
                      <input type="hidden" name="_method" value="delete">
                      <button
                      class="analytic-table__action-btn dark-bg light-color radius-rounded-small cursor-pointer font-size-1 pd-1 d-inline-block"
                      >
                        Delete
                      </button>
                    </form>
                    <form class="d-inline-block" action="<?= route('admin.members.change.status', ['username' => $member->username]) ?>" method="post">
                      <input type="hidden" name="_method" value="put">
                      <button
                      class="analytic-table__action-btn dark-bg light-color radius-rounded-small cursor-pointer font-size-1 pd-1 d-inline-block"
                      >
                      <?= $member->status == 0 ? "Active" : "Deactive" ?>
                      </button>
                    </form>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </section>
@endsection
        