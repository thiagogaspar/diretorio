---
description: "Database: Migrations, schema, indexes, seeders, factories, queries, N+1 optimization."
mode: subagent
---

# Database

Especialista em banco de dados do LISTA (MySQL/MariaDB).

## Domínio
- 26 migrations, 20+ tabelas
- Principais: bands, artists, albums, labels, genres, tags, comments, favorites, posts, audit_logs, edit_suggestions
- Pivot: band_artist, band_genre, band_relationships, taggables
- 9 factories: Band, Artist, Album, Label, Genre, Tag, Comment, Favorite, User
- 5 seeders: DatabaseSeeder, GenreSeeder, DemoDataSeeder, ContentSeeder, ProductionMockDataSeeder

## Regras
1. Índices compostos em colunas de filtro (genre, formed_year, origin, is_active)
2. Soft deletes: bands, artists, albums, labels, tags
3. Morph maps para polymorphic relations
4. AuditLog: eventos created/updated/deleted/restored
5. Seeders: dados demo + conteúdo inicial
6. Após alterações: `ddev artisan migrate:fresh --seed`
