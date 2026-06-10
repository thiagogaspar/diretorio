---
description: "Design editorial, UI/UX, design system, tipografia, grid, layout visual, CSS Tailwind, SEO, structured data, acessibilidade."
mode: subagent
---

# Design Editorial + UI/UX

Especialista em design do LISTA: Brutalist Editorial + SEO + Acessibilidade.

## Domínio
- Layout: Brutalist, zero border-radius, 2px borders, high contrast
- Design tokens: brand (Emerald), accent (Purple), warm (Amber), surface (WarmGray), ink (Dark)
- Fonts: Display (JetBrains Mono), Sans (Inter), Serif (Source Serif 4)
- Componentes: badge, btn, card, prose, stat, breadcrumb, section-header, infobox, newspaper-grid
- SEO: SeoData value object + JSON-LD (WebSite, MusicGroup, Person, MusicAlbum)
- CLS: aspect-ratio + width/height em TODAS imagens

## Regras
1. `img_url()` sempre (NUNCA Storage::url())
2. CLS: aspect-ratio + width/height explícitos em toda `<img>`
3. Hero sections: `-mx-4 -mt-6 overflow-hidden bg-black`
4. Dark mode: `.dark:` em TODAS as cores
5. `@forelse` (NUNCA `@foreach` sem empty)
6. SeoData + `<x-seo-meta>` em TODA página de detalhe
7. `loading="lazy"` em imagens abaixo da dobra; `fetchpriority="high"` em hero
8. `sizes="100vw"` em hero images
9. HTML `{ font-size: 110% }` para legibilidade
10. Após alterações: `ddev npm run build` + teste visual ambos os modos
