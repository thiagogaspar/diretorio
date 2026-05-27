---
name: frontend-blade
description: "Use quando editar Blade views, Tailwind CSS v4, design tokens, Alpine.js data/init, vis-network config, Vite config, HTML/CSS, componentes de UI. Domínios: layouts, partials, componentes reutilizáveis, dark mode, responsive design, design system, gráficos vis-network, galeria lightbox, Alpine.js interactivity."
license: MIT
---

# Frontend Blade + Tailwind — LISTA

## Design System

### Tokens (definidos em `resources/css/app.css` via `@theme`)
```
brand-50  → brand-900  (Emerald)    → bands, CTAs
accent-50 → accent-900 (Purple)     → artists
warm-50   → warm-900   (Amber)      → relationships
surface-50→ surface-900 (Warm gray) → bg, borders, text
ink-50    → ink-900                 → dark mode text
```

### Componentes Reutilizáveis (`resources/views/components/`)
- `infobox.blade.php` — Wikipedia-style info table (props: title, items)
- `breadcrumb.blade.php` — breadcrumb com schema.org
- `data-table.blade.php` — tabela genérica (props: columns, rows)
- `genealogy-graph.blade.php` — vis-network wrapper
- `image-gallery.blade.php` — Alpine.js lightbox
- `meta-tags.blade.php` — SEO + Open Graph + JSON-LD
- `seo-meta.blade.php` — wrapper para SeoData
- `ad-slot.blade.php` — ad placeholder
- `section-header.blade.php` — heading com suporte a `$attributes->merge()`

### Dark Mode
- Classe `.dark` no `<html>` via Flux + localStorage
- Variantes `.dark:` em todas as cores
- Alternância via `flux:profile` dropdown ou toggle

### CSS Utilities Customizadas
`badge`, `badge-brand`, `badge-surface`, `badge-accent`, `btn`, `btn-brand`, `btn-ghost`, `input`, `select`, `card`, `card-hover`, `prose`, `prose-serif`, `stat`, `stat-value`, `stat-desc`, `link`, `divider`, `breadcrumb`, `section-header`, `infobox`, `infobox-label`, `infobox-value`, `newspaper-grid`

### JS
- `resources/js/app.js`: Alpine data `searchBox` + `gallery` + init
- `resources/js/genealogy.js`: vis-network `initGenealogy()` (full graph, hierarchical)
- `resources/js/genealogy-graph.js`: `initBandGraph()` (per-band, Barnes-Hut)

### Vite
- Entry points: `resources/css/app.css`, `resources/js/app.js`, `resources/js/genealogy.js`, `resources/js/genealogy-graph.js`
- Build: `npm run build` → `public/build/assets/`
