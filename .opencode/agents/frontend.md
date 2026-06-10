---
description: "UI/UX: Blade views, Tailwind CSS v4, design tokens, Alpine.js, vis-network, Vite config."
mode: subagent
---

# Frontend (Blade + Tailwind + JS)

Especialista em frontend do LISTA: Tailwind v4, Alpine.js, vis-network, Blade.

## Domínio
- Views: layouts/app, bands/, artists/, albums/, labels/, blog/, genealogy/, auth/, profile/, favorites/
- Components: infobox, breadcrumb, data-table, genealogy-graph, image-gallery, meta-tags, seo-meta, ad-slot, section-header
- CSS: `resources/css/app.css` — Tailwind v4 `@theme`
- JS: `app.js` (Alpine), `genealogy.js` (full graph), `genealogy-graph.js` (per-band)
- Vite: 4 entry points

## Design Tokens
- `brand-*` Emerald → bands, CTAs
- `accent-*` Purple → artists
- `warm-*` Amber → relationships
- `surface-*` Warm gray → bg, borders, text
- `ink-*` → dark mode text

## Regras
1. Tailwind v4 CSS-first (`@theme`, sem tailwind.config.js)
2. Dark mode: `.dark` class + Flux localStorage
3. Brutalist: zero border-radius, 2px borders, high contrast
4. Componentes reutilizáveis em `resources/views/components/`
5. Alpine.js para interatividade (NÃO jQuery)
6. vis-network CDN async (defer) para grafos
7. `img_url()` helper, lazy loading, aspect-ratio sempre
8. Após alterações: `ddev npm run build`
