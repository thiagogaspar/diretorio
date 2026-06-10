---
name: database-migrations
description: "Use quando editar migrations, schema de tabelas, índices, seeders, factories, queries SQL, otimização N+1. Domínios: criação de tabelas, índices compostos, chaves estrangeiras, soft deletes, pivot tables, polymorphic relationships, composite indexes, query optimization, explain plans."
license: MIT
---

# Database Migrations — LISTA

> **TL;DR** — Índices compostos em colunas de filtro · Soft deletes em Band, Artist, Album, Label, Tag · Factories para todos os models (9) · Morph maps para polymorphic · Seeders produzem dados demo · Gate: `ddev artisan migrate:fresh --seed`

## Tabelas e Schema

### Tabelas Principais (26 migrations, 20+ tabelas)

| Tabela | Chaves | Soft Delete | Índices |
|--------|--------|-------------|---------|
| `bands` | label_id FK » labels | sim | genre + formed_year + origin + is_active (composite) |
| `artists` | — | sim | origin, is_active |
| `albums` | band_id FK » bands | sim | release_year |
| `labels` | — | sim | name |
| `genres` | — | não | slug (unique) |
| `tags` | — | sim | is_approved |
| `comments` | user_id FK, commentable morph | não | is_approved |
| `favorites` | user_id FK, favoriteable morph | não | — |
| `posts` | — | não | is_published |
| `audit_logs` | user_id FK, auditable morph | não | event |
| `edit_suggestions` | user_id FK, suggestable morph | não | status |

### Tabelas Pivot
- `band_artist`: band_id, artist_id, role, joined_year, left_year, is_current
- `band_genre`: band_id, genre_id
- `band_relationships`: parent_band_id, child_band_id, type (enum: split_into/evolved_into/members_formed/side_project/merged_into/rebranded_as), year
- `taggables`: tag_id, taggable_type, taggable_id

### Factories Disponíveis
`BandFactory`, `ArtistFactory`, `AlbumFactory`, `LabelFactory`, `GenreFactory`, `TagFactory`, `CommentFactory`, `FavoriteFactory`, `UserFactory`

### Seeders
- `DatabaseSeeder` → GenreSeeder + DemoDataSeeder + ContentSeeder
- `ProductionMockDataSeeder` → dados mock para produção
- `GenreSeeder` → gêneros musicais
- `DemoDataSeeder` → bands, artists, albums, labels demo
- `ContentSeeder` → posts, comments demo
