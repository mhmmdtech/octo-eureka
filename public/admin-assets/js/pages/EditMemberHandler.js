class EditMemberHandler {
  constructor(form) {
    this.form = form;
    this.formHandler = new FormValidation(this.form);
    this.localErrors = [];
    this.form.addEventListener('submit', this.submit.bind(this));
  }
  validate() {
    this.formHandler.clearErrors();

    this.formHandler.textValidation(
      this.form.name,
      4,
      20,
      '.dashboard-form__error',
      'Name'
    );

    this.formHandler.textValidation(
      this.form.family,
      4,
      20,
      '.dashboard-form__error',
      'Family'
    );

    this.formHandler.fileValidation(
      this.form.avatar,
      'Avatar',
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
const editMemberForm = document.getElementById('edit-member-form');
const editMemberHandler = new EditMemberHandler(editMemberForm);
