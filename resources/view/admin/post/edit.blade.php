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
<script defer src="<?= asset('admin-assets/js/vendors/ckeditor/ckeditor.js') ?>"></script>
<script defer src="<?= asset('admin-assets/js/utilities/FormHandler.js') ?>"></script>
<script defer src="<?= asset('admin-assets/js/components/fileInputHandler.js') ?>"></script>
<script defer src="<?= asset('admin-assets/js/pages/EditPostHandler.js') ?>"></script>
@endsection

@section('content')
        <header
          class="dashboard__header w-100 d-flex flex-wrap align-items-center pd-horizontal-1 mg-top-1"
        >
          <h3 class="dashboard__title dark-color font-weight-600 font-size-2">
            Edit Post
          </h3>
          <div
            class="dashboard__action-btns d-flex flex-wrap justify-content-center flex-grow-1 mg-left-auto"
          >
            <a
            href="<?= route('admin.posts.index') ?>"
              class="dashboard__action-btn font-weight-600 outline-none-attention radius-rounded-small font-size-1 pd-1 border-none cursor-pointer dark-bg light-color dark-shadow"
            >
              Back To Posts
            </a>
          </div>
        </header>
        <section
          class="dashboard__wrapper w-100 d-flex flex-wrap justify-content-space-around"
        >
          <form
            id="edit-post-form"
            autocomplete="off"
            autocapitalize="off"
            class="dashboard-form w-100 font-weight-600 d-flex flex-wrap justify-content-space-evenly pd-bottom-1"
            novalidate
            action="<?= route('admin.posts.update', ['slug' => $post->slug]) ?>" 
            method="post" 
            enctype="multipart/form-data"
          >
          <input type="hidden" name="_method" value="put">
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="title"
                >Title</label
              >
              <input
                type="text"
                name="title"
                id="title"
                placeholder="Write Post Title"
                class="dashboard-form__input w-100 border-1px outline-none-attention dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
                value="<?= oldOrValue('title', $post->title) ?>"
                />
                <div
                class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('title') ?>"
              >
                <span class="primary-color--dark"><?= errorText('title') ?></span>
              </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="category_id"
                >Category</label
              >
              <select
                class="dashboard-form__select w-100 outline-none-attention d-block pd-1 font-size-1 radius-rounded-small primary-bg border-gray dark-color pd-1"
                name="category_id"
                id="category_id"
              >
                <option value="" class="dark-color primary-bg">
                  Choose Category Category
                </option>
               
                <?php foreach($categories as $categorySelect){ ?>
                  <option value="<?= $categorySelect->id ?>" class="dark-color primary-bg" <?= oldOrValue('category_id', $post->category_id) == $categorySelect->id ? 'selected' : '' ?> >
                    <?= $categorySelect->title ?>
                  </option>
                  <?php } ?>
              </select>
              <div
              class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('category_id') ?>"
            >
              <span class="primary-color--dark"><?= errorText('category_id') ?></span>
            </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <span
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                >Thumbnail</span
              >
              <input
                type="file"
                accept="image/jpg, image/jpeg, image/png, image/gif, image/bmp, image/tiff, image/tif, image/webp"
                id="thumbnail"
                name="thumbnail"
                hidden
              />
              <label
                for="thumbnail"
                class="dashboard-form__file w-100 outline-none-attention border-1px primary-bg dark-color pd-1 font-size-1 d-block border-gray radius-rounded-small cursor-pointer"
                data-text="Choose File..."
              ></label>
              <div
              class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('thumbnail') ?>"
            >
              <span class="primary-color--dark"><?= errorText('thumbnail') ?></span>
            </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1"
            >
              <span
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                >Attachments</span
              >
              <input
                type="file"
                id="attachments"
                name="attachments[]"
                hidden
                multiple="multiple"
              />
              <label
                for="attachments"
                class="dashboard-form__file w-100 outline-none-attention border-1px primary-bg dark-color pd-1 font-size-1 d-block border-gray radius-rounded-small cursor-pointer"
                data-text="Choose File..."
              ></label>
              <div
                class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('attachments') ?>"
              >
                <span class="primary-color--dark"><?= errorText('attachments') ?></span>
              </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-grow-1 mg-top-1 pd-horizontal-1 full-width"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="description"
                >Description</label
              >
              <input
                type="text"
                name="description"
                id="description"
                placeholder="Write Category Description"
                class="dashboard-form__input w-100 border-1px outline-none-attention dark-color radius-rounded-small primary-bg border-gray pd-1 font-size-1"
                value="<?= oldOrValue('description', $post->description) ?>"
                 />
                 <div
                 class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('description') ?>"
               >
                 <span class="primary-color--dark"><?= errorText('description') ?></span>
               </div>
            </div>
            <div
              class="dashboard-form__input-group d-flex flex-wrap flex-column mg-top-1 pd-horizontal-1 full-width"
            >
              <label
                class="dashboard-form__label d-block font-size-1 pd-left-1 dark-color"
                for="body"
                >Body</label
              >
              <textarea
                name="body"
                id="body"
                class="dashboard-form__textarea w-100 outline-none-attention dark-color pd-1 font-size-1 resize-none radius-rounded-small primary-bg border-gray"
                placeholder="Write Post Body"
                cols="30"
                rows="10"
              ><?= oldOrValue('body', $post->body) ?></textarea>
              <div
              class="dashboard-form__error font-size-1 pd-left-1 danger-color <?= errorClass('body') ?>"
              >
              <span class="primary-color--dark"><?= errorText('body') ?></span>
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
