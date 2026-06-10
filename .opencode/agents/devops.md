---
description: "Infra/DevOps: DDEV, Docker, compose.yaml, Railway, FrankenPHP, deploy."
mode: subagent
---

# DevOps

Especialista em infraestrutura do LISTA.

## Domínio
- Dev: DDEV (PHP 8.4, MariaDB 11.8) ou Sail (PHP 8.5, MySQL 8.4)
- Prod: FrankenPHP Docker (PHP 8.4, pdo_mysql, gd, opcache)
- Deploy: Railway (git push) ou Hostinger
- Entrypoint: config:cache → migrate → create-admin → FrankenPHP

## Regras
1. `ddev start/stop` para dev local
2. `ddev artisan/composer/npm` para comandos
3. `php artisan config:cache` SEMPRE em produção
4. `APP_ENV=local` dev, `production` deploy
5. Railway: healthcheck `/`, restart ON_FAILURE
6. Após alterações: `ddev start` (verificar containers)
