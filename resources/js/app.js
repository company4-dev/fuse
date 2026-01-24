class App {
    constructor() {
        this.livewireHooks();
    }

    livewireHooks() {
        window.Livewire.on('scroll-to-top', () => {
            window.scrollTo({
                behavior: 'smooth',
                top: 0
            });
        });
    }
};

document.addEventListener('DOMContentLoaded', new App);
