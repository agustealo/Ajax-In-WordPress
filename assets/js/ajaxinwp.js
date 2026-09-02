class AjaxInWP {
    constructor() {
        this.controller = null;
        this.containerSelector = '#ajax-container';
        this.bindEvents();
    }

    bindEvents() {
        document.addEventListener('click', (event) => {
            const link = event.target.closest('a[href]');
            if (!link || !this.shouldHandle(link, event)) {
                return;
            }

            event.preventDefault();
            this.navigate(link.href, true);
        });

        window.addEventListener('popstate', () => {
            this.navigate(window.location.href, false);
        });
    }

    shouldHandle(link, event) {
        if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return false;
        }

        if (link.target || link.hasAttribute('download')) {
            return false;
        }

        const url = new URL(link.href, window.location.href);

        if (url.origin !== window.location.origin) {
            return false;
        }

        if (url.pathname.startsWith('/wp-admin') || url.pathname.startsWith('/wp-login.php')) {
            return false;
        }

        if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) {
            return false;
        }

        return true;
    }

    async navigate(url, updateHistory) {
        const currentContainer = document.querySelector(this.containerSelector);
        if (!currentContainer) {
            window.location.assign(url);
            return;
        }

        this.controller?.abort();
        this.controller = new AbortController();
        document.documentElement.classList.add('is-ajax-loading');
        currentContainer.setAttribute('aria-busy', 'true');

        try {
            const response = await fetch(url, {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    Accept: 'text/html',
                    'X-Requested-With': 'fetch'
                },
                signal: this.controller.signal
            });

            if (!response.ok) {
                throw new Error(`Request failed with ${response.status}`);
            }

            const html = await response.text();
            const nextDocument = new DOMParser().parseFromString(html, 'text/html');
            const nextContainer = nextDocument.querySelector(this.containerSelector);

            if (!nextContainer) {
                throw new Error('Response does not contain #ajax-container');
            }

            currentContainer.replaceChildren(...Array.from(nextContainer.childNodes).map((node) => node.cloneNode(true)));
            currentContainer.removeAttribute('aria-busy');
            currentContainer.setAttribute('tabindex', '-1');

            if (nextDocument.title) {
                document.title = nextDocument.title;
            }

            if (updateHistory) {
                window.history.pushState({}, '', url);
            }

            this.updateActiveNavigation(url);
            currentContainer.focus({ preventScroll: true });

            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                currentContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                currentContainer.scrollIntoView({ block: 'start' });
            }
        } catch (error) {
            if (error.name === 'AbortError') {
                return;
            }

            window.location.assign(url);
        } finally {
            currentContainer.removeAttribute('aria-busy');
            document.documentElement.classList.remove('is-ajax-loading');
        }
    }

    updateActiveNavigation(url) {
        const destination = new URL(url, window.location.href);

        document.querySelectorAll('.nav-link[href]').forEach((link) => {
            const linkUrl = new URL(link.href, window.location.href);
            const active = linkUrl.pathname === destination.pathname && linkUrl.search === destination.search;
            link.classList.toggle('active', active);

            if (active) {
                link.setAttribute('aria-current', 'page');
            } else {
                link.removeAttribute('aria-current');
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new AjaxInWP();
});
