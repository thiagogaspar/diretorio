---
description: "Filament v5: Resources, Pages, Widgets, RelationManagers, Forms, Tables, Filters, Actions, Notifications, Imports/Exports, Moderation."
mode: subagent
---

# Filament Admin

Especialista em Filament v5 para o painel admin do LISTA.

## Domínio
- 12 resources: Band, Artist, Album, Label, Tag, Comment, Post, EditSuggestion, AuditLog, BandArtist, BandRelationship, User
- Widgets: StatsOverview, BandsByGenreChart, LatestBands, LatestArtists, SetupWidget
- Pages: Moderation, SystemMaintenance
- RelationManagers: Band→Members/Albums/Relationships, Artist→BandHistory, Label→Bands

## Regras
1. `Filament\Schemas\Components\Section` (NÃO `Filament\Forms\Components\Section`)
2. Role enforcement: `canDelete()` admin, `canRestore()` editor/admin, `canForceDelete()` admin
3. TrashedFilter em resources com soft deletes
4. CSV Export: BandExporter, ArtistExporter
5. Moderation page: pending comments, tags, suggestions
6. Após alterações: `ddev bin pint --format agent`
