class PasswordHandler {
  static togglePassword(button) {
    let closedEye = button.querySelector("[data-status='closed-eye']");
    let openedEye = button.querySelector("[data-status='opened-eye']");
    let passwordInput = get_sibling(button, 'input[data-type="password"]');
    let passwordStatus = button.dataset.status;

    if (passwordStatus === 'hide') {
      openedEye.classList.add('d-none');
      closedEye.classList.remove('d-none');
      passwordInput.type = 'text';
      button.dataset.status = 'show';
    } else if (passwordStatus === 'show') {
      closedEye.classList.add('d-none');
      openedEye.classList.remove('d-none');
      passwordInput.type = 'password';
      button.dataset.status = 'hide';
    }
  }

  static generateNewPassword(button, form) {
    let passwordAction = button.dataset.action;
    let passwordValue = '';
    if (passwordAction === 'generate') {
      let passwordLength = generateRandomInRange(15, 26);
      passwordValue = this.generatePassword(passwordLength);
    }
    if (passwordValue !== '') {
      form.querySelector("input[name='password']").value = passwordValue;
      form.querySelector("input[name='confirm_password']").value =
        passwordValue;
    }
  }
  static generatePassword(length) {
    // https://github.com/devloop01/password-generator/blob/master/js/script.js
    let generatedPassword = '';
    const randomFunc = {
      lower: getRandomLower,
      upper: getRandomUpper,
      number: getRandomNumber,
      symbol: getRandomSymbol,
    };
    let allowedTypes = ['lower', 'upper', 'number', 'symbol'];

    for (let i = 0; i < length; i++) {
      let funcName =
        allowedTypes[Math.floor(Math.random() * allowedTypes.length)];
      generatedPassword += randomFunc[funcName]();
    }
    return generatedPassword.slice(0, length);
  }
}

const passwordTogglers = document.querySelectorAll('[data-password-toggler]');
passwordTogglers.forEach((passwordToggler) => {
  passwordToggler.addEventListener('click', handlePasswordAction);
});
function handlePasswordAction(event) {
  let passwordButton = get_closest_element(event.target, 'button');
  if (!passwordButton) {
    return;
  }
  let buttonAction = passwordButton.dataset.action;
  if (buttonAction === 'toggle') {
    PasswordHandler.togglePassword(passwordButton);
  } else if (buttonAction === 'generate') {
    let form = get_closest_element(passwordButton, 'form');
    PasswordHandler.generateNewPassword(passwordButton, form);
  }
}
