class AjaxinWP {
    constructor() {
        this.isLoading = false; // Track loading state to prevent infinite loops
        this.initialize();
    }

    initialize() {
        document.addEventListener('click', event => {
            const target = event.target.closest('a');
            if (target && this.isInternalLink(target)) {
                if (target.classList.contains('dropdown-toggle') && !target.href.endsWith('#')) {
                    // Ensure top-level link with sub-menu works
                    event.preventDefault();
                    this.loadContent(target.href);
                } else if (!target.classList.contains('dropdown-toggle') || !target.nextElementSibling.classList.contains('dropdown-menu')) {
                    event.preventDefault();
                    this.loadContent(target.href);
                }
            }
        });

        window.addEventListener('popstate', () => {
            this.loadContent(window.location.href, false);
        });

        this.initializeDropdowns();
        this.updateStateBasedOnPage(window.location.href);
    }

    isInternalLink(link) {
        return link.hostname === window.location.hostname && !link.hasAttribute('target');
    }

    getAjaxContainer() {
        return document.querySelector('#ajax-container');
    }

    showLoader() {
        const loader = `<div id="loader" class="loader-overlay">
            <div class="spinner"></div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', loader);
    }

    hideLoader() {
        const loader = document.getElementById('loader');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => loader.remove(), 500); // Duration should match CSS transition duration
        }
    }

    loadContent(url, updateHistory = true) {
        if (this.isLoading) return; // Prevent multiple simultaneous loads

        const container = this.getAjaxContainer();
        if (!container) {
            console.error('ajax-container element not found.');
            return;
        }

        this.isLoading = true; // Set loading state

        // Start fade out animation
        container.style.opacity = '0';

        // Show loader animation
        this.showLoader();

        fetch(url, {
            headers: {
                'X-WP-Nonce': ajaxinwp_params.nonce
            }
        })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const ajaxContainerContent = doc.querySelector('#ajax-container');
                if (ajaxContainerContent) {
                    setTimeout(() => {
                        container.innerHTML = ajaxContainerContent.innerHTML;
                        this.initializeDropdowns(); // Reinitialize dropdowns
                        this.updateActiveNavLinks(url); // Update active class on navigation links
                        this.updateStateBasedOnPage(url); // Update state based on the current page
                        this.focusContent(url); // Focus on content after loading
                        // Start fade in animation after content has been updated
                        container.style.opacity = '1';
                        this.isLoading = false; // Reset loading state
                    }, 500); // Adjust the delay to match your transition duration
                } else {
                    console.error('ajax-container not found in fetched HTML.');
                    container.innerHTML = '<div class="alert alert-danger">Error loading content.</div>';
                    this.isLoading = false; // Reset loading state
                }
                if (updateHistory) {
                    window.history.pushState({}, '', url);
                }
            })
            .catch(() => {
                console.error('Error loading content.');
                container.innerHTML = '<div class="alert alert-danger">Error loading content.</div>';
                // Start fade in animation even if there's an error to prevent a blank screen
                container.style.opacity = '1';
                this.isLoading = false; // Reset loading state
            })
            .finally(() => {
                // Hide loader animation
                this.hideLoader();
            });
    }

    initializeDropdowns() {
        // Ensure that Bootstrap dropdowns work after AJAX content load
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            const dropdownMenu = toggle.nextElementSibling;
            if (dropdownMenu) {
                toggle.addEventListener('mouseover', () => {
                    dropdownMenu.classList.add('show');
                    toggle.setAttribute('aria-expanded', 'true');
                });
                toggle.addEventListener('mouseout', () => {
                    setTimeout(() => {
                        if (!dropdownMenu.matches(':hover') && !toggle.matches(':hover')) {
                            dropdownMenu.classList.remove('show');
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    }, 100);
                });

                dropdownMenu.addEventListener('mouseover', () => {
                    dropdownMenu.classList.add('show');
                    toggle.setAttribute('aria-expanded', 'true');
                });
                dropdownMenu.addEventListener('mouseout', () => {
                    setTimeout(() => {
                        if (!dropdownMenu.matches(':hover') && !toggle.matches(':hover')) {
                            dropdownMenu.classList.remove('show');
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    }, 100);
                });
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', event => {
            if (!event.target.closest('.dropdown-menu') && !event.target.closest('.dropdown-toggle')) {
                const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                openDropdowns.forEach(menu => menu.classList.remove('show'));
            }
        });
    }

    updateActiveNavLinks(url) {
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            if (link.href === url) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    focusContent(url) {
        const container = this.getAjaxContainer();
        if (container) {
            let offset = 0;

            if (!this.isHomePage(url) && !document.querySelector('.hero-header')) {
                offset = 10 * parseFloat(getComputedStyle(document.documentElement).fontSize);
            }

            window.scrollTo({
                top: container.offsetTop - offset,
                behavior: 'smooth'
            });
            container.setAttribute('tabindex', '-1');
            container.focus();
        }
    }

    isHomePage(url) {
        const homePages = [ajaxinwp_params.homeURL, ajaxinwp_params.homeURL + '/index.php', ajaxinwp_params.homeURL + '/home'];
        const urlObj = new URL(url);
        const path = urlObj.pathname.replace(/\/$/, ''); // Remove trailing slash if present
        return homePages.includes(path) || path === '';
    }

    updateStateBasedOnPage(url) {
        const isHomePage = this.isHomePage(url);
        const masthead = document.getElementById('masthead');

        if (isHomePage || url.endsWith('/index.php')) {
            masthead.style.display = 'block';
        } else {
            masthead.style.display = 'none';
        }
        
        console.log(`Page URL: ${url}`);
        // Example: Update a state variable, initialize a plugin, etc.
    }
}

// Create an instance of the AjaxinWP class
document.addEventListener('DOMContentLoaded', () => {
    new AjaxinWP();
});
