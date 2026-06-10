---
name: testing-phpunit
description: "Use quando criar ou editar PHPUnit tests, factories, test cases, ou config de teste. Domínios: feature tests para rotas, unit tests para services, factory definitions, assertions, happy/failure/edge paths, mocks, database testing com SQLite :memory:."
license: MIT
---

# Testing PHPUnit — LISTA

> **TL;DR** — PHPUnit classes (NÃO Pest) · SQLite :memory: + cache array + queue sync · Factories para dados de teste · Feature tests > Unit tests · Cubra happy + failure + edge paths · Teste como guest e authenticated · Nunca remova testes existentes · Gate: `ddev artisan test --compact --filter=` + suite completo

## Configuração do Test Suite

```xml
<!-- phpunit.xml -->
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
<env name="CACHE_STORE" value="array"/>
<env name="QUEUE_CONNECTION" value="sync"/>
<env name="SESSION_DRIVER" value="array"/>
<env name="BCRYPT_ROUNDS" value="4"/>
```

## Testes Existentes

### `tests/Feature/MainRoutesTest.php` (167 linhas, 20 testes)
Cobre:
- Home, bands index/detail, artists index/detail
- Labels index/detail, albums index/detail, genre page
- Genealogy page, blog index, sitemap, register page
- Favorites (guest redirect), 404 page
- Search API, API bands/artists/genres/labels
- Band filters (genre + year)

### Padrão
```php
public function test_home_page_returns_200(): void
{
    $response = $this->get('/');
    $response->assertStatus(200);
}
```

## Regras
1. PHPUnit classes (não Pest)
2. Use factories com `create()` ou `make()`
3. Feature tests com `$this->get()`, `$this->post()`, etc.
4. Teste como guest e como authenticated user
5. Para rotas autenticadas: `$this->actingAs(User::factory()->create())`
6. Comando: `ddev artisan test --compact --filter=NomeTest`
