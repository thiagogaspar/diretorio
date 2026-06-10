# Workflow: Nova Entidade CRUD

Cria uma nova entidade completa no LISTA: Model → Migration → Controller → Filament Resource → Views → i18n → Tests.

## Pré-requisitos
- Nome da entidade definido (ex: `Venue`, `Event`, `Award`)
- Relacionamentos conhecidos (FK, pivot, polymorphic?)

## Sequência

### Etapa 1: Database
**Subagente**: `database` (Flash, 20 steps)
- Criar migration com colunas + indexes + soft deletes (se aplicável)
- Criar pivot tables se houver relacionamentos
- Atualizar `database/migrations/` com índices compostos
- **Gate**: `ddev artisan migrate:fresh --seed`

### Etapa 2: Backend
**Subagente**: `backend` (Pro, 30 steps)
- Criar Model com traits (`Auditable`, `SoftDeletes`, `HasFactory`)
- Definir `$fillable`, `$casts`, relacionamentos
- Criar Controller (web) com métodos CRUD
- Criar Service se lógica for complexa
- Adicionar rotas em `routes/web.php`
- Se entidade tiver API: Resource + rotas em `routes/api.php`
- **Gate**: `ddev bin pint --format agent`

### Etapa 3: Database (Factories/Seeders)
**Subagente**: `database` (Flash, 15 steps)
- Criar Factory com estados relevantes
- Atualizar seeder principal
- **Gate**: `ddev artisan migrate:fresh --seed` (verificar que seed não falha)

### Etapa 4: Filament Admin
**Subagente**: `filament` (Pro, 30 steps)
- Criar Resource com List/Create/Edit/View pages
- Configurar Form (campos, validação, Section layout)
- Configurar Table (colunas, filtros, ações)
- Adicionar RelationManagers se houver relações
- Adicionar TrashedFilter se usar soft deletes
- Role enforcement: `canDelete()`, `canRestore()`, `canForceDelete()`
- **Gate**: acessar `/admin` e verificar novo resource

### Etapa 5: Frontend Views
**Subagente**: `frontend` (Flash, 25 steps)
- Criar view de listagem (index) com grid + filtros + paginação
- Criar view de detalhe (show) com hero + infobox + conteúdo
- Reutilizar componentes existentes (breadcrumb, infobox, data-table, image-gallery)
- **Gate**: `ddev npm run build`

### Etapa 6: i18n
**Subagente**: `i18n` (Flash, 10 steps)
- Adicionar keys em `lang/en/common.php` e `lang/pt_BR/common.php`
- Garantir que todas as strings visíveis usam `__()`
- **Gate**: verificar views (não quebrou)

### Etapa 7: Design (se necessário)
**Subagente**: `design` (Pro, 20 steps)
- Ajustar layout visual, dark mode, responsividade
- Adicionar SEO (SeoData + JSON-LD) nas páginas de detalhe
- Verificar CLS (aspect-ratio, width/height em imagens)
- **Gate**: `ddev npm run build` + teste visual

### Etapa 8: Testing
**Subagente**: `testing` (Flash, 20 steps)
- Criar Feature test com rotas CRUD (happy path + validation)
- Testar como guest e authenticated
- Adicionar ao `MainRoutesTest` se for rota pública
- **Gate**: `ddev artisan test --compact --filter=`

### Etapa 9: Validação Final
- `ddev bin pint --format agent`
- `ddev artisan test --compact` (suite completo)
- `ddev npm run build`
- Verificar 200 em todas as novas rotas
