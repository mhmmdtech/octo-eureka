const homeHero = document.querySelector('.home-hero');
const heroItems = document.querySelectorAll('.home-hero__item');
homeHero.addEventListener('mouseenter', hintBrowserForHero);
homeHero.addEventListener('mouseleave', removeHintForHero);
function hintBrowserForHero() {
  heroItems.forEach((element) => {
    element.querySelector('.home-hero__overlay').style.willChange = 'opacity';
  });
}

function removeHintForHero() {
  heroItems.forEach((element) => {
    element.querySelector('.home-hero__overlay').style.willChange = 'auto';
  });
}
