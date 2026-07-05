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
        document.dispatchEvent(new CustomEvent('page-loader:start'));

        succeed(() => document.dispatchEvent(new CustomEvent('page-loader:stop')));
        fail(() => document.dispatchEvent(new CustomEvent('page-loader:stop')));
    });
});
