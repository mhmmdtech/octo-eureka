/*
 *** Function That get all sibling elements
 */
function get_sibling(element, selector) {
  let parentElement = element.parentElement;
  if (!parentElement) return false;
  parentElement = parentElement.querySelector(selector);
  return parentElement;
}
/*
 *** Function That returns closest dedicated element
 */
function get_closest_element(element, selector) {
  let wrapper = element.closest(selector);
  if (!wrapper) return false;
  return wrapper;
}

// Random more secure value
function secureMathRandom() {
  return (
    window.crypto.getRandomValues(new Uint32Array(1))[0] / (Math.pow(2, 32) - 1)
  );
}
// Get random number in range
function generateRandomInRange(min, max) {
  // https://www.educative.io/answers/how-to-generate-a-random-number-between-a-range-in-javascript
  // find diff
  let difference = max - min;

  // generate random number
  let rand = Math.random();

  // multiply with difference
  rand = Math.floor(rand * difference);

  // add with min value
  rand = rand + min;

  return rand;
}

// Generator Functions
// All the functions that are responsible to return a random value taht we will use to create password.
function getRandomLower() {
  return String.fromCharCode(Math.floor(Math.random() * 26) + 97);
}
function getRandomUpper() {
  return String.fromCharCode(Math.floor(Math.random() * 26) + 65);
}
function getRandomNumber() {
  return String.fromCharCode(Math.floor(secureMathRandom() * 10) + 48);
}
function getRandomSymbol() {
  const symbols = '~!@#$%^&*()_+{}":?><;.,';
  return symbols[Math.floor(Math.random() * symbols.length)];
}
