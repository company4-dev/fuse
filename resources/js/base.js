import './bootstrap';

document.documentElement.dataset['bsTheme'] = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
    document.documentElement.dataset['bsTheme'] = event.matches ? 'dark' : 'light';
});
