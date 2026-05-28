# Brutalist Monochrome

> **"Tipografia é arquitetura. Preto, branco e uma única cor."**

---

## 1. Conceito

O **Brutalist Monochrome** é a versão refinada do design system atual do LISTA. Inspirado no brutalismo editorial — revistas de luxo que encontram zines underground, capas de vinil da Factory Records, páginas da Ray Gun Magazine. A proposta é máxima hierarquia tipográfica com zero ornamento: bordas retas de 2px, nada de `border-radius`, tipografia como único elemento decorativo. Preto e branco dominam com uma única cor de destaque (Crimson) funcionando como sinalizador cirúrgico de ações e links. O resultado é uma experiência que transmite autoridade editorial e urgência documental — como se cada página fosse uma ficha catalográfica impressa às pressas numa prensa tipográfica.

Para um diretório de genealogia musical, o brutalismo comunica seriedade arquivística: bandas não são entretenimento, são patrimônio. Cada ficha é um verbete. Cada conexão é um fato. O design não enfeita — ele documenta.

**Tom emocional:** Autoritário, minimal, urgente, arquivístico, tipográfico.

---

## 2. Paleta de Cores

### Brand — Crimson (bandas, CTAs, hero buttons)

| Token | Hex |
|-------|-----|
| `brand-50` | `#fdf2f3` |
| `brand-100` | `#fad9dc` |
| `brand-200` | `#f5b3b9` |
| `brand-300` | `#ee8892` |
| `brand-400` | `#e55664` |
| `brand-500` | `#d92d43` |
| `brand-600` | `#b12033` |
| `brand-700` | `#8a1827` |
| `brand-800` | `#5e101b` |
| `brand-900` | `#3c0a11` |

### Accent — Steel Blue (artistas, artist UI)

| Token | Hex |
|-------|-----|
| `accent-50` | `#f3f5f8` |
| `accent-100` | `#dde3ed` |
| `accent-200` | `#bcc8db` |
| `accent-300` | `#95a8c4` |
| `accent-400` | `#6b83a4` |
| `accent-500` | `#4a6585` |
| `accent-600` | `#394e68` |
| `accent-700` | `#2a3a4d` |
| `accent-800` | `#1d2734` |
| `accent-900` | `#131a23` |

### Warm — Mustard (relações, conexões, genealogia)

| Token | Hex |
|-------|-----|
| `warm-50` | `#fdf8ed` |
| `warm-100` | `#f9ebc8` |
| `warm-200` | `#f2d68d` |
| `warm-300` | `#e8bc4f` |
| `warm-400` | `#d49e25` |
| `warm-500` | `#ad7e1a` |
| `warm-600` | `#876214` |
| `warm-700` | `#624710` |
| `warm-800` | `#44310c` |
| `warm-900` | `#2e2109` |

### Surface — Warm Stone (fundos, bordas, texto em light mode)

| Token | Hex |
|-------|-----|
| `surface-50` | `#fdfdfc` |
| `surface-100` | `#f8f7f4` |
| `surface-200` | `#e8e5de` |
| `surface-300` | `#d4d0c7` |
| `surface-400` | `#b8b3a8` |
| `surface-500` | `#969085` |
| `surface-600` | `#787166` |
| `surface-700` | `#5c564d` |
| `surface-800` | `#3d3832` |
| `surface-900` | `#1f1c18` |
| `surface-950` | `#11100e` |

### Ink — Off-Black (fundos, bordas, texto em dark mode)

| Token | Hex |
|-------|-----|
| `ink` | `#0d0d0d` |
| `ink-900` | `#0d0d0d` |
| `ink-800` | `#181818` |
| `ink-700` | `#252525` |
| `ink-600` | `#3a3a3a` |
| `ink-500` | `#666666` |
| `ink-400` | `#999999` |
| `ink-300` | `#c4c4c4` |
| `ink-200` | `#e5e5e5` |
| `ink-100` | `#f2f2f2` |
| `ink-50` | `#fafafa` |

---

## 3. Tipografia

### Font Pairing

| Papel | Família | Google Fonts |
|-------|---------|-------------|
| Display (títulos h1-h6) | **DM Serif Display** | `DM Serif Display:wght@400` |
| Sans (UI, body, labels) | **Inter** | `Inter:wght@400;500;600;700;800;900` |
| Serif (bio, artigos, hero subtitle) | **Source Serif 4** | `Source Serif 4:ital,wght@0,400;0,600;0,700;1,400` |
| Mono (código, badges, stats) | **JetBrains Mono** | `JetBrains Mono:wght@400;600;700;800` |

### Escala Tipográfica

| Elemento | Font | Size | Weight | Letter-spacing |
|----------|------|------|--------|---------------|
| `h1` (hero) | DM Serif Display | `4.5rem` / `6rem` (lg) | 700 | `-0.02em` |
| `h2` | JetBrains Mono | `2.25rem` | 800 | `-0.01em` |
| `h3` | JetBrains Mono | `1.5rem` | 700 | `0` |
| `h4` | JetBrains Mono | `1.125rem` | 700 | `0.02em` |
| `h5` | JetBrains Mono | `0.875rem` | 700 | `0.05em` (uppercase) |
| `h6` | JetBrains Mono | `0.75rem` | 700 | `0.08em` (uppercase) |
| Body | Inter | `1rem` | 400 | `0` |
| Body small | Inter | `0.8125rem` | 400 | `0` |
| Caption | JetBrains Mono | `0.625rem` | 600 | `0.08em` (uppercase) |

---

## 4. Espaçamento & Layout

| Propriedade | Valor |
|-------------|-------|
| Border width padrão | `2px` |
| Border radius | `0` (zero em tudo) |
| Container max-width | `72rem` (`max-w-6xl` — 1152px) |
| Grid gap padrão | `1px` (newspaper effect via `gap-px`) |
| Card padding | `1.5rem` |
| Card border | `2px solid surface-200` (light) / `2px solid ink-700` (dark) |
| Section spacing | `2.5rem` entre seções |

---

## 5. Preview de Componentes

### Badges

```
┌──────────┐   ┌──────────────┐   ┌───────┐
│ GRUNGE   │   │ 1990 – 1994  │   │ +3    │
└──────────┘   └──────────────┘   └───────┘
```
- `font-display`, `text-[0.6875rem]`, `font-bold`
- Borda `2px solid` da cor da variante
- Sem `border-radius`, cantos retos
- Variantes: `badge-brand` (crimson), `badge-accent` (steel), `badge-warm` (mustard), `badge-surface` (cinza)

### Botões

```
┌─────────────────────┐   ┌─────────────────────┐
│  BROWSE BANDS  →    │   │  VIEW GRAPH         │
└─────────────────────┘   └─────────────────────┘
```
- `font-display`, `font-extrabold`, `text-[0.8125rem]`
- `border-2`, zero radius
- `btn-brand`: fundo `brand-500`, texto branco, hover `brand-700`
- `btn-ghost`: transparente, borda `surface-300`, hover `surface-100`
- Tracking `0.04em`, uppercase nos principais

### Cards

```
┌────────────────────────┐
│                        │
│    [ foto 3:2 ]        │
│                        │
├────────────────────────┤
│  BAND NAME             │
│  Genre · Year · Origin │
└────────────────────────┘
```

### Hero Section

```
┌──────────────────────────────────────────────────────┐
│  ██████████████████████████████████████████████████  │
│  ████████████ [ foto opaca 16:4 ] █████████████████  │
│  ██████████████████████████████████████████████████  │
│                                                      │
│   COLLABORATIVE DIRECTORY                            │
│                                                      │
│   Local Music.                                       │
│   Genealogy.                                         │
│                                                      │
│   Um diretório colaborativo da genealogia musical    │
│                                                      │
│   [Browse Bands →]  [View Graph]                     │
│                                                      │
└──────────────────────────────────────────────────────┘
```
- Fundo `#0d0d0d` (ink), texto branco
- Título em `font-serif` (DM Serif Display) `text-[4.5rem] lg:text-[6rem]`
- Badge "COLLABORATIVE DIRECTORY" com borda `white/20`
- Imagem com `opacity-30` + overlay gradient

### Grafo Genealógico

```
┌──────────────────────────────────────────────────────┐
│ ┌─ Legend ──────────┐                                │
│ │ ● Band    ●Artist │     [ nós e arestas ]          │
│ │ ─ Member  ─ Influ │                                │
│ └───────────────────┘                                │
│                                                      │
│                                          [+]         │
│                                          [–]         │
└──────────────────────────────────────────────────────┘
```
- Fundo `#0d0d0d` com grid de pontos `radial-gradient(circle, #222 1px, transparent 1px)`
- Borda tracejada vertical à esquerda (`repeating-linear-gradient`)
- Legend com borda `1px solid #444`
- Nós coloridos por tipo (brand=bandas, accent=artistas, warm=relações)

---

## 6. Bloco `@theme` Tailwind v4

```css
@theme {
    --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
    --font-display: 'JetBrains Mono', 'Fira Code', ui-monospace, SFMono-Regular, monospace;
    --font-mono: 'JetBrains Mono', 'Fira Code', ui-monospace, SFMono-Regular, monospace;
    --font-serif: 'Source Serif 4', Georgia, ui-serif, serif;
    --font-serif-display: 'DM Serif Display', Georgia, ui-serif, serif;

    /* Brand (Crimson) — bands, CTAs, hero buttons */
    --color-brand-50: #fdf2f3;
    --color-brand-100: #fad9dc;
    --color-brand-200: #f5b3b9;
    --color-brand-300: #ee8892;
    --color-brand-400: #e55664;
    --color-brand-500: #d92d43;
    --color-brand-600: #b12033;
    --color-brand-700: #8a1827;
    --color-brand-800: #5e101b;
    --color-brand-900: #3c0a11;

    /* Accent (Steel Blue) — artists, artist UI */
    --color-accent-50: #f3f5f8;
    --color-accent-100: #dde3ed;
    --color-accent-200: #bcc8db;
    --color-accent-300: #95a8c4;
    --color-accent-400: #6b83a4;
    --color-accent-500: #4a6585;
    --color-accent-600: #394e68;
    --color-accent-700: #2a3a4d;
    --color-accent-800: #1d2734;
    --color-accent-900: #131a23;

    /* Warm (Mustard) — relationships, connections */
    --color-warm-50: #fdf8ed;
    --color-warm-100: #f9ebc8;
    --color-warm-200: #f2d68d;
    --color-warm-300: #e8bc4f;
    --color-warm-400: #d49e25;
    --color-warm-500: #ad7e1a;
    --color-warm-600: #876214;
    --color-warm-700: #624710;
    --color-warm-800: #44310c;
    --color-warm-900: #2e2109;

    /* Surface (Warm Stone) — backgrounds, borders, light mode */
    --color-surface-50: #fdfdfc;
    --color-surface-100: #f8f7f4;
    --color-surface-200: #e8e5de;
    --color-surface-300: #d4d0c7;
    --color-surface-400: #b8b3a8;
    --color-surface-500: #969085;
    --color-surface-600: #787166;
    --color-surface-700: #5c564d;
    --color-surface-800: #3d3832;
    --color-surface-900: #1f1c18;
    --color-surface-950: #11100e;

    /* Ink (Off-Black) — backgrounds, borders, dark mode */
    --color-ink: #0d0d0d;
    --color-ink-900: #0d0d0d;
    --color-ink-800: #181818;
    --color-ink-700: #252525;
    --color-ink-600: #3a3a3a;
    --color-ink-500: #666666;
    --color-ink-400: #999999;
    --color-ink-300: #c4c4c4;
    --color-ink-200: #e5e5e5;
    --color-ink-100: #f2f2f2;
    --color-ink-50: #fafafa;
}
```

### Font imports (HTML `<head>`)

```html
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=dm-serif-display:400|inter:400,500,600,700,800,900|jetbrains-mono:400,600,700,800|source-serif-4:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
```

---

## 7. Diferenciais

### O que muda em relação ao tema atual

| Aspecto | Atual (Emerald) | Brutalist Monochrome |
|---------|-----------------|---------------------|
| Cor brand | Emerald (verde) | **Crimson (vermelho)** — mais agressivo, mais "zine" |
| Cor accent | Purple | **Steel Blue** — mais sóbrio, contrasta melhor com crimson |
| Cor warm | Amber | **Mustard** — mais terroso, melhor contraste em dark mode |
| Surface | Cinza neutro | **Warm Stone** — tons quentes, parece papel envelhecido |
| Ink | Preto puro `#000` | **Off-Black `#0d0d0d`** — mais suave no dark mode, menos fadiga ocular |
| Serif display | (não existe) | **DM Serif Display** — para hero titles, contraste com mono |
| h1 fonte | JetBrains Mono | **DM Serif Display** — serif no hero, mono nos headings menores |
| Badge hero | white/20 | **white/20** (igual, consistente) |
| Grid gap | `gap-px` | **`gap-px`** (mantém newspaper effect) |
| Radius | 0 | **0** (mantém brutalista) |

### Forças
- Contraste extremo — passa em WCAG AAA na maioria das combinações
- Identidade visual fortíssima e memorável
- Consistência total: zero exceções ao border-radius
- Excelente legibilidade com font-size 110%
- Dark mode nativo e indistinguível do light mode em qualidade

### Fraquezas
- Pode ser percebido como "agressivo" ou "frio" por alguns usuários
- Ausência total de border-radius limita certos padrões de UI (avatars, por exemplo, precisam de override pontual)
- Crimsons muito saturados podem causar fadiga visual em uso prolongado se usados em excesso
- DM Serif Display é fonte com personalidade forte — não agrada a todos

### Melhor contexto
- Usuários que valorizam arquivismo e seriedade catalográfica
- Telas grandes (desktop-first) onde a hierarquia tipográfica brilha
- Dark mode como preferência padrão
- Dispositivos com boa densidade de pixels (fontes serif ficam melhores em Retina)

---

### ⚠️ Nota para implementação

Para usar este tema, substitua todo o bloco `@theme { ... }` no `resources/css/app.css` pelo bloco acima. As utilities (`badge`, `btn`, `card`, `prose`, etc.) permanecem iguais — elas referenciam tokens por nome (`var(--color-brand-500)` etc.), então funcionam automaticamente com qualquer paleta.

A única adição necessária é no `@layer base`:

```css
h1 {
    font-family: var(--font-serif-display);
}

h2, h3, h4, h5, h6 {
    font-family: var(--font-display);
}
```
