# AjaxInWP Engine

**Modern AJAX navigation for WordPress using the Fetch API, progressive enhancement, PHP, Bootstrap, and server-rendered WordPress templates.**

AjaxInWP Engine is a classic **WordPress AJAX theme** and developer reference for building **SPA-like WordPress navigation without turning WordPress into a JavaScript-only SPA**. It uses the browser **Fetch API**, `AbortController`, `DOMParser`, the History API, accessible focus management, and normal WordPress PHP templates to provide fast page transitions while preserving canonical URLs, SEO-friendly server rendering, browser back/forward behavior, and no-JavaScript fallback.

If you are searching for examples of **AJAX in WordPress**, **WordPress fetch navigation**, **WordPress AJAX page transitions**, **progressive enhancement in WordPress**, **PHP WordPress themes**, or **JavaScript navigation without jQuery**, this repository is designed as a compact, production-minded reference implementation.

## What this project demonstrates

- AJAX-style WordPress navigation with the native JavaScript Fetch API
- progressive enhancement over normal WordPress links and routes
- SPA-like page transitions without a client-side router
- server-rendered, crawlable WordPress HTML
- `history.pushState()` and browser back/forward navigation
- abortable requests with `AbortController`
- accessible focus and `aria-busy` state management
- reduced-motion-aware scrolling
- PHP 8+ WordPress theme development
- Bootstrap 5 integration without a jQuery navigation dependency
- WordPress theme structure, sidebars, widgets, menus, and template parts
- GitHub Actions validation for PHP and JavaScript

## Requirements

- WordPress 6.9+
- Tested with the current WordPress 7.1 release line
- PHP 8.0+
- A modern browser with `fetch`, `AbortController`, and `DOMParser`

The requirement headers live in `style.css`, which WordPress uses when validating theme compatibility.

## Why this architecture?

AjaxInWP v2 deliberately avoids maintaining a second server-side AJAX router.

```text
WordPress URL
    ↓
normal WordPress request
    ↓
server-rendered HTML
    ↓
#ajax-container
    ↓
optional fetch navigation enhancement
```

This preserves:

- canonical WordPress URLs
- server-side rendering and crawlable HTML
- browser back/forward behavior
- no-JavaScript navigation
- one template/rendering authority
- graceful fallback when a request fails

## Navigation behavior

`assets/js/ajaxinwp.js` intercepts eligible same-origin links. It intentionally leaves these alone:

- external links
- links with `target`
- downloads
- modifier-clicks and non-primary mouse buttons
- same-page fragment links
- `/wp-admin` and `/wp-login.php`

When a request starts, the current content receives `aria-busy="true"`. A newer navigation aborts an older in-flight request. Successful navigation updates the content, document title, browser history, active navigation state, focus, and scroll position.

A failed or malformed response falls back to `window.location.assign()`, so a JavaScript failure cannot strand the visitor on a broken pseudo-page.

## Theme assets

The theme loads:

- Bootstrap 5.3.8
- Bootstrap Icons 1.13.1
- `assets/css/general.css`
- `assets/js/ajaxinwp.js`

JavaScript is enqueued with WordPress' deferred loading strategy. The navigation runtime has no jQuery dependency.

## Theme structure

```text
Ajax-In-WordPress/
├── .github/workflows/quality.yml
├── assets/
│   ├── css/
│   ├── img/
│   └── js/ajaxinwp.js
├── helpers/
│   ├── bootstrap-comment-walker.php
│   └── bootstrap-menu-walker.php
├── inc/
│   └── widgets.php
├── partials/
├── comments.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── sidebar.php
├── single.php
└── style.css
```

## Installation

1. Clone or download the repository.
2. Place the theme directory under `wp-content/themes/` or upload a ZIP through **Appearance → Themes → Add New → Upload Theme**.
3. Activate **AjaxInWP Engine**.
4. Assign a menu to the **Primary Menu** location.
5. Configure the optional sidebar and widget areas under **Appearance → Widgets**.

For development, enable WordPress debugging in a non-production environment and run the repository quality checks before opening a pull request.

## Development contract

The server-rendered page is authoritative. Templates that participate in enhanced navigation must render a single `#ajax-container` containing the replaceable primary content.

Do not add another `template_redirect`, `admin-ajax.php`, or REST endpoint merely to duplicate normal page rendering. Dedicated APIs are appropriate for true data mutations or API resources, but page navigation should remain a normal WordPress request.

## Security notes

The fetch layer performs public GET navigation and does not treat a WordPress nonce as authorization. Mutating operations must use their own WordPress capability checks, nonce verification, input sanitization, and output escaping.

## Quality checks

GitHub Actions runs repository validation on pushes and pull requests. The gate checks:

- PHP syntax on PHP 8.0 and PHP 8.3
- JavaScript syntax for `assets/js/ajaxinwp.js`
- absence of the removed duplicate AJAX router
- presence of the progressive-navigation fallback contract
- valid document ownership between `header.php` and `footer.php`
- required sidebar/template wiring
- current WordPress compatibility metadata
- whitespace errors

## Version 2 modernization

The v2 runtime:

- removes two competing AJAX protocols
- removes the unused nonce/header contract
- removes jQuery from the navigation dependency chain
- aborts stale navigation requests
- preserves normal navigation as the failure fallback
- keeps WordPress server rendering authoritative
- removes redundant image regeneration during attachment metadata generation
- repairs invalid header/footer document boundaries
- repairs sidebar and partial-template ownership
- updates theme compatibility metadata and documentation

## Related search terms

`wordpress ajax` · `ajax wordpress theme` · `wordpress fetch api` · `wordpress ajax navigation` · `wordpress page transitions` · `wordpress spa navigation` · `progressive enhancement wordpress` · `wordpress php theme` · `wordpress javascript` · `fetch api wordpress` · `history api wordpress` · `abortcontroller wordpress` · `bootstrap wordpress theme` · `wordpress without jquery`

## Contributing

See `CONTRIBUTING.md`.

## License

AjaxInWP Engine is licensed under the **GNU General Public License v3**, matching the repository `LICENSE` file and the WordPress theme header.
