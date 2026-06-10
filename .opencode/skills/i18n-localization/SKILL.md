---
name: i18n-localization
description: "Use quando adicionar ou modificar traduções nos arquivos lang/, configurar locale, ou lidar com formatação internacionalizada. Domínios: translation keys, locale fallback, pluralization, datetime formatting, number formatting, Faker locale, string externalization."
license: MIT
---

# i18n / Localization — LISTA

> **TL;DR** — Toda string visível usa `__()` · Adicionar key em AMBOS `en/` e `pt_BR/` · Locale default `pt_BR`, fallback `en` · Chaves: `entity.action` (band.create) · Interpolação: `:param` · NÃO traduzir nomes próprios, slugs, URLs · Gate: verificar views em ambos idiomas

## Estrutura

```
lang/
├── en/
│   ├── common.php       # 260+ keys (UI strings)
│   ├── auth.php         # Authentication strings
│   ├── pagination.php   # Pagination
│   ├── passwords.php    # Password reset
│   └── validation.php   # Validation messages
└── pt_BR/
    ├── common.php       # 250+ keys (Portuguese)
    ├── auth.php
    ├── pagination.php
    ├── passwords.php
    └── validation.php
```

## Configuração (config/app.php)
```php
'locale' => 'pt_BR',        // Idioma padrão
'fallback_locale' => 'en',  // Fallback
'faker_locale' => 'en_US',  // Faker
```

## Convenções de Chaves
- `entity.action` → `band.create`, `artist.edit`, `album.delete`
- `entity.field` → `band.name`, `artist.bio`
- `common.section` → `common.nav`, `common.footer`
- `entity.status` → `band.active`, `comment.pending`

## Uso
```blade
{{ __('common.welcome') }}
{{ __('band.detail', ['name' => $band->name]) }}
{{ trans_choice('common.items', $count) }}
```

## Regras
1. Toda string visível ao usuário deve usar `__()`
2. Sempre adicionar a chave em AMBOS os idiomas
3. Manter estrutura de chaves idêntica entre en/pt_BR
4. Usar `:param` para interpolação no PHP, `{{ }}` no Blade
5. Não traduzir nomes próprios, slugs, URLs
