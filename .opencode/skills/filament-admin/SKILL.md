---
name: filament-admin
description: "Use quando editar Filament v5 Resources, Pages, Widgets, RelationManagers, Forms, Tables, Filters, Actions, Notifications, CSV Imports/Exports, Moderation. Domínios: admin panel CRUD, dashboard widgets, chart widgets, role enforcement, trash/restore, bulk actions, inline CRUD via RelationManager."
license: MIT
---

# Filament Admin — LISTA

## Recursos (11 Resources)

### Navegação
| Resource | Grupo | Ícone |
|----------|-------|-------|
| BandResource | Content | heroicon-o-musical-note |
| ArtistResource | Content | heroicon-o-users |
| LabelResource | Content | heroicon-o-building-library |
| AlbumResource | Content | heroicon-o-rectangle-stack |
| TagResource | Content | heroicon-o-tag |
| CommentResource | Content | heroicon-o-chat-bubble-left-right |
| EditSuggestionResource | Content | heroicon-o-pencil-square |
| PostResource | Content | heroicon-o-newspaper |
| BandArtistResource | Relations | heroicon-o-user-plus |
| BandRelationshipResource | Relations | heroicon-o-arrow-right-circle |
| AuditLogResource | System | heroicon-o-document-text |
| UserResource | System | heroicon-o-users |

### RelationManagers
- `BandResource` → ArtistResource (Members), AlbumResource (Discography), BandRelationshipResource (Connections)
- `LabelResource` → BandResource (Bands)
- `ArtistResource` → BandResource (Band History)

### Role Enforcement
```php
canDelete(): fn () => auth()->user()?->role === 'admin'
canRestore(): fn () => in_array(auth()->user()?->role, ['admin', 'editor'])
canForceDelete(): fn () => auth()->user()?->role === 'admin'
```

### Widgets
- StatsOverview: 4 cards (Bands, Artists, Memberships, Relationships)
- BandsByGenreChart: bar chart (top 15 genres)
- LatestBandsWidget / LatestArtistsWidget: 5 latest
- SetupWidget: one-click seeder

### Namespace Atenção
Filament v5 mudou namespace de Section:
- `Filament\Schemas\Components\Section` (NÃO `Filament\Forms\Components\Section`)
