// https://www.javascripttutorial.net/javascript-dom/javascript-form-validation/
// https://css-tricks.com/form-validation-part-4-validating-mailchimp-subscribe-form/
// https://www.the-art-of-web.com/javascript/validate/
// https://dev.to/javascriptacademy/form-validation-using-javascript-34je
// https://blog.bitsrc.io/client-side-form-validation-using-octavalidate-javascript-b150f2d14e99
class FormHandler {
  constructor(form) {
    this.form = form;
    this.globalErrors = [];
  }
  isEmpty(input) {
    return input.value.trim() === '' || input.value.trim().length === 0;
  }
  isLowerThanMinLength(input, minLength) {
    return input.value.trim().length < minLength;
  }
  isGreaterThanMaxLength(input, maxLength) {
    return input.value.trim().length > maxLength;
  }
  isValidEmail(input) {
    // https://www.regular-expressions.info/email.html
    // return String(input.value)
    //   .toLowerCase()
    //   .match(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/g);
    return String(input.value)
      .toLowerCase()
      .match(
        /^(?=[A-Z0-9][A-Z0-9@._%+-]{5,253}$)[A-Z0-9._%+-]{1,64}@(?:(?=[A-Z0-9-]{1,63}\.)[A-Z0-9]+(?:-[A-Z0-9]+)*\.){1,8}[A-Z]{2,63}$/gi
      );
  }
  isPasswordEqual(input, confirm) {
    const confirmPassword = confirm.value.trim();
    const password = input.value.trim();
    return password === confirmPassword ? true : false;
  }
  isStrongPassword(input) {
    const password = input.value.trim();
    const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,25}$/;
    return regex.test(password);
  }
  isValidDate(input) {
    const date = input.value.trim();
    // https://www.regular-expressions.info/dates.html
    const regex =
      /^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/;
    // https://stackoverflow.com/questions/22061723/regex-date-validation-for-yyyy-mm-dd
    // const regex = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
    return regex.test(date);
  }
  isNumber(input) {
    return !isNaN(input.value);
  }
  isValidSelectBox(input) {
    return !(this.isEmpty(input) && input.selectedIndex === 0);
  }
  isLowerThanMinNumber(input, minNumber) {
    return parseInt(input.value) < parseInt(minNumber);
  }
  isInArray(allowedExtensions, fileType) {
    return allowedExtensions.includes(fileType);
  }
  isGreaterThanMaxNumber(input, maxNumber) {
    return parseInt(input.value) > parseInt(maxNumber);
  }
  isGreaterThanMaxSize(fileSize, allowedSize) {
    return fileSize > allowedSize;
  }
  showError(error) {
    let errorWrapper = error.error;
    errorWrapper.querySelector('span').textContent = error.message;
    errorWrapper.classList.replace('hide', 'show');
  }
  showErrors(errors) {
    errors.forEach((error) => {
      this.showError(error);
    });
  }
  hideError(error) {
    let errorWrapper = error.error;
    errorWrapper.classList.replace('show', 'hide');
    setTimeout(() => {
      // https://dirask.com/posts/JavaScript-no-break-non-breaking-space-in-string-jMwzxD
      errorWrapper.querySelector('span').textContent = '\u00A0';
    }, 250);
  }
  hideErrors(errors) {
    errors.forEach((error) => {
      this.hideError(error);
    });
  }
  getErrors() {
    return this.globalErrors || [];
  }
  addError(input, className, message) {
    this.globalErrors.push({
      input,
      error: get_sibling(input, className),
      message,
    });
  }
  clearErrors() {
    this.globalErrors = [];
  }
  showAlert(container, status, message) {
    let errorWrapper = document.querySelector(container);
    errorWrapper.querySelector('p').textContent = message;
    errorWrapper.classList.replace('hide', 'show');
  }
  hideAlert(container) {
    let errorWrapper = document.querySelector(container);
    errorWrapper.classList.replace('show', 'hide');
    setTimeout(() => {
      // https://dirask.com/posts/JavaScript-no-break-non-breaking-space-in-string-jMwzxD
      errorWrapper.querySelector('p').textContent = '\u00A0';
    }, 250);
  }
}
class FormValidation extends FormHandler {
  constructor(form) {
    super(form);
    this.isPasswordSafe = true;
  }

  textValidation(input, minLength, maxLength, errorWrapperName, subject) {
    if (this.isEmpty(input)) {
      this.addError(input, errorWrapperName, `${subject} is required`);
    } else if (this.isLowerThanMinLength(input, minLength)) {
      this.addError(
        input,
        errorWrapperName,
        `${subject} must be at least ${minLength} characters`
      );
    } else if (this.isGreaterThanMaxLength(input, maxLength)) {
      this.addError(
        input,
        errorWrapperName,
        `${subject} must be at most ${maxLength} characters`
      );
    }
  }

  emailValidation(input, minLength, maxLength, errorWrapperName, subject) {
    if (this.isEmpty(input)) {
      this.addError(input, errorWrapperName, `${subject} is required`);
    } else if (this.isLowerThanMinLength(input, minLength)) {
      this.addError(
        input,
        errorWrapperName,
        `${subject} must be at least ${minLength} characters`
      );
    } else if (this.isGreaterThanMaxLength(input, maxLength)) {
      this.addError(
        input,
        errorWrapperName,
        `${subject} must be at most ${maxLength} characters`
      );
    } else if (!this.isValidEmail(input)) {
      this.addError(
        input,
        errorWrapperName,
        `Please Enter Valid ${subject} Address`
      );
    }
  }

  passwordValidation(input, minLength, maxLength, errorWrapperName, subject) {
    this.isPasswordSafe = true;
    if (this.isEmpty(input)) {
      this.addError(input, errorWrapperName, `${subject} is required`);
      this.isPasswordSafe = false;
    } else if (this.isLowerThanMinLength(input, minLength)) {
      this.addError(
        input,
        errorWrapperName,
        `${subject} must be at least ${minLength} characters`
      );
      this.isPasswordSafe = false;
    } else if (this.isGreaterThanMaxLength(input, maxLength)) {
      this.addError(
        input,
        errorWrapperName,
        `${subject} must be at most ${maxLength} characters`
      );
      this.isPasswordSafe = false;
    } else if (!this.isStrongPassword(input)) {
      this.addError(input, errorWrapperName, `Your ${subject} Is Stronger`);
      this.isPasswordSafe = false;
    }
  }

  passwordComparison(input, confirm, errorWrapperName) {
    if (this.isPasswordSafe) {
      if (!this.isPasswordEqual(input, confirm)) {
        this.addError(input, errorWrapperName, `Passwords Do Not Match`);
        this.addError(confirm, errorWrapperName, `Passwords Do Not Match`);
      }
    }
  }

  selectBoxValidation(input, subject, errorWrapperName) {
    if (!this.isValidSelectBox(input)) {
      this.addError(input, errorWrapperName, `${subject} is required`);
    }
  }

  fileValidation(
    input,
    subject,
    errorWrapperName,
    allowedFileType,
    isRequired
  ) {
    let allowedSize = 10 * 1024 * 1024;
    if (isRequired && this.isEmpty(input)) {
      this.addError(input, errorWrapperName, `${subject} Is Required`);
      return false;
    }
    if (!this.isEmpty(input)) {
      const { name: fileName, size: fileSize, type: fileType } = input.files[0];
      if (!this.isInArray(allowedFileType, fileType)) {
        this.addError(
          input,
          errorWrapperName,
          `Please upload a valid ${subject}`
        );
      } else if (this.isGreaterThanMaxSize(fileSize, allowedSize)) {
        this.addError(
          input,
          errorWrapperName,
          `${subject} must be less than 10MB`
        );
      }
    }
  }

  textareaValidation(input, errorWrapperName, subject) {
    if (this.isEmpty(input)) {
      this.addError(input, errorWrapperName, `${subject} is required`);
    }
  }
}
