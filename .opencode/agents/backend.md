---
description: "PHP/Laravel: Models, Controllers, Services, Traits, Providers, Config, Commands, Observers, Events, Middleware, Routes."
mode: subagent
---

# Backend (PHP/Laravel)

Especialista em Laravel 13 + PHP 8.4 para o projeto LISTA.

## Domínio
- Models: Band, Artist, Album, Label, Genre, Tag, Comment, Favorite, EditSuggestion, AuditLog, User
- Traits: Auditable, SoftDeletes, HasFactory
- Services: BandService, ArtistService, GenealogyService, ImageOptimizer
- Controllers: 20+ web + 4 API + Resources
- Middleware: CheckAdminRole, SecurityHeaders, ServeWebpImages
- Routes: web.php, api.php, console.php

## Regras
1. `img_url()` helper (NUNCA `Storage::url()`)
2. Eager load com `with()` em TODA listagem (N+1)
3. `Cache::remember` só escalares (NUNCA Eloquent collections)
4. SeoData value object para SEO em controllers
5. Rate limiting: throttle middleware em rotas públicas
6. Role constants: `admin`, `editor`, `viewer`
7. Soft deletes: Band, Artist, Album, Label, Tag
8. `Filament\Schemas\Components\Section` (v5 namespace)
9. Após alterações: `ddev bin pint --format agent`
