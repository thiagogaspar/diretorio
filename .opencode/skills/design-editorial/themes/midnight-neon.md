# Midnight Neon

> **"A noite é o palco. O neon é a setlist."**

---

## 1. Conceito

O **Midnight Neon** é um design system dark-first — o modo escuro não é alternativo, é o padrão. Inspirado no retrowave dos anos 80, nos letreiros de neon das casas de show underground e na estética cyberpunk de flyers de festival. Fundos profundos em azul-petróleo e carvão criam uma tela noturna onde as cores de destaque — ciano elétrico, magenta e lime — acendem como letreiros. Bordas finas (1px) e cantos levemente arredondados (4px) trazem sofisticação digital sem perder a energia analógica. Tipografia geométrica e limpa, com um toque de distorção nos títulos display.

Para um diretório de genealogia musical, a estética neon conversa diretamente com a cultura de shows: cartazes fosforescentes, setlists rabiscadas em papel preto, o brilho de um amplificador no escuro. Cada banda é um ponto de luz numa constelação. O grafo genealógico parece um mapa estelar.

**Tom emocional:** Noturno, elétrico, imersivo, futurista-nostálgico, pulsante.

---

## 2. Paleta de Cores

### Brand — Cyan (bandas, CTAs, hero buttons)

| Token | Hex |
|-------|-----|
| `brand-50` | `#ecfeff` |
| `brand-100` | `#cffafe` |
| `brand-200` | `#a5f3fc` |
| `brand-300` | `#67e8f9` |
| `brand-400` | `#22d3ee` |
| `brand-500` | `#06b6d4` |
| `brand-600` | `#0891b2` |
| `brand-700` | `#0e7490` |
| `brand-800` | `#155e75` |
| `brand-900` | `#164e63` |

### Accent — Magenta (artistas, artist UI)

| Token | Hex |
|-------|-----|
| `accent-50` | `#fdf2f8` |
| `accent-100` | `#fce7f3` |
| `accent-200` | `#fbcfe8` |
| `accent-300` | `#f9a8d4` |
| `accent-400` | `#f472b6` |
| `accent-500` | `#ec4899` |
| `accent-600` | `#db2777` |
| `accent-700` | `#be185d` |
| `accent-800` | `#9d174d` |
| `accent-900` | `#831843` |

### Warm — Lime (relações, conexões, genealogia)

| Token | Hex |
|-------|-----|
| `warm-50` | `#f7fee7` |
| `warm-100` | `#ecfccb` |
| `warm-200` | `#d9f99d` |
| `warm-300` | `#bef264` |
| `warm-400` | `#a3e635` |
| `warm-500` | `#84cc16` |
| `warm-600` | `#65a30d` |
| `warm-700` | `#4d7c0f` |
| `warm-800` | `#3f6212` |
| `warm-900` | `#365314` |

### Surface — Deep Navy (fundos, bordas, light mode)

| Token | Hex |
|-------|-----|
| `surface-50` | `#f4f6fa` |
| `surface-100` | `#e4e9f2` |
| `surface-200` | `#c9d3e3` |
| `surface-300` | `#a7b7d0` |
| `surface-400` | `#7f93b5` |
| `surface-500` | `#5c7094` |
| `surface-600` | `#465675` |
| `surface-700` | `#34405a` |
| `surface-800` | `#242b40` |
| `surface-900` | `#181c2c` |
| `surface-950` | `#0f121e` |

### Ink — Charcoal (fundos, bordas, dark mode)

| Token | Hex |
|-------|-----|
| `ink` | `#06080d` |
| `ink-900` | `#06080d` |
| `ink-800` | `#0d111a` |
| `ink-700` | `#161d2b` |
| `ink-600` | `#243044` |
| `ink-500` | `#3d4f6b` |
| `ink-400` | `#6b7d99` |
| `ink-300` | `#9aabc2` |
| `ink-200` | `#c5d0de` |
| `ink-100` | `#e2e7f0` |
| `ink-50` | `#f0f3f8` |

---

## 3. Tipografia

### Font Pairing

| Papel | Família | Google Fonts |
|-------|---------|-------------|
| Display (títulos h1-h6) | **Space Grotesk** | `Space Grotesk:wght@400;500;600;700` |
| Sans (UI, body, labels) | **Inter** | `Inter:wght@400;500;600;700;800` |
| Serif (bio, artigos, hero subtitle) | **Newsreader** | `Newsreader:ital,opsz,wght@0,14..72,400;0,14..72,500;0,14..72,600;1,14..72,400` |
| Mono (código, badges, stats) | **Geist Mono** | `Geist Mono:wght@400;500;600;700;800` |

### Escala Tipográfica

| Elemento | Font | Size | Weight | Letter-spacing |
|----------|------|------|--------|---------------|
| `h1` (hero) | Space Grotesk | `4rem` / `5.5rem` (lg) | 700 | `-0.03em` |
| `h2` | Space Grotesk | `2rem` | 600 | `-0.02em` |
| `h3` | Space Grotesk | `1.5rem` | 600 | `-0.01em` |
| `h4` | Space Grotesk | `1.125rem` | 600 | `0` |
| `h5` | Geist Mono | `0.875rem` | 700 | `0.04em` (uppercase) |
| `h6` | Geist Mono | `0.75rem` | 700 | `0.06em` (uppercase) |
| Body | Inter | `1rem` | 400 | `0` |
| Body small | Inter | `0.8125rem` | 400 | `0` |
| Caption | Geist Mono | `0.625rem` | 600 | `0.08em` (uppercase) |

---

## 4. Espaçamento & Layout

| Propriedade | Valor |
|-------------|-------|
| Border width padrão | `1px` |
| Border radius | `4px` (`rounded`) |
| Container max-width | `72rem` (`max-w-6xl` — 1152px) |
| Grid gap padrão | `1rem` (`gap-4`) |
| Card padding | `1.25rem` |
| Card border | `1px solid surface-200` (light) / `1px solid ink-600` (dark) |
| Section spacing | `3rem` entre seções |
| Card bg dark | `ink-800` com leve transparência `bg-ink-800/80` |
| Shadow (dark) | `shadow-lg shadow-ink/40` com glow do brand |

---

## 5. Preview de Componentes

### Badges

```
┌──────────┐   ┌──────────────┐   ┌───────┐
│ GRUNGE   │   │ 1990 – 1994  │   │ +3    │
└──────────┘   └──────────────┘   └───────┘
```
- `font-mono`, `text-[0.6875rem]`, `font-semibold`
- Borda `1px solid` com `rounded` (4px)
- Fundo `brand-900/40` + texto `brand-300` (dark mode)
- Fundo `brand-100` + texto `brand-700` (light mode)
- Efeito glow sutil via `box-shadow: 0 0 8px` (apenas dark mode)
- Variantes: `badge-brand` (cyan), `badge-accent` (magenta), `badge-warm` (lime), `badge-surface` (navy)

### Botões

```
┌──────────────────────┐   ┌──────────────────────┐
│  ▶ BROWSE BANDS      │   │  VIEW GRAPH          │
└──────────────────────┘   └──────────────────────┘
```
- `font-sans`, `font-semibold`, `text-[0.8125rem]`
- `rounded` (4px), `border` 1px
- `btn-brand`: fundo `brand-600`, texto branco, hover `brand-500` + glow `shadow-brand-500/40`
- `btn-ghost`: transparente, borda `ink-500`, texto `ink-300`, hover `ink-800`
- Sem uppercase forçado — mais moderno e legível

### Cards

```
╭────────────────────────╮
│                        │
│    [ foto 3:2 ]        │
│  ╭──────────────────╮  │
│  │ BAND NAME        │  │
│  │ Genre · Year     │  │
│  ╰──────────────────╯  │
╰────────────────────────╯
```
- `rounded` (4px), borda `1px`, fundo `ink-800/80`
- Hover: borda `brand-600` + `shadow-lg shadow-brand-500/10`
- Imagem com `rounded-t` (superior arredondado), conteúdo com `rounded-b`

### Hero Section

```
┌──────────────────────────────────────────────────────┐
│  ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓  │
│  ▓▓▓▓▓▓▓▓ [ foto opaca 16:4 ] ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓  │
│  ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓  │
│                                                      │
│   ▸ COLLABORATIVE DIRECTORY                          │
│                                                      │
│   Local Music.                                       │
│   Genealogy.                                         │
│                                                      │
│   Um diretório colaborativo da genealogia musical    │
│                                                      │
│   [▶ Browse Bands]  [View Graph]                     │
│                                                      │
└──────────────────────────────────────────────────────┘
```
- Fundo `ink` (`#06080d`) — azul tão escuro que parece preto
- Título em `font-sans` (Space Grotesk) com `text-brand-400` glow
- Badge "COLLABORATIVE DIRECTORY" com `text-brand-300 border-brand-500/30`
- Imagem com `opacity-25` + overlay `bg-gradient-to-t from-ink via-ink/90 to-transparent`

### Grafo Genealógico

```
┌──────────────────────────────────────────────────────┐
│ ┌─ Legend ──────────┐                                │
│ │ ● Band  ● Artist  │     [ constelação de nós ]     │
│ │ ─ Member  ─ Influ │                                │
│ └───────────────────┘                                │
│                                          ┌───┐       │
│                                          │ + │       │
│                                          │ − │       │
│                                          └───┘       │
└──────────────────────────────────────────────────────┘
```
- Fundo `ink` com grid de pontos `radial-gradient(circle, ink-600 1px, transparent 1px)`
- Nós com glow: bandas `brand-400` com `shadow-brand-400/30`, artistas `accent-400` com `shadow-accent-400/30`
- Arestas em `ink-500` com leve opacidade
- Legend com fundo `ink-900/80` + `backdrop-blur`, borda `1px solid ink-600`, `rounded`

---

## 6. Bloco `@theme` Tailwind v4

```css
@theme {
    --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
    --font-display: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;
    --font-mono: 'Geist Mono', ui-monospace, SFMono-Regular, monospace;
    --font-serif: 'Newsreader', Georgia, ui-serif, serif;
    --font-serif-display: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;

    /* Brand (Cyan) — bands, CTAs, hero buttons */
    --color-brand-50: #ecfeff;
    --color-brand-100: #cffafe;
    --color-brand-200: #a5f3fc;
    --color-brand-300: #67e8f9;
    --color-brand-400: #22d3ee;
    --color-brand-500: #06b6d4;
    --color-brand-600: #0891b2;
    --color-brand-700: #0e7490;
    --color-brand-800: #155e75;
    --color-brand-900: #164e63;

    /* Accent (Magenta) — artists, artist UI */
    --color-accent-50: #fdf2f8;
    --color-accent-100: #fce7f3;
    --color-accent-200: #fbcfe8;
    --color-accent-300: #f9a8d4;
    --color-accent-400: #f472b6;
    --color-accent-500: #ec4899;
    --color-accent-600: #db2777;
    --color-accent-700: #be185d;
    --color-accent-800: #9d174d;
    --color-accent-900: #831843;

    /* Warm (Lime) — relationships, connections */
    --color-warm-50: #f7fee7;
    --color-warm-100: #ecfccb;
    --color-warm-200: #d9f99d;
    --color-warm-300: #bef264;
    --color-warm-400: #a3e635;
    --color-warm-500: #84cc16;
    --color-warm-600: #65a30d;
    --color-warm-700: #4d7c0f;
    --color-warm-800: #3f6212;
    --color-warm-900: #365314;

    /* Surface (Deep Navy) — backgrounds, borders, light mode */
    --color-surface-50: #f4f6fa;
    --color-surface-100: #e4e9f2;
    --color-surface-200: #c9d3e3;
    --color-surface-300: #a7b7d0;
    --color-surface-400: #7f93b5;
    --color-surface-500: #5c7094;
    --color-surface-600: #465675;
    --color-surface-700: #34405a;
    --color-surface-800: #242b40;
    --color-surface-900: #181c2c;
    --color-surface-950: #0f121e;

    /* Ink (Charcoal) — backgrounds, borders, dark mode */
    --color-ink: #06080d;
    --color-ink-900: #06080d;
    --color-ink-800: #0d111a;
    --color-ink-700: #161d2b;
    --color-ink-600: #243044;
    --color-ink-500: #3d4f6b;
    --color-ink-400: #6b7d99;
    --color-ink-300: #9aabc2;
    --color-ink-200: #c5d0de;
    --color-ink-100: #e2e7f0;
    --color-ink-50: #f0f3f8;

    /* Border radius */
    --radius-xs: 2px;
    --radius-sm: 4px;
    --radius-md: 6px;
    --radius-lg: 8px;
    --radius-xl: 12px;
}
```

### Font imports (HTML `<head>`)

```html
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|inter:400,500,600,700,800|newsreader:ital,opsz,wght@0,14..72,400;0,14..72,500;0,14..72,600;1,14..72,400|geist-mono:400,500,600,700,800&display=swap" rel="stylesheet">
```

---

## 7. Diferenciais

### O que muda em relação ao tema atual

| Aspecto | Atual (Emerald) | Midnight Neon |
|---------|-----------------|---------------|
| Modo padrão | Light-first (dark como override) | **Dark-first** — o tema natural é escuro |
| Cor brand | Emerald (verde-escuro) | **Cyan (ciano elétrico)** — brilha no escuro |
| Cor accent | Purple | **Magenta** — vibrante, contraste máximo com ciano |
| Cor warm | Amber | **Lime (verde-limão)** — completa a tríade neon |
| Surface | Warm gray | **Deep Navy** — azul escuro, transmite profundidade |
| Ink | Preto `#000` | **Charcoal azulado `#06080d`** — mais atmosférico |
| Border width | 2px | **1px** — mais delicado, digital, moderno |
| Border radius | 0 | **4px** (`rounded`) — suaviza a interface |
| Display font | JetBrains Mono | **Space Grotesk** — geométrica, moderna, sem serifa |
| Mono font | JetBrains Mono | **Geist Mono** — mais limpa, da Vercel |
| Badge estilo | Cantos retos, borda 2px | **Cantos arredondados, borda 1px, glow (dark)** |
| Grafo fundo | Preto com grid dots | **Charcoal com grid dots + glow nos nós** |
| Cards | Sem shadow | **Com shadow + glow na borda hover** |

### Forças
- Dark mode como experiência primária — coerência visual total
- Contraste máximo das cores neon contra fundo escuro (WCAG AAA nas combinações principais)
- Estética fortemente associada à cultura musical (shows, flyers, capas de synthwave)
- Bordas finas e cantos arredondados tornam a interface mais amigável que o brutalista
- Glows e sombras criam profundidade sem pesar no layout
- Geist Mono é fonte moderna e gratuita com excelente legibilidade

### Fraquezas
- Cores neon muito saturadas em light mode podem cansar — light mode é secundário
- Usuários que preferem light mode podem achar o tema "escuro demais"
- Glows e sombras dependem de GPU — performance reduzida em dispositivos muito antigos
- Space Grotesk é fonte com personalidade — pode não agradar em textos longos
- Bordas de 1px podem ser finas demais em telas de baixa densidade

### Melhor contexto
- Usuários noturnos e jovens (16-35 anos)
- Telas OLED/AMOLED onde o fundo `#06080d` é verdadeiramente preto e economiza bateria
- Ambiente de home studio, quarto escuro, navegação noturna
- Dispositivos modernos com GPU capaz de renderizar glow/shadows
- Contexto de "descobrir música" — a estética neon evoca exploração e novidade

---

### ⚠️ Nota para implementação

**Este tema requer adaptações nas utilities** (em `resources/css/app.css`), pois muda border-width de 2px para 1px e adiciona border-radius. O bloco `@theme` acima inclui `--radius-*` tokens. As utilities existentes (`badge`, `btn`, `card`, `input`, `select`, `infobox`, `section-header`) precisam ser atualizadas:

- `border: 2px solid ...` → `border: 1px solid ...` (ou usar token `--border-width` no futuro)
- Adicionar `border-radius: var(--radius-sm)` onde apropriado
- `@utility badge`: adicionar `border-radius: var(--radius-xs)`
- `@utility btn`: adicionar `border-radius: var(--radius-sm)`
- `@utility card`: adicionar `border-radius: var(--radius-sm)`
- `@utility infobox`: adicionar `border-radius: var(--radius-sm)`

Para os glows (exclusivos deste tema), adicione no `app.css`:

```css
@utility glow-brand {
    box-shadow: 0 0 12px var(--color-brand-500);
    .dark & { box-shadow: 0 0 16px var(--color-brand-500); }
}

@utility glow-accent {
    box-shadow: 0 0 12px var(--color-accent-500);
    .dark & { box-shadow: 0 0 16px var(--color-accent-500); }
}
```
