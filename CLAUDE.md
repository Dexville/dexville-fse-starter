# WordPress FSE Starter Theme — Build Brief

**Purpose.** A lean, fast reusable block theme to replace page-builder bloat (Impreza) across SME client sites. Commit this file to the repo (e.g. as `PROJECT.md` or `CLAUDE.md`) — it is the source of truth and the kickoff brief for Claude Code.

---

## North star

Minimal CSS/JS. Only the assets a page actually uses get loaded. Top Core Web Vitals out of the box, *before* any caching or CDN. Every client site self-contained and easy to maintain.

---

## Decisions (locked)

- **Theme type:** full block theme (FSE), `theme.json`-driven.
- **Content building:** core blocks + a curated pattern library + locked templates for the bulk of layouts.
- **Custom blocks:** **ACF-first** (PHP render templates + ACF fields). Native blocks (`block.json` + JS build) are reserved for components that need real front-end interactivity (Interactivity API) or that you want fully portable and dependency-free.
- **Dynamic content:** prefer the Query Loop block and Block Bindings (including ACF field bindings) *before* writing any custom block.
- **Plugin dependency:** **ACF Pro** (unlimited license) is a required, active plugin on every client site — it backs the custom-block layer and the settings page. The *foundation* — patterns, templates, Query Loop, `theme.json`, the cleanup pass — stays dependency-free and keeps working even if ACF is ever down.
- **Field versioning:** ACF field groups are version-controlled via **local JSON** in `/acf-json`, so field definitions sync automatically across every clone and environment.
- **Distribution:** GitHub **template** repo, cloned per client. Per-client look = a `theme.json` style variation (`/styles`) + logo + settings, not a code fork.
- **Dashboard:** **ACF Options Page** (ACF is already a committed dependency, so this is far less code than the Settings API and binds straight into core blocks). The native Settings API remains the fallback if you ever want the settings layer dependency-free.
- **Local dev:** `wp-env` (Docker) — mount ACF Pro via a local zip/path, since it isn't on wp.org. **Build:** `@wordpress/scripts`, added only once you build your first native block. **Deploy:** push to Git → Kinsta / Plesk.

---

## Folder structure

```
starter-theme/
├── style.css                 # theme header metadata only
├── theme.json                # global settings + styles — the perf lever
├── functions.php             # bootstraps /inc modules, theme supports, enqueues
├── package.json              # @wordpress/scripts — only needed once a native block exists
├── .wp-env.json              # local dev (mount ACF Pro via local path/zip)
├── .gitignore                # node_modules, optionally /build
├── PROJECT.md                # this brief
├── /acf-json                 # ACF local JSON — version-controlled field groups, auto-syncs across sites
├── /assets
│   ├── /fonts                # self-hosted fonts (no external font request)
│   ├── /css                  # minimal hand-written global CSS, if any
│   ├── /js                   # minimal front-end JS, only if needed
│   └── /images
├── /templates                # FSE templates: index, front-page, page, single, archive, search, 404 (.html)
├── /parts                    # header.html, footer.html, ...
├── /patterns                 # PHP-registered block patterns: hero.php, cta.php, ...
├── /styles                   # theme.json style variations = per-client skins
├── /inc
│   ├── cleanup.php           # the performance dequeue pass
│   ├── blocks.php            # registers ACF blocks (from /blocks) + native blocks (from /build)
│   ├── bindings.php          # custom (non-ACF) Block Bindings sources, if any
│   ├── patterns.php          # pattern category + registration helpers
│   └── options.php           # ACF Options Page + helper getters
├── /blocks
│   ├── /faq-accordion        # ACF block — no JS build
│   │   ├── block.json        # "acf": { "renderTemplate": "render.php" }
│   │   ├── render.php        # PHP template using get_field()
│   │   ├── style.css         # front-end CSS (enqueued via block.json)
│   │   └── editor.css        # editor-only CSS
│   └── /interactive-hero     # native block — built with @wordpress/scripts
│       ├── block.json
│       ├── index.js          # editor registration
│       ├── edit.js
│       ├── view.js           # Interactivity API / front-end behaviour
│       └── style.scss
└── /build                    # compiled native blocks (appears once you add one)
```

---

## Performance cleanup (`/inc/cleanup.php`)

The point of the whole project lives here. ACF runs admin-side and ACF blocks render server-side with no front-end JS, so the dependency doesn't threaten any of this — the leanness target is unchanged. Headline items:

- `add_filter('should_load_separate_core_block_assets', '__return_true');` — only the CSS for blocks present on a page loads, instead of the full block library.
- Remove emoji detection script + styles (`print_emoji_detection_script`, `print_emoji_styles`, etc.).
- Dequeue `wp-block-library-theme` / `classic-themes.css` if unused.
- Drop head clutter: RSD link, `wlwmanifest`, generator tag, shortlink, oEmbed discovery (if unused), REST API discovery links (if unused).
- Disable `wp-embed.js` if you don't embed WP content.
- No jQuery on the front end unless a block needs it.
- Self-host fonts via `theme.json` `fontFamilies` — zero external font requests.
- Keep `theme.json` tight so the inline global-styles block stays small (do **not** blanket-remove global styles — FSE relies on them).
- Images: rely on core lazy-loading + correct `sizes`; serve AVIF/WebP where possible.

---

## `theme.json` scope

- **settings:** `appearanceTools: true`; a constrained color palette + typography scale (lock down what clients shouldn't touch — disable custom colors/gradients/font sizes as needed); spacing scale; `layout.contentSize` / `layout.wideSize`.
- **styles:** global typography, spacing, link/button element styles, block-level defaults.
- **`/styles` variations:** ship a `default` skin plus per-client skins (color + font presets). A new client mostly = a new variation file + logo + settings.

---

## Pattern library (initial set)

Pure core-block patterns unless noted:

- Hero (heading + lede + buttons over Cover/Group)
- Feature grid (Columns + icons/headings)
- CTA band
- Content + image (alternating)
- Testimonial / quote
- Logo strip → *ACF block (see below)*
- FAQ → *ACF block (see below)*
- Contact section (details pulled from the options page via bindings)
- Blog / post grid (Query Loop)
- Team grid (Query Loop over a `team` CPT, or pattern)

Lock the structural patterns in templates so editors fill content without breaking layout.

---

## Custom blocks (ACF-first)

**Decision rule for each block:** build it as an **ACF block** by default. Reach for a **native block** only when (a) it needs genuine front-end interactivity (Interactivity API), or (b) you want that specific block fully portable and dependency-free.

Initial shortlist:

1. **FAQ accordion** — **ACF**. PHP render using a `<details>`/CSS toggle, emits FAQPage JSON-LD. No JS.
2. **Logo strip / carousel** — **ACF** with a CSS-only marquee; go native if you want real slider controls.
3. **Project / CPT grid** — **ACF** for the static grid (fields: source CPT, count, layout). Go **native** if you want client-side filtering.
4. **Stats / pricing / team grid** — **ACF** (data-heavy, static).
5. *(When needed)* **Interactive hero** — **native** (Interactivity API + `view.js`).

**ACF block mechanics:** register via `block.json` with the `acf` key + `renderTemplate`; define fields in the ACF UI and commit them through `/acf-json`. No build step.

**Native block mechanics:** `block.json` + `@wordpress/scripts`; add the JS toolchain only when you build the first one.

---

## Dashboard / settings (`/inc/options.php`)

ACF Options Page for the per-client config that shouldn't live in code:

- **Contact:** address, phone, email, opening hours.
- **Social:** profile links.
- **Tracking:** GA4 / GTM ID, optional pixel ID.
- **Business / schema:** data for a LocalBusiness JSON-LD block.
- **Toggles:** header/footer options, e.g. show/hide top bar.

Surface values two ways: a small helper getter for use inside templates/patterns, and **ACF field bindings** so a core paragraph/heading/image can display an options value (e.g. the phone number) — edited in one place, rendered anywhere. *Fallback:* if you want the settings layer dependency-free, swap this for a native Settings API page in `inc/settings-page.php` and register custom binding sources in `inc/bindings.php`.

---

## Local dev, build, deploy

- **`.wp-env.json`** spins up a local WP with the theme mounted; add ACF Pro via a local path/zip in the `plugins` array (it isn't on wp.org). Run `npx wp-env start`.
- **`package.json` scripts** (via `@wordpress/scripts`): `start` (watch) and `build` (production) compile native blocks from `/blocks` → `/build`. Defer this until your first native block.
- **Git:** template repo; clone per client; merge from upstream to pull starter updates into a client repo. `/acf-json` keeps field groups in sync on each clone.
- **Deploy:** build locally, push, deploy the built theme to Kinsta/Plesk. (GitHub Actions build-on-push can come later — keep v1 simple.)

---

## Build phases

1. **Scaffold** — repo, `.wp-env.json` (with ACF Pro mounted), `style.css`, base `theme.json`, `functions.php` + `/inc/cleanup.php`. Goal: a near-empty site that already scores ~100 on Lighthouse.
2. **Templates + parts** — header/footer parts, page/single/archive/index/search/404/front-page templates.
3. **Pattern library + `/styles`** — the locked, content-fillable sections and the default skin.
4. **Custom blocks (ACF-first)** — set up `/acf-json` local JSON sync, then build the ACF blocks (`block.json` + `render.php` + field group). Add the `@wordpress/scripts` toolchain and any native interactive block only when needed.
5. **Dashboard** — ACF Options Page + helper getters + ACF field bindings into core blocks.
6. **Perf + polish pass** — Lighthouse/PSI audit, image strategy, Cloudflare/Kinsta caching, final dequeue audit, accessibility check.

---

## Customise per project / before scaffolding

- **Design direction + default skin** — colors, typography, motion language for the `default` style variation.
- **Final pattern list** — which sections this brand actually needs.
- **Final custom-block list** — confirm which are ACF vs native.
- **Final settings list** — confirm the options-page fields above.