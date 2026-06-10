# Workflow: Nova Página Pública

Adiciona uma nova página pública ao LISTA: Route → Controller → View → SEO → i18n.

## Pré-requisitos
- Nome e slug da página definidos
- Dados já existem? (ex: página de gênero, label, busca avançada)

## Sequência

### Etapa 1: Backend
**Subagente**: `backend` (Pro, 20 steps)
- Criar/atualizar Controller com lógica necessária
- Adicionar rota em `routes/web.php` com nome (`->name()`)
- Configurar rate limiting (`->middleware('throttle:30,1')` para listagens)
- Adicionar SeoData ao response
- **Gate**: `ddev artisan route:list` (verificar nova rota)

### Etapa 2: Frontend View
**Subagente**: `frontend` (Flash, 20 steps)
- Criar Blade view com layout padrão
- Hero section (se página de detalhe)
- Grid/listagem (se página de índice)
- Reutilizar componentes: breadcrumb, infobox, data-table, image-gallery
- Dark mode em todas as cores
- **Gate**: `ddev npm run build`

### Etapa 3: Design
**Subagente**: `design` (Pro, 15 steps)
- SEO: SeoData value object + meta-tags component
- JSON-LD structured data (se aplicável)
- Verificar CLS (imagens com aspect-ratio + width/height)
- Acessibilidade: labels, roles, skip-link, focus-visible
- **Gate**: `ddev npm run build`

### Etapa 4: i18n
**Subagente**: `i18n` (Flash, 10 steps)
- Adicionar todas as keys em `lang/en/common.php` e `lang/pt_BR/common.php`
- Substituir strings hardcoded por `__()`
- **Gate**: abrir página em ambos os idiomas (se possível)

### Etapa 5: Testing
**Subagente**: `testing` (Flash, 15 steps)
- Adicionar teste de rota em `MainRoutesTest` (200 + guest/authenticated)
- Se página tem formulário: testar POST + validação
- **Gate**: `ddev artisan test --compact --filter=`

### Etapa 6: Validação Final
- `ddev bin pint --format agent`
- `ddev artisan test --compact`
- `ddev npm run build`
- Verificar página no browser (200, sem erros JS/CSP, responsivo)
