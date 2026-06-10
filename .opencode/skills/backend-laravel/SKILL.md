---
name: backend-laravel
description: "Use quando editar Models Eloquent, Controllers, Services, Middleware, Providers, Traits, Commands, Routes, ou qualquer lógica PHP/Laravel no backend do LISTA. Domínios: Eloquent queries, relacionamentos, scopes, observers, audit trail, validação, form requests, jobs, eventos, caching, rate limiting, autorização, rotas web/api/console."
license: MIT
---

# Backend Laravel — LISTA

> **TL;DR** — Auditable trait em models com soft deletes · `img_url()` nunca `Storage::url()` · eager load com `with()` em TODA listagem · `Cache::remember` só escalares (NUNCA collections) · `Filament\Schemas\Components\Section` (v5) · Gate: `ddev bin pint --format agent` + `ddev artisan test --compact`

## Convenções do Projeto

### Models
- `Band` e `Artist` usam trait `Auditable` + `SoftDeletes` + `HasFactory`
- `Album`, `Label`, `Tag` usam `Auditable` + `SoftDeletes` + `HasFactory`
- `Comment`, `Favorite` usam `HasFactory` (polymorphic)
- `edit_suggestions` não tem factory (criado por usuários)
- `AuditLog` não tem factory (gerado por observer)
- `Post` é standalone (sem relações polimórficas)

### Relacionamentos Polimórficos
```
Comment → commentable(): Band, Artist
Favorite → favoriteable(): Band, Artist
EditSuggestion → suggestable(): Band, Artist
Tag → taggable(): Band, Artist (MorphToMany)
AuditLog → auditable(): Band, Artist, Album, Label, Tag, User
```

### Helpers
- `img_url(?string $path, string $default = 'placeholder'): string` — substituto de `Storage::url()`
- `slugify(string $text): string` — geração de slug

### Services
- `BandService::getPaginated(array $filters)` — filtros: genre, year, search, label, origin, sort
- `ArtistService::getPaginated(array $filters)` — filtros: search, sort, origin, is_active
- `GenealogyService::getFullGraph()` — retorna todos nodes + edges para vis-network
- `ImageOptimizer::convertToWebp()` — converte para WebP via GD

### Rotas
- Web: `routes/web.php` (25+ rotas públicas + auth)
- API: `routes/api.php` (11 rotas REST + search + graph)
- Console: `routes/console.php` (images:optimize, inspire)

### Erros Comuns
- `Section` namespace: `Filament\Schemas\Components\Section` (v5)
- `Cache::remember` com Eloquent collections causa `__PHP_Incomplete_Class` — só usar com escalares
- `Storage::url()` não funciona em produção sem symlink — usar `img_url()`
