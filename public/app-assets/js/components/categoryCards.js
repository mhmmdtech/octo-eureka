const categoryCards = document.querySelector('.category-cards');
const categoryCardItem = document.querySelectorAll('.category-cards__item');
categoryCards.addEventListener('mouseenter', hintBrowserForCategoryCards);
categoryCards.addEventListener('mouseleave', removeHintForCategoryCards);
function hintBrowserForCategoryCards() {
  categoryCardItem.forEach((element) => {
    element.querySelector('.category-cards__content div').style.willChange =
      'transform';
  });
}

function removeHintForCategoryCards() {
  categoryCardItem.forEach((element) => {
    element.querySelector('.category-cards__content div').style.willChange =
      'auto';
  });
}
