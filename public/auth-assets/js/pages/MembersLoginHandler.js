class MembersLoginHandler {
  constructor(form) {
    this.form = form;
    this.formHandler = new FormValidation(this.form);
    this.localErrors = [];
    this.form.addEventListener('submit', this.submit.bind(this));
  }
  validate() {
    this.formHandler.clearErrors();
    this.formHandler.textValidation(
      this.form.username,
      4,
      20,
      '.auth-form__error',
      'Username'
    );

    this.formHandler.passwordValidation(
      this.form.password,
      5,
      30,
      '.auth-form__error',
      'Password'
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
      // 1. This is the manual method
      this.form.removeEventListener('submit', this.submit.bind(this));
      this.form.submit();
      // 2. This is the fetch method
      // const http = new EasyHTTP();
      // const loginInfo = new FormData(this.form);
      //Create an object from the form data entries
      // let loginInfoObj = Object.fromEntries(loginInfo.entries());
      // Create User
      http
        .post(this.form.action, loginInfoObj)
        .then((data) => console.log(data))
        .catch((err) => {
          console.log(err);
        });
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
const membersLoginForm = document.getElementById('members-login-form');
const membersLoginHandler = new MembersLoginHandler(membersLoginForm);
