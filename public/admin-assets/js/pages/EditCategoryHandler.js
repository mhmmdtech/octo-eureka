class EditCategoryHandler {
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
      false
    );

    this.formHandler.textValidation(
      this.form.description,
      10,
      255,
      '.dashboard-form__error',
      'Description'
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
const editCategoryForm = document.getElementById('edit-category-form');
const editCategoryHandler = new EditCategoryHandler(editCategoryForm);
