const themeName = getTheme();

setTheme(themeName);

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
