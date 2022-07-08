class SettingAccountHandler {
  constructor(form) {
    this.form = form;
    this.formHandler = new FormValidation(this.form);
    this.localErrors = [];
    this.form.addEventListener('submit', this.submit.bind(this));
  }
  validate() {
    this.formHandler.clearErrors();

    this.formHandler.passwordValidation(
      this.form.password,
      5,
      30,
      '.dashboard-form__error',
      'Password'
    );

    this.formHandler.passwordComparison(
      this.form.password,
      this.form.confirm_password,
      '.dashboard-form__error'
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
const settingAccountForm = document.getElementById('setting-account-form');
const settingAccountHandler = new SettingAccountHandler(settingAccountForm);
