class App {
    page = null;

    constructor() {
        document.addEventListener('livewire:initialized', () => {
            this.livewireHooks();
            this.watchNotifications();
        });
    }

    livewireHooks() {
        window.Livewire.on('scroll-to-top', () => {
            window.scrollTo({
                behavior: 'smooth',
                top: 0
            });
        });
    }

    watchNotifications() {
        const badge = document.querySelector('[wire\\:ref="notifications"] [data-flux-navlist-badge]');

        window.Livewire.on('notifications-updated', (data) => {
            badge.innerHTML = data[0];
        });
    }
};

document.addEventListener('DOMContentLoaded', new App);
