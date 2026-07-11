import './bootstrap';

document.addEventListener('alpine:init', () => {
    Alpine.store('toast', {
        items: [],

        push({ message, type = 'info', duration = 4000 }) {
            const id = Date.now() + Math.random();
            this.items.push({ id, message, type });
            setTimeout(() => this.remove(id), duration);
        },

        remove(id) {
            this.items = this.items.filter((item) => item.id !== id);
        },
    });

    Alpine.store('confirm', {
        open: false,
        title: '',
        message: '',
        confirmText: 'Confirm',
        cancelText: 'Cancel',
        _resolve: null,

        ask({ title = 'Are you sure?', message = '', confirmText = 'Confirm', cancelText = 'Cancel' }) {
            this.title = title;
            this.message = message;
            this.confirmText = confirmText;
            this.cancelText = cancelText;
            this.open = true;

            return new Promise((resolve) => {
                this._resolve = resolve;
            });
        },

        confirm() {
            this.open = false;
            if (this._resolve) this._resolve(true);
        },

        cancel() {
            this.open = false;
            if (this._resolve) this._resolve(false);
        },
    });
});

document.addEventListener('livewire:init', () => {
    Livewire.hook('request', ({ succeed, fail }) => {
        document.dispatchEvent(new CustomEvent('page-loader:start', { bubbles: true }));

        succeed(() => document.dispatchEvent(new CustomEvent('page-loader:stop', { bubbles: true })));
        fail(() => document.dispatchEvent(new CustomEvent('page-loader:stop', { bubbles: true })));
    });
});

function initRevealObserver() {
    const revealEls = document.querySelectorAll('[data-reveal]:not(.in-view)');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    revealEls.forEach(el => observer.observe(el));
}

function setFooterYear() {
    const el = document.getElementById('footer-year');
    if (el) el.textContent = new Date().getFullYear();
}

document.addEventListener('DOMContentLoaded', initRevealObserver);
document.addEventListener('DOMContentLoaded', setFooterYear);

// SPA-style page transitions via Livewire's wire:navigate
// (Livewire's own top nprogress bar already covers the thin-bar signal; the
// circular nav-loader below gives a second, more visible cue on slow loads)
// Note: 'livewire:navigate' fires immediately on click (true start of the
// fetch); 'livewire:navigating' only fires after the fetch resolves, right
// before the DOM swap — too late to use as a loading-start signal.
document.addEventListener('livewire:navigate', () => {
    document.dispatchEvent(new CustomEvent('nav-loader:start', { bubbles: true }));
    document.documentElement.classList.add('is-navigating');
});

document.addEventListener('livewire:navigated', () => {
    document.dispatchEvent(new CustomEvent('nav-loader:stop', { bubbles: true }));
    document.documentElement.classList.remove('is-navigating');
    initRevealObserver();
    setFooterYear();
});
