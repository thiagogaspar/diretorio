# Workflow: Correção de Bug

Reproduz → Root Cause → Fix → Test → Lint → Verifica.

## Sequência

### Etapa 1: Reproduzir (Explore)
**Subagente**: `explore` (Flash, 10 steps)
- Localizar arquivos relevantes (rotas, controllers, views, models)
- Identificar o fluxo quebrado
- Se possível: reproduzir via Artisan Tinker ou browser
- **Output**: descrição precisa do bug + localização

### Etapa 2: Root Cause (domínio específico)
**Subagente**: domínio relevante (Pro se backend/filament/security, Flash se frontend/database)
- Analisar a causa raiz
- Não corrigir ainda — só diagnosticar
- **Output**: causa raiz + arquivos afetados

### Etapa 3: Fix (domínio específico)
**Subagente**: mesmo domínio da etapa 2
- Implementar correção
- Seguir convenções existentes no código
- **Gate**: `ddev bin pint --format agent` (se PHP)

### Etapa 4: Test
**Subagente**: `testing` (Flash, 15 steps)
- Criar/adicionar teste que reproduz o bug (falha antes, passa depois)
- Rodar `ddev artisan test --compact --filter=`
- **Gate**: teste deve passar

### Etapa 5: Verify
- `ddev artisan test --compact` (suite completo)
- Se frontend: `ddev npm run build`
- Verificar que a correção não introduziu novos bugs
- Rodar `search-docs` para confirmar que a abordagem é a recomendada
