const simplebars = document.querySelectorAll('.js-simplebar');
simplebars.forEach(initializeSimplebar);

function initializeSimplebar(element) {
  const simplebarInstance = new SimpleBar(element, {
    ariaLabel: element.dataset.simplebarTitle,
  });
  simplebarInstance.recalculate();
}
