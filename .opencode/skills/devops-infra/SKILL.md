---
name: devops-infra
description: "Use quando configurar ambiente de desenvolvimento, Docker, DDEV, deploy Railway, Sail, ou produção. Domínios: DDEV project config, Dockerfile multi-stage, FrankenPHP, Railway deploy, compose.yaml, nginx/apache config, entrypoint scripts, SSL/TLS, healthcheck, build optimization."
license: MIT
---

# DevOps Infra — LISTA

> **TL;DR** — Dev: `ddev start/stop`, produção: FrankenPHP Docker · Sempre `config:cache` em produção · Railway deploy automático via git push · Healthcheck `/` · Extensões PHP: pdo_mysql, gd, opcache, intl · Gate: `ddev start` (dev) ou `docker compose up` (prod)

## Ambientes

### Desenvolvimento (DDEV)
- **URL**: https://lista.ddev.site
- **PHP**: 8.4 (nginx-fpm)
- **DB**: MariaDB 11.8
- **Comando**: `ddev start` / `ddev stop`
- **Artisan**: `ddev artisan <cmd>`
- **Composer**: `ddev composer <cmd>`
- **NPM**: `ddev npm <cmd>`
- **Pint**: `ddev bin pint --format agent`
- **Testes**: `ddev artisan test --compact`

### Desenvolvimento Alternativo (Sail)
- `compose.yaml`: PHP 8.5 + MySQL 8.4
- **Comando**: `vendor/bin/sail up -d`
- **Artisan**: `vendor/bin/sail artisan <cmd>`

### Produção (Docker)
- **Imagem**: `dunglas/frankenphp:1-php8.4-bookworm`
- **Server**: FrankenPHP (porta 8080)
- **PHP Ext**: pdo_mysql, mysqli, mbstring, intl, zip, gd, opcache
- **Node**: 22 (build assets)
- **Build**: multi-stage (npm ci → build → prune --omit=dev)
- **Entrypoint**: config:cache → migrate → create-admin-user → FrankenPHP

### Railway
- **healthcheckPath**: `/`
- **restartPolicy**: ON_FAILURE, max 10 retries
- **Build**: automático via Dockerfile
- **Domínio customizado**: configurar em Railway > Settings > Domains

## Comandos Úteis
```bash
ddev start                   # Iniciar containers
ddev stop                    # Parar containers
ddev restart                 # Reiniciar
ddev artisan <cmd>           # Rodar artisan
ddev composer <cmd>          # Rodar composer
ddev npm run build           # Build assets
ddev npm run dev             # Watch assets
ddev bin pint --format agent # Fix PHP style
ddev launch                  # Abrir no browser
ddev describe                # Info do projeto
```
