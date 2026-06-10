---
name: security-hardening
description: "Use quando auditar ou implementar segurança: CSP headers, XSS prevention, SQL injection, role-based access control, rate limiting, input validation, HTML sanitization, authentication, authorization, secure headers. Domínios: middleware de segurança, Content Security Policy, sanitização de input, controle de acesso RBAC, rate limiting por rota, whitelist de parâmetros."
license: MIT
---

# Security Hardening — LISTA

> **TL;DR** — CSP: img-src restrito (picsum, wikimedia) · Rate limiting: POST 5/min, GET listagens 30/min, API 60/min · RBAC: admin/editor/viewer roles · Whitelist colunas em `orderBy()` SEMPRE · NUNCA `{!! !!}` sem HTML Purifier · SQL via Eloquent (parametrizado) · Gate: verificar throttle middleware + CSP headers

## Medidas Implementadas

### CSP Headers (`SecurityHeaders` middleware)
```
default-src 'self';
script-src 'self' https://cdnjs.cloudflare.com 'unsafe-inline';
style-src 'self' 'unsafe-inline';
img-src 'self' data: https://picsum.photos *.picsum.photos *.wikimedia.org;
font-src 'self' data:;
connect-src 'self';
frame-ancestors 'none';
base-uri 'self';
form-action 'self';
```

### Rate Limiting
| Rota | Limite |
|------|--------|
| `/bands`, `/artists` | 30/min |
| `/albums`, `/labels`, `/blog` | 30/min |
| `/genealogy` | 30/min |
| `/comments` (POST) | 5/min |
| `/suggestions` (POST) | 5/min |
| `/register` (GET/POST) | 10/min / 5/min |
| `/api/*` | 60/min |
| `/login`, `/logout`, `/profile`, `/sitemap` | 10/min |
| `/favorites/*` | 30/min |

### Role-Based Access (User model)
```php
const ROLE_ADMIN = 'admin';
const ROLE_EDITOR = 'editor';
const ROLE_VIEWER = 'viewer';
```

### Input Sanitization
- HTML Purifier (config/purify.php) em rich editor
- `{{ }}` Blade escaping (nunca `{!! !!}` sem purify)
- Sort column whitelist em BandService, ArtistService
- EditSuggestion field whitelist no controller
- Request validation com Form Requests ou validation array

### SQL Injection
- Tudo via Eloquent (parametrizado)
- Nenhuma raw SQL

### Mitigações já aplicadas (P0)
- XSS: `request('label')` escapado em bands/index
- XSS: infobox component `{!! !!}` → `{{ }}`
- XSS: label link raw HTML removido
- Sort injection: whitelist columns
- EditSuggestion field whitelist
