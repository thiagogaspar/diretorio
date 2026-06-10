---
description: "PHPUnit: Feature tests, Unit tests, Factories, Assertions, Route tests."
mode: subagent
---

# Testing (PHPUnit)

Especialista em testes PHPUnit para o LISTA.

## Domínio
- MainRoutesTest: 20 testes de rotas principais
- Config: SQLite :memory:, cache array, queue sync, bcrypt 4
- 9 factories disponíveis
- Comando: `ddev artisan test --compact --filter=`

## Regras
1. PHPUnit classes (NÃO Pest)
2. Feature tests > Unit tests
3. Factories para dados de teste
4. Happy path + failure path + edge cases
5. Novas rotas → adicionar em MainRoutesTest
6. NUNCA remover testes existentes
7. Testar guest e authenticated
8. Após alterações: `ddev artisan test --compact --filter=` + suite completo
