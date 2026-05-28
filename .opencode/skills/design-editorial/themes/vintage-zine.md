# Vintage Zine

> **"Papel amarelado, tinta preta, um café do lado e a fita cassete rodando."**

---

## 1. Conceito

O **Vintage Zine** transporta o LISTA para o universo tátil dos fanzines musicais dos anos 90. A base é papel envelhecido: cremes quentes, beges amanteigados, marrons terrosos. A tipografia mescla uma serif display com personalidade de woodtype (títulos) com uma sans geométrica para UI — como se cada página fosse composta numa máquina de escrever e depois colada com spray-mount. Cantos generosamente arredondados (8px), espaçamento folgado e texturas simuladas via CSS (gradients, ruído, bordas irregulares) criam a sensação de estar folheando um zine físico. A paleta de cores é emprestada das capas de discos da K Records e da SST: laranja queimado, verde-musgo, azul-desbotado.

Para um diretório de genealogia musical, o zine é a metáfora perfeita: catalogar bandas locais é o que zines sempre fizeram. Cada página do LISTA é uma página de um zine infinito, escrito coletivamente, sempre inacabado, sempre crescendo. O design abraça a imperfeição — manchas de café simuladas, bordas que parecem cortadas com régua de metal, tipografia que imita carimbo.

**Tom emocional:** Nostálgico, acolhedor, artesanal, tátil, vivido.

---

## 2. Paleta de Cores

### Brand — Burnt Orange (bandas, CTAs, hero buttons)

| Token | Hex |
|-------|-----|
| `brand-50` | `#fef7ee` |
| `brand-100` | `#fdedd3` |
| `brand-200` | `#fad7a7` |
| `brand-300` | `#f6b970` |
| `brand-400` | `#f1963b` |
| `brand-500` | `#ec7a14` |
| `brand-600` | `#cc660d` |
| `brand-700` | `#a0500e` |
| `brand-800` | `#753c0f` |
| `brand-900` | `#4d280c` |

### Accent — Faded Teal (artistas, artist UI)

| Token | Hex |
|-------|-----|
| `accent-50` | `#f0f7f6` |
| `accent-100` | `#d8ece9` |
| `accent-200` | `#b3d9d3` |
| `accent-300` | `#83c0b7` |
| `accent-400` | `#549e93` |
| `accent-500` | `#3d8279` |
| `accent-600` | `#316862` |
| `accent-700` | `#28534f` |
| `accent-800` | `#1e3e3b` |
| `accent-900` | `#152b29` |

### Warm — Mustard Yellow (relações, conexões, genealogia)

| Token | Hex |
|-------|-----|
| `warm-50` | `#fefce8` |
| `warm-100` | `#fdf6c4` |
| `warm-200` | `#fbea85` |
| `warm-300` | `#f8d842` |
| `warm-400` | `#ecc41a` |
| `warm-500` | `#c7a00d` |
| `warm-600` | `#9e7e0a` |
| `warm-700` | `#755d0c` |
| `warm-800` | `#52400d` |
| `warm-900` | `#382c0b` |

### Surface — Warm Paper (fundos, bordas, light mode)

| Token | Hex |
|-------|-----|
| `surface-50` | `#fefdf9` |
| `surface-100` | `#faf7ea` |
| `surface-200` | `#f2ebd0` |
| `surface-300` | `#e6dbb3` |
| `surface-400` | `#d4c38f` |
| `surface-500` | `#bca96e` |
| `surface-600` | `#9e8c56` |
| `surface-700` | `#7a6b42` |
| `surface-800` | `#574c30` |
| `surface-900` | `#3a3321` |
| `surface-950` | `#221d12` |

### Ink — Warm Brown-Black (fundos, bordas, texto escuro)

| Token | Hex |
|-------|-----|
| `ink` | `#1a1512` |
| `ink-900` | `#1a1512` |
| `ink-800` | `#2b231d` |
| `ink-700` | `#3d332a` |
| `ink-600` | `#564a3e` |
| `ink-500` | `#78695a` |
| `ink-400` | `#9e8d7c` |
| `ink-300` | `#c2b4a5` |
| `ink-200` | `#ded5c9` |
| `ink-100` | `#f0e9de` |
| `ink-50` | `#f8f3ea` |

---

## 3. Tipografia

### Font Pairing

| Papel | Família | Google Fonts |
|-------|---------|-------------|
| Display (títulos h1-h6) | **Lora** | `Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600` |
| Sans (UI, body, labels) | **Atkinson Hyperlegible** | `Atkinson Hyperlegible:wght@400;700` |
| Serif (bio, artigos, hero subtitle) | **Lora** | (mesma da display) |
| Mono (código, badges, stats) | **IBM Plex Mono** | `IBM Plex Mono:wght@400;500;600;700` |

### Escala Tipográfica

| Elemento | Font | Size | Weight | Letter-spacing |
|----------|------|------|--------|---------------|
| `h1` (hero) | Lora | `3.5rem` / `5rem` (lg) | 700 | `-0.02em` |
| `h2` | Lora | `2rem` | 600 | `-0.01em` |
| `h3` | Lora | `1.5rem` | 600 | `0` |
| `h4` | IBM Plex Mono | `1.125rem` | 600 | `0.02em` |
| `h5` | IBM Plex Mono | `0.875rem` | 600 | `0.04em` (uppercase) |
| `h6` | IBM Plex Mono | `0.75rem` | 600 | `0.06em` (uppercase) |
| Body | Atkinson Hyperlegible | `1rem` | 400 | `0` |
| Body small | Atkinson Hyperlegible | `0.8125rem` | 400 | `0` |
| Caption | IBM Plex Mono | `0.6875rem` | 500 | `0.04em` |

---

## 4. Espaçamento & Layout

| Propriedade | Valor |
|-------------|-------|
| Border width padrão | `1px` |
| Border radius | `8px` (`rounded-lg`) |
| Container max-width | `68rem` (`max-w-5xl` — 1088px, um pouco mais estreito que o atual) |
| Grid gap padrão | `1.25rem` (`gap-5`) |
| Card padding | `1.75rem` |
| Card border | `1px solid surface-300` (light) / `1px solid ink-700` (dark) |
| Section spacing | `3.5rem` entre seções (generoso) |
| Paper texture | `background-image` com ruído CSS (SVG filter ou gradient) |

---

## 5. Preview de Componentes

### Badges

```
╭──────────╮   ╭──────────────╮   ╭───────╮
│  GRUNGE  │   │ 1990 – 1994  │   │  +3   │
╰──────────╯   ╰──────────────╯   ╰───────╯
```
- `font-mono`, `text-[0.6875rem]`, `font-medium`
- Borda `1px solid` com `rounded-full` (totalmente arredondado — estilo etiqueta de zine)
- Fundo `surface-200` + texto `surface-800` (light)
- Fundo `ink-800` + texto `ink-200` (dark)
- Padding `0.25rem 0.625rem`
- Variantes: `badge-brand` (orange), `badge-accent` (teal), `badge-warm` (mustard), `badge-surface` (paper)

### Botões

```
╭──────────────────────╮   ╭──────────────────────╮
│  Browse Bands  →     │   │  View Graph          │
╰──────────────────────╯   ╰──────────────────────╯
```
- `font-sans` (Atkinson), `font-bold`, `text-[0.8125rem]`
- `rounded-full` (totalmente arredondado)
- `btn-brand`: fundo `brand-500`, texto branco, hover `brand-700`
- `btn-ghost`: fundo `surface-100`, borda `surface-400`, texto `surface-800`, hover `surface-200`
- Sem uppercase — linguagem natural de zine

### Cards

```
╭──────────────────────────────╮
│                              │
│      [ foto 3:2 ]            │
│                              │
│  ┌────────────────────────┐  │
│  │ BAND NAME              │  │
│  │ Genre · Year · Origin  │  │
│  └────────────────────────┘  │
╰──────────────────────────────╯
```
- `rounded-lg` (8px), borda `1px`, fundo `surface-50`
- Sombra sutil: `shadow-sm` (como papel levemente levantado)
- Hover: `shadow-md` + borda `brand-400`
- Dark mode: fundo `ink-800`, sombra `shadow-ink/20`

### Hero Section

```
┌──────────────────────────────────────────────────────┐
│ · · · · · · · · [ ruído de papel ] · · · · · · · · │
│ · · · · · [ foto opaca 16:4 ] · · · · · · · · · · ·│
│ · · · · · · · · · · · · · · · · · · · · · · · · · ·│
│                                                      │
│   collaborative directory                            │
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
- Fundo `surface-100` com textura de papel (ruído CSS)
- Título em `font-serif` (Lora), com `text-surface-900`
- Badge "collaborative directory" em `font-mono` lowercase, `text-surface-500`
- Imagem com `opacity-20` + overlay `bg-gradient-to-b from-surface-100/80 to-surface-100`
- Borda inferior decorativa: `border-b-2 border-dashed surface-400`
- Dark mode: fundo `ink-900`, texto `ink-100`, textura de papel adaptada (invertida)

### Grafo Genealógico

```
┌──────────────────────────────────────────────────────┐
│ ┌─ Legend ────────────┐                              │
│ │ ● Band   ● Artist   │   [ teia de conexões ]      │
│ │ ─ Member  ─ Influ   │                              │
│ └─────────────────────┘                              │
│                                          ┌───┐       │
│                                          │ + │       │
│                                          │ − │       │
│                                          └───┘       │
└──────────────────────────────────────────────────────┘
```
- Fundo `surface-200` com textura de papel pautado (linhas horizontais sutis via `repeating-linear-gradient`)
- Nós com cores terrosas: bandas `brand-400`, artistas `accent-400`, relações `warm-400`
- Arestas em `surface-500` com `stroke-dasharray` (linha tracejada, como caneta)
- Legend com fundo `surface-50`, borda `1px dashed surface-400`, `rounded`
- Dark mode: fundo `ink-800` com linhas `ink-700`

---

## 6. Bloco `@theme` Tailwind v4

```css
@theme {
    --font-sans: 'Atkinson Hyperlegible', ui-sans-serif, system-ui, sans-serif;
    --font-display: 'Lora', Georgia, ui-serif, serif;
    --font-mono: 'IBM Plex Mono', ui-monospace, SFMono-Regular, monospace;
    --font-serif: 'Lora', Georgia, ui-serif, serif;
    --font-serif-display: 'Lora', Georgia, ui-serif, serif;

    /* Brand (Burnt Orange) — bands, CTAs, hero buttons */
    --color-brand-50: #fef7ee;
    --color-brand-100: #fdedd3;
    --color-brand-200: #fad7a7;
    --color-brand-300: #f6b970;
    --color-brand-400: #f1963b;
    --color-brand-500: #ec7a14;
    --color-brand-600: #cc660d;
    --color-brand-700: #a0500e;
    --color-brand-800: #753c0f;
    --color-brand-900: #4d280c;

    /* Accent (Faded Teal) — artists, artist UI */
    --color-accent-50: #f0f7f6;
    --color-accent-100: #d8ece9;
    --color-accent-200: #b3d9d3;
    --color-accent-300: #83c0b7;
    --color-accent-400: #549e93;
    --color-accent-500: #3d8279;
    --color-accent-600: #316862;
    --color-accent-700: #28534f;
    --color-accent-800: #1e3e3b;
    --color-accent-900: #152b29;

    /* Warm (Mustard Yellow) — relationships, connections */
    --color-warm-50: #fefce8;
    --color-warm-100: #fdf6c4;
    --color-warm-200: #fbea85;
    --color-warm-300: #f8d842;
    --color-warm-400: #ecc41a;
    --color-warm-500: #c7a00d;
    --color-warm-600: #9e7e0a;
    --color-warm-700: #755d0c;
    --color-warm-800: #52400d;
    --color-warm-900: #382c0b;

    /* Surface (Warm Paper) — backgrounds, borders, light mode */
    --color-surface-50: #fefdf9;
    --color-surface-100: #faf7ea;
    --color-surface-200: #f2ebd0;
    --color-surface-300: #e6dbb3;
    --color-surface-400: #d4c38f;
    --color-surface-500: #bca96e;
    --color-surface-600: #9e8c56;
    --color-surface-700: #7a6b42;
    --color-surface-800: #574c30;
    --color-surface-900: #3a3321;
    --color-surface-950: #221d12;

    /* Ink (Warm Brown-Black) — backgrounds, borders, dark mode */
    --color-ink: #1a1512;
    --color-ink-900: #1a1512;
    --color-ink-800: #2b231d;
    --color-ink-700: #3d332a;
    --color-ink-600: #564a3e;
    --color-ink-500: #78695a;
    --color-ink-400: #9e8d7c;
    --color-ink-300: #c2b4a5;
    --color-ink-200: #ded5c9;
    --color-ink-100: #f0e9de;
    --color-ink-50: #f8f3ea;

    /* Border radius */
    --radius-xs: 3px;
    --radius-sm: 6px;
    --radius-md: 8px;
    --radius-lg: 12px;
    --radius-xl: 20px;
}
```

### Font imports (HTML `<head>`)

```html
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600|atkinson-hyperlegible:400,700|ibm-plex-mono:400,500,600,700&display=swap" rel="stylesheet">
```

---

## 7. Diferenciais

### O que muda em relação ao tema atual

| Aspecto | Atual (Emerald) | Vintage Zine |
|---------|-----------------|--------------|
| Cor brand | Emerald (verde) | **Burnt Orange (laranja queimado)** — quente, terroso |
| Cor accent | Purple | **Faded Teal (verde-azulado desbotado)** — nostalgia 90s |
| Cor warm | Amber | **Mustard Yellow** — vibrante sem ser agressivo |
| Surface | Warm gray | **Warm Paper** — cremes e beges, papel envelhecido |
| Ink | Preto puro `#000` | **Warm Brown-Black `#1a1512`** — marrom-escuro, nunca preto absoluto |
| Border width | 2px | **1px** — leve, como linha de caneta |
| Border radius | 0 | **8px (`rounded-lg`)** — suave, orgânico |
| Badge radius | 0 (retos) | **`rounded-full`** — pílulas, como etiquetas adesivas |
| Display font | JetBrains Mono | **Lora** — serif editorial com personalidade |
| Sans font | Inter | **Atkinson Hyperlegible** — desenhada para máxima legibilidade |
| Mono font | JetBrains Mono | **IBM Plex Mono** — robusta, mecânica, parece datilografada |
| Container width | `max-w-6xl` (72rem) | **`max-w-5xl` (68rem)** — mais estreito, leitura mais confortável |
| Hero fundo | Preto sólido | **Papel com textura** (ruído CSS + gradiente) |
| Seções | Divisores de 2px | **Bordas dashed (tracejadas)** + espaçamento generoso |
| Section header | Borda 2px sólida preta | **Borda 1px dashed + texto lowercase** |
| Grafo fundo | Preto com grid dots | **Papel pautado (linhas horizontais)** |

### Forças
- Extremamente acolhedor e convidativo — reduz a frieza de "banco de dados"
- Excelente legibilidade (Atkinson Hyperlegible foi projetada para isso)
- Rounded-full nos badges + rounded-lg nos cards criam ritmo visual orgânico
- Paleta de cores terrosas é universalmente aceita e não causa fadiga
- Dark mode quente (marrom-escuro em vez de preto) é mais confortável que dark modes frios
- Estética zine é culturalmente relevante para o público-alvo (músicos, colecionadores)
- Texturas CSS são leves e não dependem de imagens externas

### Fraquezas
- Menos "impactante" que os outros dois temas — pode parecer "simples demais"
- Rounded-full em badges + rounded-lg nos cards pode parecer infantil se não houver contraste com elementos retos
- Lora como display font pode ser pesada visualmente em tamanhos pequenos
- Dark mode quente pode não agradar quem prefere dark modes "puros" (preto absoluto)
- Estilo "papel" pode ser mal interpretado como "falta de acabamento" por usuários acostumados com UI glassmorphism
- Container mais estreito (68rem) reduz densidade de informação em telas grandes

### Melhor contexto
- Leitores que passam muito tempo lendo bios e artigos (conteúdo editorial)
- Usuários com sensibilidade visual (Atkinson Hyperlegible + fundo quente)
- Dispositivos com telas de todos os tamanhos (mobile-first com container estreito)
- Contexto de "pesquisa musical" — a estética de arquivo/zine é familiar para pesquisadores
- Usuários mais velhos (30+) que viveram a era dos zines físicos

---

### ⚠️ Nota para implementação

Este tema é o que mais exige adaptações nas utilities existentes:

- **Border-radius**: todas as utilities (`badge`, `btn`, `card`, `input`, `select`, `infobox`) precisam de `border-radius: var(--radius-sm)` ou `var(--radius-md)`
- **Badges**: mudar para `rounded-full` (pill) — requer override na `@utility badge`
- **Border-width**: reduzir de 2px para 1px em todas as utilities
- **Section header**: substituir `border-bottom: 2px solid #000` por `border-bottom: 1px dashed var(--color-surface-400)`

### Textura de papel (ruído CSS)

Adicionar no `app.css`:

```css
@utility paper-texture {
    position: relative;
    background-color: var(--color-surface-100);
}

@utility paper-texture::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.03;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-size: 256px 256px;
    pointer-events: none;
}

.dark .paper-texture::before {
    opacity: 0.05;
}
```

### Fundo pautado do grafo

```css
.graph-container {
    background-color: var(--color-surface-200);
    background-image: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 23px,
        var(--color-surface-300) 23px,
        var(--color-surface-300) 24px
    );
}

.dark .graph-container {
    background-color: var(--color-ink-800);
    background-image: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 23px,
        var(--color-ink-700) 23px,
        var(--color-ink-700) 24px
    );
}
```
