const sidebarPanelToggler = document.querySelector('.header__hamburger');
const webBackdrop = document.querySelector('.web-backdrop');
const sidebarPanel = document.querySelector('.sidebar-panel');
if (sidebarPanelToggler) {
  sidebarPanelToggler.addEventListener('click', toggleSidebarPanel);
  sidebarPanelToggler.addEventListener('mouseenter', hintBrowserForSidebar);
  sidebarPanelToggler.addEventListener('transitionend', removeHintForSidebar);
}
if (webBackdrop) {
  webBackdrop.addEventListener('click', hideSidebarPanel);
}
function toggleSidebarPanel() {
  if (sidebarPanel.classList.contains('open')) {
    hideSidebarPanel();
  } else {
    showSidebarPanel();
  }
}
function showSidebarPanel() {
  sidebarPanel.classList.add('open');
  sidebarPanelToggler.classList.add('open');
  webBackdrop.classList.replace('hide', 'show');
}
function hideSidebarPanel() {
  sidebarPanel.classList.remove('open');
  sidebarPanelToggler.classList.remove('open');
  webBackdrop.classList.replace('show', 'hide');
}
function hintBrowserForSidebar() {
  sidebarPanel.style.willChange = 'transform';
  webBackdrop.style.willChange = 'opacity';
  this.querySelectorAll('.header__hamburger-line').forEach((element) => {
    element.style.willChange = 'transform';
  });
}
function removeHintForSidebar() {
  sidebarPanel.style.willChange = 'auto';
  webBackdrop.style.willChange = 'auto';
  this.querySelectorAll('.header__hamburger-line').forEach((element) => {
    element.style.willChange = 'auto';
  });
}
