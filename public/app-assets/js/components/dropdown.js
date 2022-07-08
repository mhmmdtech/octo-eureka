const headerMenuItemsLink = document.querySelectorAll(
  '.header__link[dropdown-toggler]'
);
const headerDropdownMenus = document.querySelectorAll('[dropdown-menu]');
if (headerMenuItemsLink.length > 0) {
  headerMenuItemsLink.forEach((element) => {
    element.addEventListener('click', dropdownToggler);
    element.addEventListener('mouseenter', hintBrowserForDropdown);
  });
}
function dropdownToggler(event) {
  let dropdownToggler = get_closest_element(event.target, '[dropdown-toggler]');
  if (!dropdownToggler) {
    return;
  }
  let dropdownMenu = get_sibling(dropdownToggler, '[dropdown-menu]');
  if (dropdownMenu.classList.contains('hide')) {
    dropdownMenu.classList.replace('hide', 'show');
  } else {
    dropdownMenu.classList.replace('show', 'hide');
  }
}
function dropdownController(event) {
  let dropdownItem = get_closest_element(event.target, '[dropdown-item]');
  if (dropdownItem && dropdownItem.matches('li[dropdown-item]')) {
    let dropdownMenu = get_closest_element(dropdownItem, '[dropdown-menu]');
    dropdownMenu.classList.replace('show', 'hide');
    return;
  }
  let dropdown = get_closest_element(event.target, '[dropdown]');
  if (dropdown) {
    return;
  }
  let dropdownMenus = document.querySelectorAll(
    '.header__dropdown-menu[dropdown-menu]'
  );
  dropdownMenus.forEach((element) => {
    if (element.classList.contains('show')) {
      element.classList.replace('show', 'hide');
    }
  });
}
function hintBrowserForDropdown() {
  let dropdownMenu = get_sibling(this, '[dropdown-menu]');
  dropdownMenu.style.willChange = 'transform, opacity';
}
function removeHintForDropdown() {
  this.style.willChange = 'auto';
}

document.addEventListener('click', dropdownController);
if (headerDropdownMenus.length > 0) {
  headerDropdownMenus.forEach((element) => {
    element.addEventListener('transitionend', removeHintForDropdown);
  });
}
