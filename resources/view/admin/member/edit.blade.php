@extends('admin.layouts.app')

@section('head-tags')
<meta
   name="description"
   content="Rich and authoritative source of information from the world of bodybuilding"
 />
 <meta name="robots" content="NOINDEX,NOFOLLOW" />
 <title>Reliable Source In The World Of Bodybuilding | LegendBody</title>
@endsection

@section('script-tags')
<script defer src="<?= asset('admin-assets/js/utilities/FormHandler.js') ?>"></script>
<script defer src="<?= asset('admin-assets/js/components/fileInputHandler.js') ?>"></script>
<script defer src="<?= asset('admin-assets/js/pages/EditMemberHandler.js') ?>"></script>
@endsection

@section('content') 
        <header
          class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1 mg-top-1"
        >
          <h3 class="dashboard__title font-weight-600 font-size-2 dark-color">
            Edit Member
          </h3>
          <div
            class="dashboard__action-btns d-flex flex-wrap justify-content-center flex-grow-1 mg-left-auto"
          >
            <a
            href="<?= route('admin.members.index') ?>"
              class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
            >
              Back To Members
            </a>
          </div>
        </header>
        <section
          class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
        >
          <form
            id="edit-member-form"
            autocomplete="off"
            autocapitalize="off"
            class="dashboard-form w-100 font-weight-600 d-flex flex-wrap justify-content-space-evenly pd-bottom-1"
            novalidate
            action="<?= route('admin.members.update', ['username' => $member->username]) ?>" 
            method="post" 
            enctype="multipart/form-data"
          >
          <input type="hidden" name="_method" value="put">

            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-column align-items-center flex-grow-1 mg-top-1 pd-horizontal-1 full-width"
            >
              <input
                type="file"
                accept="image/jpg, image/jpeg, image/png, image/gif, image/bmp, image/tiff, image/tif, image/webp"
                data-cover="true"
                id="avatar"
                name="avatar"
                hidden
              />
              <label
                for="avatar"
                class="dashboard-form__file w-100 outline-none-attention border-1px mg-horizontal-auto border-gray user-giant-avatar flex-shrink-1 primary-bg dark-shadow radius-circle cursor-pointer"
                data-text=""
              >
                <img
                src="<?= asset($member->avatar) ?>"
                alt=""
                />
              </label>
              <div
                class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('avatar') ?>"
              >
                <span class="primary-color--dark"><?= errorText('avatar') ?></span>
              </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="name"
                >Name</label
              >
              <input
                type="text"
                name="name"
                id="name"
                placeholder="Write Category Name"
                class="dashboard-form__input w-100 border-1px outline-none-attention dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
                value="<?= oldOrValue('name', $member->name) ?>"
                />
              <div
                class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('name') ?>"
              >
                <span class="primary-color--dark"><?= errorText('name') ?></span>
              </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="family"
                >Family</label
              >
              <input
                type="text"
                name="family"
                id="family"
                placeholder="Write Category Family"
                class="dashboard-form__input w-100 border-1px outline-none-attention dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
                value="<?= oldOrValue('family', $member->family) ?>"
                />
                <div
                  class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('family') ?>"
                >
                  <span class="primary-color--dark"><?= errorText('family') ?></span>
                </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="role"
                >Role</label
              >
              <select
                class="dashboard-form__select w-100 outline-none-attention d-block pd-1 font-size-1 radius-rounded-small primary-bg border-gray dark-color pd-1"
                name="role"
                id="role"
              >
                <option value="" class="dark-color primary-bg">
                  Choose Role
                </option>
                <option value="author" class="dark-color primary-bg">
                  Author
                </option>
                <option value="master" class="dark-color primary-bg">
                  Master
                </option>
              </select>
              <div
                  class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('role') ?>"
                >
                  <span class="primary-color--dark"><?= errorText('role') ?></span>
                </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1 full-width"
            >
              <button
                type="submit"
                id="submit-btn"
                class="dashboard-form__submit outline-none-attention font-size-1 pd-1 mg-horizontal-auto dark-bg light-color dark-shadow radius-rounded-small dark-border-1px cursor-pointer"
              >
                Submit
              </button>
            </div>
          </form>
        </section>
@endsection
