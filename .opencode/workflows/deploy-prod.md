# Workflow: Deploy para Produção

Pipeline completa de deploy: Lint → Test → Build → Migrate → Cache → Push.

## Pré-requisitos
- Todos os testes passam localmente
- `.env.production` configurado
- Railway ou Hostinger configurado

## Sequência

### Etapa 1: Lint & Format
- `ddev bin pint --format agent`
- Verificar zero erros de formatação

### Etapa 2: Test Suite Completo
- `ddev artisan test --compact`
- Todos os testes devem passar (0 failures, 0 errors)
- Se houver falhas: workflow `bugfix.md` primeiro

### Etapa 3: Build Assets
- `ddev npm run build`
- Verificar que `public/build/manifest.json` existe
- Verificar que não há erros no build

### Etapa 4: Verify Config
**Subagente**: `devops` (Flash, 10 steps)
- Verificar `APP_ENV=production` em `.env` de produção
- Verificar `APP_DEBUG=false`
- Verificar `APP_URL` correta
- Verificar DB credentials
- **Gate**: `php artisan config:show app.env` em produção

### Etapa 5: Production Cache
**Subagente**: `devops` (Flash, 5 steps)
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan storage:link` (se primeira vez)
- **Gate**: verificar que as rotas ainda funcionam

### Etapa 6: Database Migrations
**Subagente**: `devops` (Flash, 10 steps)
- `php artisan migrate --force`
- Verificar que todas as migrations rodaram
- **Gate**: `php artisan migrate:status`

### Etapa 7: Deploy
- **Railway**: `git push` (deploy automático)
- **Hostinger**: `git push` + comandos manuais no servidor
- Verificar healthcheck `/` (200 OK)
- Verificar `/sitemap.xml` (200 OK)
- Verificar `/api/search?q=test` (200 OK)

### Etapa 8: Smoke Test
- Home page (200)
- Bands index (200)
- Genealogy (200, vis-network carrega)
- Admin login (200, login funciona)
- API endpoints (200)
- Sitemap XML (200)
- Dark mode toggle funciona
- Search funciona
