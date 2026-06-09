# Dexville FSE Starter Theme

A lean, performance-first WordPress full site editing (FSE) block theme built to replace page-builder bloat across SME client sites.

## North Star

Minimal CSS/JS. Only the assets a page actually uses get loaded. Top Core Web Vitals out of the box, *before* any caching or CDN. Every client site self-contained and easy to maintain.

## Features

- **Full Site Editing (FSE)** - theme.json-driven, zero legacy cruft
- **ACF-first custom blocks** - PHP render templates, no front-end JS
- **Aggressive performance cleanup** - separate block assets, no emoji scripts, minimal head clutter
- **System fonts** - zero external font requests
- **Curated pattern library** - locked, content-fillable sections
- **ACF local JSON** - version-controlled field groups, auto-synced across environments

## Phase 1 Complete ✓

The theme is now scaffolded with:

- `style.css` - theme header metadata
- `theme.json` - tight performance-first settings with neutral palette and system fonts
- `functions.php` - bootstraps modules from /inc
- `inc/cleanup.php` - comprehensive performance optimizations
- Directory structure for assets, templates, patterns, blocks
- Build tooling ready for native blocks when needed

**Current state:** Activatable theme that loads almost no CSS/JS and should score ~100 on Lighthouse on an empty page.

## Requirements

- **WordPress:** 6.4+
- **PHP:** 8.0+
- **Node.js:** 18+
- **ACF Pro:** Unlimited license (required plugin for all client sites)

## Local Development Setup

### 1. Install Dependencies

```bash
npm install
```

### 2. Add ACF Pro to wp-env

**Option A: Local zip file**

Download ACF Pro from your account, then edit `.wp-env.json` and add to the `plugins` array:

```json
"plugins": [
  "./path/to/advanced-custom-fields-pro.zip",
  "https://downloads.wordpress.org/plugin/classic-editor.latest-stable.zip"
]
```

**Option B: Direct path**

If you have ACF Pro extracted locally, you can mount it directly:

```json
"mappings": {
  "wp-content/plugins/advanced-custom-fields-pro": "./path/to/acf-pro-folder"
}
```

**Option C: Create a local ACF directory**

```bash
mkdir -p .acf-pro
# Extract ACF Pro zip into .acf-pro/
# Add .acf-pro/ to .gitignore if not already there
```

Then update `.wp-env.json`:

```json
"mappings": {
  "wp-content/plugins/advanced-custom-fields-pro": "./.acf-pro"
}
```

### 3. Start wp-env

```bash
npm run env:start
```

This will:
- Spin up WordPress at `http://localhost:8888`
- Admin: `http://localhost:8888/wp-admin` (admin/password)
- Mount this theme automatically
- Install ACF Pro (if configured above)
- Enable debugging for development

### 4. Activate the Theme

1. Go to `http://localhost:8888/wp-admin`
2. Navigate to Appearance → Themes
3. Activate "Dexville FSE Starter"

### 5. Verify Performance

Create a blank page, publish it, and test with Lighthouse. You should see excellent Core Web Vitals scores right out of the box.

## Other Useful Commands

```bash
# Stop wp-env
npm run env:stop

# Destroy wp-env (clean slate)
npm run env:destroy

# Build native blocks (when Phase 4 adds them)
npm run build

# Watch/develop native blocks
npm run start
```

## Project Structure

```
dexville-fse-starter/
├── style.css              # Theme header metadata
├── theme.json             # Global settings + styles
├── functions.php          # Theme setup + module loader
├── .wp-env.json          # Local dev environment
├── package.json          # Build scripts
├── /inc                  # Theme modules
│   └── cleanup.php       # Performance optimizations ★
├── /assets               # Fonts, CSS, JS, images
├── /templates            # FSE templates (coming in Phase 2)
├── /parts                # Header, footer parts (coming in Phase 2)
├── /patterns             # Block patterns (coming in Phase 3)
├── /styles               # theme.json variations (coming in Phase 3)
├── /blocks               # ACF + native blocks (coming in Phase 4)
├── /acf-json             # ACF field groups (auto-synced)
└── /build                # Compiled native blocks (appears in Phase 4)
```

## Next Phases

**Phase 2:** Templates + parts (header, footer, page, single, archive, etc.)

**Phase 3:** Pattern library + style variations

**Phase 4:** Custom blocks (ACF-first) + ACF local JSON setup

**Phase 5:** Dashboard (ACF Options Page + field bindings)

**Phase 6:** Performance + polish pass

See `CLAUDE.md` for the complete build brief.

## Distribution Model

This is a **template repository**. Clone per client:

```bash
# For a new client
git clone <this-repo> client-name-theme
cd client-name-theme
# Customize theme.json color palette, create a style variation, add logo
```

Per-client customization = style variation + settings, not a code fork.

## Performance Notes

The `inc/cleanup.php` file is the performance lever. It:

- ✓ Enables per-block CSS loading
- ✓ Removes emoji detection scripts
- ✓ Dequeues unused block library styles
- ✓ Cleans `<head>` clutter
- ✓ Disables wp-embed.js
- ✓ Dequeues jQuery on front-end
- ✓ Removes global SVG filters
- ✓ Disables block directory

All optimizations are documented inline with comments.

## License

GPL v2 or later

---

**Need help?** See `CLAUDE.md` for the complete project brief and architecture decisions.
