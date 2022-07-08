const themeName = getTheme();
const themeTogglers = document.querySelectorAll('button[data-theme-switcher]');

setTheme(themeName);

if (themeTogglers.length > 0) {
  themeTogglers.forEach((themeToggler) => {
    themeToggler.addEventListener('click', switchTheme);
  });
}

function switchTheme(event) {
  const themeToggler = event.target;
  const themeName = themeToggler.dataset.themeSwitcher.toLowerCase();
  setTheme(themeName);
}

function setTheme(themeName) {
  switch (themeName) {
    case 'light':
      themeName = 'light';
      break;
    case 'dark':
      themeName = 'dark';
      break;
    default:
      themeName = getThemeFromSystem();
      break;
  }
  localStorage.setItem('app-theme', themeName);
  document.documentElement.setAttribute('data-theme', themeName);
}

function getThemeFromLocalStorage() {
  let themeName = localStorage.getItem('app-theme');
  return themeName;
}

function getThemeFromSystem() {
  const darkThemeMq = window.matchMedia('(prefers-color-scheme: dark)');
  const systemTheme = darkThemeMq.matches ? 'dark' : 'light';
  return systemTheme;
}

function getTheme() {
  const localStorageTheme = getThemeFromLocalStorage();
  const systemTheme = getThemeFromSystem();
  let themeName = localStorageTheme.toLowerCase();
  switch (themeName) {
    case 'light':
      themeName = 'light';
      break;
    case 'dark':
      themeName = 'dark';
      break;
    default:
      themeName = systemTheme;
      break;
  }
  return themeName;
}
