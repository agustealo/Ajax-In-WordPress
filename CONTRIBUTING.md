# Contributing to AjaxInWP Engine

## Principles

AjaxInWP is intentionally small. Prefer improving the existing WordPress rendering path over adding parallel routers, state stores, or duplicate template systems.

For PHP changes, follow WordPress conventions:

- sanitize external input
- escape output at the point it is rendered
- use capability checks for privileged operations
- verify nonces for state-changing browser requests
- prefer WordPress APIs over direct globals or database access

For navigation changes, preserve progressive enhancement: a normal link and normal server-rendered page must remain the fallback.

## Local verification

Run PHP syntax checks across the theme:

```bash
find . -name '*.php' -not -path './.git/*' -print0 | xargs -0 -n1 php -l
```

Check the browser runtime:

```bash
node --check assets/js/ajaxinwp.js
```

Check whitespace before committing:

```bash
git diff --check
```

## Pull requests

Keep pull requests focused. Describe the user-visible behavior, the authority being changed, and the verification performed.

Do not merge a change that breaks normal non-JavaScript navigation, introduces a second page-rendering protocol, or leaves the repository quality gate red.
