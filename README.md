# Dexville FSE Starter Theme

A lean, performance-first WordPress full site editing (FSE) block theme built to replace page-builder bloat across SME client sites.

## 🎯 North Star

Minimal CSS/JS. Only the assets a page actually uses get loaded. Top Core Web Vitals out of the box, *before* any caching or CDN. Every client site self-contained and easy to maintain.

## ✨ Features

- **Full Site Editing (FSE)** - theme.json-driven, zero legacy cruft
- **ACF-first custom blocks** - PHP render templates, no front-end JS
- **Aggressive performance cleanup** - per-block CSS, no emoji scripts, minimal head clutter
- **System fonts** - zero external font requests
- **7 content patterns** - hero, features, CTA, testimonials, blog grid, contact
- **3 style variations** - default, dark mode, warm & earthy
- **2 ACF blocks** - FAQ Accordion (with schema), Logo Strip (CSS marquee)
- **Options page + bindings** - site-wide settings synced to blocks
- **ACF local JSON** - version-controlled field groups, auto-synced across environments

## 📦 What's Included

### All 5 Development Phases Complete

✅ **Phase 1: Performance-First Scaffold**
- Tight `theme.json` with system fonts & constrained scales
- `inc/cleanup.php` - comprehensive performance optimizations
- Directory structure ready for content

✅ **Phase 2: Full Template Library**
- 8 templates: index, page, single, archive, front-page, search, 404, + parts
- Semantic HTML5, Query Loops, proper post meta
- Header (logo + nav) & Footer (nav + social + copyright)

✅ **Phase 3: Pattern Library + Style Variations**
- **7 Patterns:** Hero, Feature Grid, CTA Band, Content+Image, Testimonial, Blog Grid, Contact
- **3 Style Variations:** Default (blue), Dark Mode, Warm & Earthy
- All use theme.json presets, no inline CSS

✅ **Phase 4: ACF Custom Blocks**
- **FAQ Accordion:** `<details>` element, FAQPage schema, zero JS
- **Logo Strip:** CSS-only marquee, optional links, grayscale hover
- Auto-registered via `block.json`, fields in `/acf-json`

✅ **Phase 5: Dashboard & Bindings**
- **ACF Options Page:** Contact, Social, Tracking, Business info
- **11 Block Bindings:** Phone, email, address, social URLs, business name
- Auto-outputs Google Analytics/GTM code

## 🚀 Quick Start

### Requirements

- **WordPress:** 6.4+
- **PHP:** 8.0+
- **Node.js:** 18+ (for local dev only)
- **ACF Pro:** Unlimited license (required)

### Local Development

```bash
# 1. Clone the repo
git clone <this-repo> my-client-theme
cd my-client-theme

# 2. Install dependencies
npm install

# 3. ACF Pro is already in /vendor - just start wp-env
npm run env:start

# 4. Access your site
# Frontend: http://localhost:8888
# Admin:    http://localhost:8888/wp-admin (admin/password)

# 5. Activate the theme
# Go to Appearance → Themes → Activate "Dexville FSE Starter"
```

The theme will auto-load with ACF Pro activated and all field groups synced from `/acf-json`.

### Production Deployment

```bash
# 1. Ensure ACF Pro is installed on production
# 2. Upload theme to /wp-content/themes/
# 3. Activate theme
# 4. Field groups auto-sync from /acf-json
# 5. Fill in Site Settings (admin menu)
```

**No build step needed!** ACF blocks use PHP render templates.

## 📖 How to Use

### Site Settings

**Go to:** Site Settings (admin menu)

Fill in:
- **Contact:** Phone, email, address, hours
- **Social:** Facebook, Instagram, LinkedIn, Twitter, YouTube
- **Tracking:** Google Analytics/GTM ID, Facebook Pixel
- **Business:** Name, type (schema.org), description

### Block Bindings

Connect core blocks to settings values:

1. Add a **Paragraph** or **Heading** block
2. Click block → **Advanced** → **Attributes**
3. Click **"+ Add binding"** next to "Content"
4. Choose: Contact Phone, Contact Email, Business Name, etc.
5. Block now displays live data from Site Settings!

**Update once in settings = changes everywhere.**

### Custom Blocks

**Insert via block inserter (+):**

**FAQ Accordion**
- Add questions & answers via repeater
- Outputs FAQPage JSON-LD schema
- Pure CSS accordion (no JS)

**Logo Strip**
- Upload partner/client logos
- Optional marquee animation (CSS only)
- Links per logo, background color picker

### Patterns

**Insert via Patterns tab:**

Find under these categories:
- **Dexville Patterns** (all 7)
- **Banner** (Hero)
- **Call to Action** (CTA Band)
- **Columns** (Feature Grid, Content+Image)
- **Contact** (Contact Section)
- **Posts** (Blog Grid)

### Style Variations

**Change theme colors:**

1. Go to **Appearance → Editor**
2. Click **Styles** (paintbrush icon)
3. Browse: Default, Dark Mode, Warm & Earthy
4. Click to preview, save to apply

## 🎨 Customization Per Client

**Don't fork the code.** Customize via:

1. **Create a style variation** in `/styles/client-name.json`
2. **Upload logo** in Site Settings
3. **Set colors** in the style variation
4. **Fill in Site Settings**

Example `/styles/client-name.json`:

```json
{
  "$schema": "https://schemas.wp.org/wp/6.7/theme.json",
  "version": 3,
  "title": "Client Name",
  "settings": {
    "color": {
      "palette": [
        {
          "slug": "primary",
          "color": "#your-brand-color",
          "name": "Primary"
        }
      ]
    }
  }
}
```

## 📁 Project Structure

```
dexville-fse-starter/
├── style.css                    # Theme metadata
├── theme.json                   # Global settings + styles
├── functions.php                # Module loader
├── CLAUDE.md                    # Build brief (architecture decisions)
├── README.md                    # This file
│
├── /inc                         # PHP modules
│   ├── cleanup.php              # Performance optimizations ★
│   ├── patterns.php             # Pattern registration
│   ├── blocks.php               # ACF block registration
│   ├── options.php              # Options page + helpers
│   └── bindings.php             # Block binding sources
│
├── /templates                   # FSE templates (.html)
│   ├── index.html              # Fallback / blog listing
│   ├── page.html               # Static pages
│   ├── single.html             # Blog posts
│   ├── archive.html            # Category/tag archives
│   ├── front-page.html         # Homepage
│   ├── search.html             # Search results
│   └── 404.html                # Not found
│
├── /parts                       # Template parts
│   ├── header.html             # Site header
│   └── footer.html             # Site footer
│
├── /patterns                    # Block patterns (.php)
│   ├── hero.php
│   ├── feature-grid.php
│   ├── cta-band.php
│   ├── content-image.php
│   ├── testimonial.php
│   ├── blog-grid.php
│   └── contact-section.php
│
├── /styles                      # Style variations (.json)
│   ├── default.json
│   ├── dark.json
│   └── warm.json
│
├── /blocks                      # ACF blocks
│   ├── /faq-accordion
│   │   ├── block.json          # Block metadata
│   │   ├── render.php          # PHP template
│   │   ├── style.css           # Front-end CSS
│   │   └── editor.css          # Editor CSS
│   └── /logo-strip
│       ├── block.json
│       ├── render.php
│       ├── style.css
│       └── editor.css
│
├── /acf-json                    # ACF field groups (auto-synced)
│   ├── group_faq_accordion.json
│   ├── group_logo_strip.json
│   └── group_site_settings.json
│
├── /assets                      # Static assets
│   ├── /fonts                  # Self-hosted fonts
│   ├── /css                    # Custom CSS (if needed)
│   ├── /js                     # Custom JS (if needed)
│   └── /images                 # Theme images
│
├── /build                       # Native blocks (future use)
└── /vendor                      # ACF Pro (gitignored except .gitkeep)
```

## ⚡ Performance Features

The `inc/cleanup.php` module aggressively optimizes WordPress:

- ✅ **Per-block CSS loading** - only CSS for blocks on the page
- ✅ **No emoji scripts** - removes detection JS/CSS
- ✅ **No jQuery** - dequeued on front-end (unless needed by a block)
- ✅ **Clean `<head>`** - removes RSD, wlwmanifest, generator, shortlink, oEmbed discovery
- ✅ **No wp-embed.js** - disabled (re-enable if needed)
- ✅ **No SVG filters** - removes duotone global styles
- ✅ **No block directory** - prevents external API calls in editor
- ✅ **System fonts** - zero external font requests
- ✅ **ACF blocks = server-rendered** - zero front-end JS

**Expected Lighthouse scores (before caching):** 95-100

## 🔧 NPM Scripts

```bash
npm run env:start      # Start wp-env
npm run env:stop       # Stop wp-env
npm run env:destroy    # Destroy wp-env

npm run start          # Watch native blocks (future use)
npm run build          # Build native blocks (future use)
npm run lint:css       # Lint CSS
npm run lint:js        # Lint JavaScript
```

## 🌐 Distribution Model

This is a **template repository**:

1. **Clone per client:** `git clone <this-repo> client-name-theme`
2. **Customize:** Create style variation, add logo, fill settings
3. **Deploy:** Upload to hosting, activate ACF Pro, activate theme
4. **Field groups auto-sync** from `/acf-json`

**Pull starter updates:**

```bash
# In client repo
git remote add upstream <starter-repo-url>
git fetch upstream
git merge upstream/main
```

## 📝 License

GPL v2 or later

---

## 🆘 Support & Documentation

- **Build Brief:** See `CLAUDE.md` for architecture decisions
- **ACF Pro Docs:** https://www.advancedcustomfields.com/resources/
- **FSE Handbook:** https://developer.wordpress.org/themes/block-themes/
- **Block Bindings:** https://developer.wordpress.org/block-editor/reference-guides/block-api/block-bindings/

---

**Built with performance, maintainability, and developer experience in mind.** 🚀
