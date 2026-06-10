# Workflow: Auditoria de Segurança

Audita CSP, XSS, SQL injection, RBAC, rate limiting, input sanitization.

## Sequência

### Etapa 1: CSP Headers
**Subagente**: `security` (Pro, 15 steps)
- Verificar `app/Http/Middleware/SecurityHeaders.php`
- Confirmar que todos os domínios em `img-src`, `script-src`, `style-src` são necessários
- Remover CDNs não usados
- Verificar `frame-ancestors 'none'`, `base-uri 'self'`, `form-action 'self'`
- **Gate**: verificar headers com `curl -I` ou browser devtools

### Etapa 2: XSS Scan
**Subagente**: `security` (Pro, 20 steps)
- Buscar `{!! !!}` em todos os arquivos Blade (nunca sem HTML Purifier)
- Verificar se `request()` ou `$_GET` são escapados
- Verificar componentes (infobox, breadcrumb) — escapamento correto
- Verificar `@json` e `JSON.parse` para XSS em JS
- **Gate**: `ddev bin pint --format agent`

### Etapa 3: SQL Injection
**Subagente**: `security` (Pro, 10 steps)
- Confirmar que todas as queries são Eloquent (não raw SQL)
- Verificar `orderBy()` com whitelist de colunas
- Verificar `DB::raw()` — se existe, justificar
- **Gate**: revisão manual de `DB::raw()` e `orderBy()`

### Etapa 4: Rate Limiting
**Subagente**: `security` (Pro, 10 steps)
- Verificar throttle em todas as rotas públicas:
  - POST: 5/min (comments, suggestions, register)
  - GET listagens: 30/min (bands, artists, albums, labels, blog, genealogy)
  - API: 60/min
  - Auth: 10/min (login, register)
- **Gate**: `ddev artisan route:list` (verificar middleware throttle)

### Etapa 5: Role-Based Access
**Subagente**: `security` (Pro, 15 steps)
- Verificar `canDelete()`, `canRestore()`, `canForceDelete()` em Filament resources
- Verificar middleware `CheckAdminRole` em rotas admin
- Verificar ProfileController (só owner/admin pode ver `/users/{id}`)
- Verificar API auth (Sanctum tokens, scopes)
- **Gate**: revisão manual dos resource policies

### Etapa 6: Input Sanitization
**Subagente**: `security` (Pro, 10 steps)
- Verificar HTML Purifier config (`config/purify.php`)
- Verificar validação em controllers (Form Requests ou validation arrays)
- Verificar EditSuggestion field whitelist
- **Gate**: `ddev artisan test --compact`

### Etapa 7: Relatório
- Listar vulnerabilidades encontradas (severidade: P0/P1/P2)
- Recomendar correções específicas
- Criar issues/P0 bugs se necessário
