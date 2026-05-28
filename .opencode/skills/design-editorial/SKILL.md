---
name: design-editorial
description: "Use quando editar layout visual, design system, tipografia, espaçamento, grid, editorial (blog, conteúdo), SEO on-page, structured data, CLS/Core Web Vitals, meta tags, acessibilidade, dark mode, responsive design, hero sections, infobox, breadcrumb, CSS utilities Tailwind. Domínios: design system, editorial layout, SEO técnico, performance visual, acessibilidade, identidade visual."
license: MIT
---

# Design Editorial + UI/UX — LISTA

## Filosofia Visual

```
┌──────────────────────────────────────────────────────────────┐
│  Brutalist Editorial Design — LISTA                          │
│                                                              │
│  1. Bordas grossas (2px) — zero border-radius                │
│  2. Tipografia como hierarquia → Display (mono) / Serif     │
│  3. New York Times meets music zine                          │
│  4. Dark mode não é opcional — é first-class                 │
│  5. Imagens sempre com aspect-ratio + width/height           │
│  6. Grid de newspaper (gap-px, bordas 2px)                   │
│  7. Mono para títulos, sans para UI, serif para texto longo  │
│  8. Cores: brand (bands), accent (artists), warm (relações)  │
│  9. Hero escuro + gradient + opacity image                   │
│  10. Stats bar com dividers grossos (border-r-2)             │
└──────────────────────────────────────────────────────────────┘
```

## Design Tokens (`resources/css/app.css` via `@theme`)

### Font Stack
```
--font-sans:    'Inter', ui-sans-serif, system-ui, sans-serif;   → UI, body
--font-display: 'JetBrains Mono', 'Fira Code', monospace;        → TÍTULOS, badges, stats
--font-serif:   'Source Serif 4', Georgia, serif;                → bio, artigos, hero_subtitle
--font-mono:    'JetBrains Mono', 'Fira Code', monospace;        → código
```

### Color System
```
Brand  (Emerald)  → bands, CTAs, links, hero buttons
Accent (Purple)   → artists, artist-related UI
Warm   (Amber)    → relationships, connections
Surface(Warm gray)→ bg, borders, text (light mode)
Ink    (Dark gray)→ bg, borders, text (dark mode)
```

### Base HTML
```css
html { font-size: 110%; }
h1, h2, h3, h4, h5, h6 { font-family: var(--font-display); }
```

## CSS Utilities — Tailwind v4 `@utility`

### `badge` — tags, gêneros, metadata
```
display: inline-flex; align-items: center; gap: 0.25rem;
padding: 0.125rem 0.5rem; font-family: var(--font-display);
font-size: 0.6875rem; font-weight: 700; border: 2px solid currentColor;
```
Variants: `badge-brand`, `badge-surface`, `badge-accent`

### `btn` — calls-to-action
```
font-family: var(--font-display); font-weight: 800; font-size: 0.8125rem;
padding: 0.5rem 1.25rem; border: 2px solid transparent;
```
Variants: `btn-brand` (preto/branco), `btn-ghost` (borda)

### `input` / `select` — formulários
```
border: 2px solid var(--color-surface-300);
focus → border-color: #000 (.dark → #fff)
```

### `card` — containers
```
background: white; border: 2px solid var(--color-surface-200);
.dark → bg ink-800 + border ink-700
```
`card-hover`: hover → brand-500 border

### `prose` — conteúdo editorial
```
line-height: 1.6; links: underline on hover → bg preto + texto branco
blockquote: border-left: 4px solid black
```
`prose-serif`: variante com font-serif + line-height 1.7

### `stat` / `stat-value` / `stat-desc` — stats bar
```
padding: 1.5rem 0.75rem; text-align: center;
value: font-display 1.75rem font-black
desc: font-display 0.625rem uppercase tracking-wider
```

### `breadcrumb` — navegação
```
display: flex; align-items: center; gap: 0.5rem;
font-display 0.75rem; separador "/"
```

### `section-header` — títulos de seção
```
text-transform: uppercase; letter-spacing: 0.08em;
border-bottom: 2px solid #000 (.dark → #fff)
padding-bottom: 0.5rem; margin-bottom: 1rem;
```

### `infobox` — Wikipedia-style info table
```
border: 2px surface; bg surface-50 (.dark → ink-800 + ink-600);
label: 40% width, font-semibold, border-right: 2px;
value: 60% width
```

### `newspaper-grid` — grid de 3 colunas
```
grid-template-columns: 1fr → sm:2 → lg:3
gap-px + bg com cor de borda (efeito newspaper)
```

## Pattern Library — Page Layouts

### Layout Base (`layouts/app.blade.php`)
```
├── <header> sticky top-0 z-50 border-b
│   ├── max-w-6xl mx-auto px-4 h-12
│   ├── Logo (brand color)
│   ├── Nav (Bands, Artists, Genealogy, Blog)
│   ├── Search (Alpine.js searchBox)
│   ├── Admin, Register/User, Theme Toggle, Mobile Menu
│   └── Mobile menu (md:hidden)
├── <main id="main-content" class="relative overflow-x-hidden">
│   └── @yield('content')
└── <footer>
    ├── max-w-6xl mx-auto px-4 py-10
    ├── grid grid-cols-2 md:grid-cols-4 gap-8
    └── copyright bar
```

### Home Page (`home.blade.php`)
```
┌── Hero (bg-black, -mx-4, min-height:42vh) ────────────────┐
│  tag "COLLABORATIVE DIRECTORY"                            │
│  h1 "Local Music. Genealogy." (8xl font-black)            │
│  subtitle (font-serif)                                    │
│  [Browse Bands →] [View Graph]                            │
│  Featured Band card (aspect-[3/2], border white/10)       │
└───────────────────────────────────────────────────────────┘
┌── Stats Bar (border-2, grid-cols-4) ──────────────────────┐
│  BANDS | ARTISTS | LINKS | CONNECTIONS                    │
└───────────────────────────────────────────────────────────┘
┌── Featured Bands (newspaper-grid, 3-col) ─────────────────┐
│  Card: image 3:2 → h3 name → genre · year · origin        │
├── Featured Artists (newspaper-grid, 3-col) ───────────────┤
│  Card: image 2:3 → h3 name → origin                       │
├── Labels (grid-cols-4, gap-px) ──────────────────────────┤
│  Card: logo 40×40 → h3 name → bands_count · country       │
├── CTA ────────────────────────────────────────────────────┤
│  h2 → desc → [Contribute →] → "Or create an account"     │
└───────────────────────────────────────────────────────────┘
```

### Detail Pages (bands/show, artists/show, albums/show)
```
┌── Hero (aspect-ratio:16/4, -mx-4, overflow-hidden) ──────┐
│  img opacity-30 + gradient overlay                        │
│  h1 name (5xl-6xl font-black)                            │
│  badges: year-range · genre1 · genre2                    │
└───────────────────────────────────────────────────────────┘
breadcrumb: Home / Bands / Name

Two-column layout (lg:flex lg:gap-10):
┌── Main (flex-1) ─────────────────┐ ┌── Sidebar (lg:w-72) ─┐
│  Header: photo + label + origin   │ │  Infobox: members,   │
│  Bio (prose/prose-serif)          │ │  albums, formed,     │
│  Members (data-table)             │ │  dissolved, origin,  │
│  Discography (grid 2→3→4)        │ │  label, genres       │
│  Connections graph (350px)        │ │  [Ad slot]           │
└───────────────────────────────────┘ └──────────────────────┘
```

### List Pages (bands/index, artists/index, albums/index, labels/index)
```
┌── Header ─────────────────────────────────────────────────┐
│  h1 + optional genre/letter filter                        │
├── Grid (newspaper-grid ou grid-cols-* gap-px) ────────────┤
│  Cards com image (aspect-ratio) + h3 + metadata           │
└───────────────────────────────────────────────────────────┘
```

## SEO Structured Data

### SeoData Value Object (`app/Values/SeoData.php`)
```php
new SeoData(
    title: string,              // page title (appended with " — LISTA")
    description: string,        // meta description
    type: string,               // og:type (website, music.group, profile, article)
    image: ?string,             // og:image + twitter:image
    canonical: ?string,         // canonical URL
    schema: ?string,            // JSON-LD string
    robots: string,              // 'index,follow' (public), 'noindex,nofollow' (admin)
);
```

### JSON-LD Patterns

**Home** — WebSite (SearchAction) + Organization (logo)
```json
{"@graph":[
  {"@type":"WebSite","name":"LISTA","url":"...","potentialAction":{"@type":"SearchAction","target":"...?search={term}","query-input":"required name=search_term_string"}},
  {"@type":"Organization","name":"LISTA","url":"...","logo":"...favicon.svg"}
]}
```

**Band** — BreadcrumbList + MusicGroup (member[], album[], genre, foundingDate, location)
```json
{"@graph":[
  {"@type":"BreadcrumbList","itemListElement":[...]},
  {"@type":"MusicGroup","name":"...","url":"...","genre":"...","foundingDate":"...","member":[{"@type":"Person","name":"...","url":"..."}],"album":[{"@type":"MusicAlbum","name":"...","datePublished":"..."}],"location":"..."}
]}
```

**Artist** — BreadcrumbList + Person (memberOf[], birthDate, birthPlace)
```json
{"@graph":[
  {"@type":"BreadcrumbList","itemListElement":[...]},
  {"@type":"Person","name":"...","url":"...","memberOf":[{"@type":"MusicGroup","name":"..."}],"birthPlace":"...","description":"..."}
]}
```

**Album** — BreadcrumbList + MusicAlbum (byArtist, datePublished, track[])
```json
{"@graph":[
  {"@type":"BreadcrumbList","itemListElement":[...]},
  {"@type":"MusicAlbum","name":"...","byArtist":{"@type":"MusicGroup","name":"..."},"datePublished":"...","track":[{"@type":"MusicRecording","position":1,"name":"..."}]}
]}
```

## CLS (Cumulative Layout Shift) — Regras Obrigatórias

1. **Toda `<img>`** deve ter `width` + `height` explícitos (exceto SVGs inline)
2. **Toda imagem** deve ter `aspect-{ratio}` ou `aspect-ratio` CSS no container
3. **Hero images** usam `aspect-ratio:16/4` no container + `absolute inset-0 w-full h-full object-cover` na img
4. **Font loading** via `display=swap` + `<link rel="preload" as="style">`
5. **Elementos dinâmicos** (genealogy, search results) devem ter altura mínima reservada
6. **Hero sections** com `-mx-4` precisam de `overflow-x-hidden` no `<main>` do layout
7. **Imagens em grid** sempre com `aspect-[3/2]` (bands) ou `aspect-[2/3]` (artists) ou `aspect-square` (albums)
8. **`loading="lazy"`** para imagens abaixo da dobra; `fetchpriority="high"` para hero

## Imagens

### Helper `img_url()`
```php
function img_url(?string $path): ?string
```
- Se `$path` é URL absoluta → retorna direto
- Se `$path` é relativo → `Storage::url($path)` (local) ou `Storage::disk('s3')->url($path)` (prod)
- Fallback: `asset($path)`

### Padrões de Imagem por Entidade
| Entidade | Ratio | Width×Height | Class |
|----------|-------|-------------|-------|
| Band hero | 16:4 | 1920×480 | `aspect-[16/4] object-cover opacity-30` |
| Band photo (thumb) | 1:1 | 56×56 | `w-14 h-14 object-cover` |
| Band photo (grid) | 3:2 | 600×400 | `aspect-[3/2] object-cover` |
| Artist hero | 16:4 | 1920×480 | `aspect-[16/4] object-cover opacity-30` |
| Artist photo (grid) | 2:3 | 400×600 | `aspect-[2/3] object-cover` |
| Artist photo (thumb) | ~7:10 | 56×80 | `w-14 h-20 object-cover` |
| Album cover | 1:1 | 400×400 | `aspect-square object-cover` |
| Label logo | 1:1 | 40×40 | `w-10 h-10 object-contain` |
| Blog post | 16:4 | 1200×288 | `aspect-[16/4] object-cover` |
| Favorite item | 1:1 | 48×48 | `w-12 h-12 object-cover` |
| Profile item | 1:1 | 40×40 | `w-10 h-10 object-cover` |

## Responsive Breakpoints (Tailwind v4)
```
sm: 640px   → grid 2-col, hero text 5xl
md: 768px   → nav desktop, grid 3-4 col
lg: 1024px  → sidebar, grid 3-4 col, hero text 6xl
xl: 1280px  → max-w-6xl container padding
```

## Editorial Patterns

### Section Headers (newspaper style)
```blade
<x-section-header tag="h2" :count="$items->count()">
    {{ __('common.bands.members_heading') }}
</x-section-header>
```
Component: `<h2 class="section-header">TITLE</h2>` + count underline

### Data Table (members list)
```blade
<x-data-table>
    @forelse($items as $item)
    <div class="flex items-center justify-between px-4 py-2.5 border-b-2 border-surface-200 dark:border-ink-700 last:border-0">
        <div><!-- name + badge --></div>
        <span class="font-display text-[10px] font-bold text-surface-400">1990–1994</span>
    </div>
    @empty
    <p class="px-4 py-3 text-sm text-surface-400">{{ __('...') }}</p>
    @endforelse
</x-data-table>
```

### Infobox (Wikipedia style)
```blade
<x-infobox :title="$band->name" :items="[
    'Members' => '3',
    'Formed' => '1990',
    'Origin' => 'Seattle, USA',
    'Label' => 'Sub Pop',
    'Genres' => 'Grunge',
]"/>
```

### Breadcrumb
```blade
<nav class="breadcrumb">
    <a href="{{ route('home') }}">{{ __('common.home_breadcrumb') }}</a><span>/</span>
    <a href="{{ route('bands.index') }}">{{ __('common.nav.bands') }}</a><span>/</span>
    <span>{{ $band->name }}</span>
</nav>
```

## Acessibilidade

1. **Skip to content**: `<a href="#main-content" class="skip-link">` — primeiro elemento após `<body>`
2. **`:focus-visible`**: `outline: 2px solid brand-500`
3. **`aria-label`** em inputs, buttons sem texto, nav
4. **`role="main"`**, `role="banner"`, `role="complementary"`, `role="contentinfo"` no layout
5. **`alt` text** descritivo em todas as imagens (nunca `alt=""` para imagens funcionais)
6. **Dark mode**: suporte `.dark:` em TODAS as cores, respeitando `prefers-color-scheme`
7. **`[x-cloak]`**: `display: none !important` para elementos Alpine.js não hidratados
8. **Links**: `text-underline-offset: 2px;` + hover: bg preto + texto branco (contraste extremo)
9. **Font-size**: `html { font-size: 110%; }` — +10% para legibilidade

## Recomendações de Performance Visual

1. **Preload hero images**: `<link rel="preload" href="..." as="image" fetchpriority="high">`
2. **Font preload**: `<link rel="preload" href="fonts.bunny.net/..." as="style">` antes do CSS
3. **Font display**: `&display=swap` em todas as fontes externas
4. **Lazy loading**: `loading="lazy"` em imagens abaixo da dobra
5. **Responsive images**: `sizes="100vw"` em hero images (viewport-aware)
6. **CSS inline crítico**: `:focus-visible`, `.skip-link` no `<style>` do `<head>` (evita CLS de CSS externo)
7. **Vite bundling**: entry points separados por funcionalidade (app, genealogy, genealogy-graph)

## Boas Práticas Específicas do Projeto

1. **Sempre usar `img_url()`** para exibir imagens (nunca `Storage::url()` ou `asset()` direto)
2. **Sempre usar `__()` + `trans_choice()`** para textos visíveis (nunca hardcoded)
3. **Sempre adicionar SEO structured data** em páginas de detalhe (Band, Artist, Album, Label)
4. **Sempre incluir `<x-seo-meta :seo="$seo" />`** no `@section('head')` de cada página
5. **Sempre usar `@forelse`** em vez de `@foreach` para coleções que podem ser vazias
6. **Hero sections** sempre com `-mx-4 -mt-6` + `overflow-hidden` + `bg-black`
7. **Breadcrumbs** sempre dentro de `<nav class="breadcrumb">` com schema.org implícito
8. **Imagens sem URL** sempre com fallback visual (placeholder com inicial + bg)
9. **Botões/link tracking**: `font-display text-xs font-bold uppercase tracking-wider`
10. **Dark mode**: sempre testar em ambos os modos — contrast ratio mínimo 4.5:1
