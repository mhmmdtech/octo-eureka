class CreatePostHandler {
  constructor(form) {
    this.form = form;
    this.formHandler = new FormValidation(this.form);
    this.localErrors = [];
    this.form.addEventListener('submit', this.submit.bind(this));
  }
  validate() {
    this.formHandler.clearErrors();

    this.formHandler.textValidation(
      this.form.title,
      5,
      50,
      '.dashboard-form__error',
      'Title'
    );

    this.formHandler.selectBoxValidation(
      this.form.category_id,
      'Category',
      '.dashboard-form__error'
    );

    this.formHandler.fileValidation(
      this.form.thumbnail,
      'Thumbnail',
      '.dashboard-form__error',
      [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/bmp',
        'image/tiff',
        'image/tif',
        'image/webp',
      ],
      true
    );
    this.formHandler.attachmentValidation(
      this.form.attachments,
      'Attachments',
      '.dashboard-form__error',
      false
    );

    this.formHandler.textValidation(
      this.form.description,
      10,
      255,
      '.dashboard-form__error',
      'Description'
    );

    this.formHandler.textareaValidation(
      this.form.body,
      '.dashboard-form__error',
      'Body'
    );

    let errorsObj = this.formHandler.getErrors();
    if (errorsObj.length > 0) {
      return { isSuccess: false, errors: errorsObj };
    }
    return { isSuccess: true, errors: [] };
  }
  submit(event) {
    event.preventDefault();
    let isInitialErrors = true;
    if (this.localErrors.length > 0) {
      this.formHandler.hideErrors(this.localErrors);
      this.localErrors = [];
      isInitialErrors = false;
    }
    const FormValidated = this.validate();
    this.localErrors = [...FormValidated.errors];
    if (FormValidated.isSuccess) {
      console.log('Send AJAX Request');
      this.form.removeEventListener('submit', this.submit.bind(this));
      this.form.submit();
    } else {
      if (isInitialErrors) {
        this.formHandler.showErrors(this.localErrors);
      } else {
        setTimeout(() => {
          this.formHandler.showErrors(this.localErrors);
        }, 500);
      }
    }
    return false;
  }
}
const createPostForm = document.getElementById('create-post-form');
const createPostHandler = new CreatePostHandler(createPostForm);
CKEDITOR.replace('body', {
  extraPlugins: 'embed,embedbase',
  embed_provider:
    '//iframe.ly/api/oembed?url={url}&callback={callback}&api_key=YOUR_API_KEY&iframe=1&_showcaption=true',
});
