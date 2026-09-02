# AjaxInWP Engine

AjaxInWP Engine is a classic WordPress theme that demonstrates **progressive, fetch-powered navigation** without replacing WordPress as the source of routing or rendered content.

Normal links still work as normal links. When JavaScript is available, same-origin page navigations are fetched in the background, the next page's `#ajax-container` is swapped into the current document, browser history is updated, and focus is moved to the new content. If anything goes wrong, navigation falls back to a normal page load.

## Requirements

- WordPress 6.3+
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
├── single.php
└── style.css
```

## Installation

1. Clone or download the repository.
2. Place the theme directory under `wp-content/themes/` or upload a ZIP through **Appearance → Themes → Add New → Upload Theme**.
3. Activate **AjaxInWP Engine**.
4. Assign a menu to the **Primary Menu** location.

For development, enable WordPress debugging in a non-production environment and run the repository quality checks before opening a pull request.

## Development contract

The server-rendered page is authoritative. Templates that participate in enhanced navigation must render a single `#ajax-container` containing the replaceable primary content.

Do not add another `template_redirect`, `admin-ajax.php`, or REST endpoint merely to duplicate normal page rendering. Dedicated APIs are appropriate for true data mutations or API resources, but page navigation should remain a normal WordPress request.

## Security notes

The fetch layer performs public GET navigation and does not treat a WordPress nonce as authorization. Mutating operations must use their own WordPress capability checks, nonce verification, input sanitization, and output escaping.

## Quality checks

GitHub Actions runs repository validation on pushes and pull requests. The gate checks:

- PHP syntax for every tracked PHP file
- JavaScript syntax for `assets/js/ajaxinwp.js`
- absence of the removed duplicate AJAX router
- presence of the progressive-navigation fallback contract
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
- updates theme compatibility metadata and documentation

## Contributing

See `CONTRIBUTING.md`.

## License

AjaxInWP Engine is licensed under the **GNU General Public License v2 or later**, matching the repository `LICENSE` file and the WordPress theme header.
