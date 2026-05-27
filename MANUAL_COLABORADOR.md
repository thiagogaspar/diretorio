# Manual do Colaborador — LISTA

Guia para contribuir com o diretório de genealogia musical LISTA. Enquanto o sistema de cadastro não estiver disponível, envie as informações por e-mail ou conforme combinado com a equipe.

---

## O que pode ser cadastrado

| Tipo | Descrição |
|------|-----------|
| **Banda** | Grupo musical com discografia e integrantes |
| **Artista** | Músico individual com histórico de bandas |
| **Álbum** | Disco/EP de uma banda |
| **Gravadora** | Selo ou gravadora que lança os discos |
| **Relação entre bandas** | Conexões como "membros formaram", "evoluiu para" etc. |

---

## 1. Banda

Campos necessários:

| Campo | Obrigatório | Descrição |
|-------|-------------|-----------|
| **Nome** | ✅ | Nome oficial da banda sem abreviações |
| **Gênero(s)** | ✅ | Ex: Heavy Metal, Punk Rock, Hardcore. Pode ter mais de um |
| **Ano de formação** | ✅ | Ano que a banda começou |
| **Origem** | ✅ | Cidade e país: Ex: "São Paulo, SP, Brasil" |
| **Ano de dissolução** | ❌ | Se a banda acabou |
| **Ativa** | ❌ | Sim/Não. Se não informado, considera-se ativa |
| **Gravadora** | ❌ | Nome da gravadora que lança os discos |
| **Biografia** | ❌ | Texto livre sobre a história da banda (1-3 parágrafos) |
| **Foto** | ❌ | Foto oficial, formato retrato (300×400px recomendado) |
| **Hero** | ❌ | Imagem grande para o topo da página (1200×400px) |
| **Galeria** | ❌ | Até 10 fotos adicionais |

### Exemplo de envio

```
Banda: Crypta
Gêneros: Death Metal
Formação: 2019
Origem: São Paulo, SP, Brasil
Ativa: Sim
Gravadora: Napalm Records
Biografia: Crypta é uma banda brasileira de death metal formada em 2019 pela baixista Fernanda Lira e pela baterista Luana Dametto, ex-integrantes do Nervosa...
```

---

## 2. Artista (Músico)

| Campo | Obrigatório | Descrição |
|-------|-------------|-----------|
| **Nome** | ✅ | Nome artístico completo |
| **Data de nascimento** | ❌ | Formato: YYYY-MM-DD (ex: 1990-05-15) |
| **Data de falecimento** | ❌ | Se falecido. Mesmo formato |
| **Origem** | ✅ | Cidade e país de origem |
| **Ativo** | ❌ | Sim/Não |
| **Biografia** | ❌ | Breve histórico da carreira |
| **Foto** | ❌ | Retrato 300×400px |

### Integrante de banda

Para cada banda que o artista tocou, informe:

| Campo | Obrigatório | Descrição |
|-------|-------------|-----------|
| **Banda** | ✅ | Nome da banda |
| **Função** | ✅ | Vocalista, Guitarrista, Baixista, Baterista etc. |
| **Ano de entrada** | ❌ | Quando entrou |
| **Ano de saída** | ❌ | Quando saiu (se aplicável) |
| **Membro atual** | ❌ | Ainda está na banda? |

### Exemplo

```
Artista: Fernanda Lira
Nascimento: 1992-08-20
Origem: São Paulo, SP, Brasil
Ativo: Sim

Bandas:
- Nervosa (2013–2020) — Baixista/Vocalista
- Crypta (2020–presente) — Baixista/Vocalista
```

---

## 3. Álbum

| Campo | Obrigatório | Descrição |
|-------|-------------|-----------|
| **Banda** | ✅ | Nome da banda |
| **Título** | ✅ | Nome do álbum |
| **Ano de lançamento** | ✅ | Ano |
| **Capa** | ❌ | Imagem 600×600px |
| **Descrição** | ❌ | Texto sobre o álbum |
| **Tracklist** | ❌ | Lista de faixas numeradas |

### Exemplo

```
Banda: Crypta
Título: Echoes of the Soul
Ano: 2021
Tracklist:
1. Awakening
2. Starvation
3. Possessed
4. Death Arcana
5. From the Ashes
6. The Outsider
7. Lift the Curse
8. Under the Black Wings
9. Echoes of the Soul
10. Agent of Chaos
```

---

## 4. Gravadora

| Campo | Obrigatório | Descrição |
|-------|-------------|-----------|
| **Nome** | ✅ | Nome oficial |
| **País** | ❌ | País de origem |
| **Ano de fundação** | ❌ | |
| **Website** | ❌ | URL do site oficial |
| **Logo** | ❌ | Imagem da logomarca |
| **Descrição** | ❌ | Texto sobre a gravadora |

---

## 5. Relações entre bandas

Um dos diferenciais do LISTA é mapear como as bandas se conectam.

| Tipo | Significado | Exemplo |
|------|-------------|---------|
| **Split Into** | A banda se dividiu em duas ou mais | Ossos → Hidra + Cólera |
| **Evolved Into** | A banda mudou de nome/evoluiu | Sepultura (Belo Horizonte) → Sepultura |
| **Members Formed** | Membros desta banda formaram outra | Integrantes do Krisiun formam o Hateful |
| **Side Project** | Projeto paralelo de integrantes | Max Cavalera → Soulfly |
| **Merged Into** | Bandas se fundiram em uma | |
| **Rebranded As** | A banda trocou de nome | |

### Exemplo

```
Relação: Members Formed
Banda A: Crypta
Banda B: Nervosa
Descrição: Crypta foi formada após Fernanda Lira e Luana Dametto saírem do Nervosa
Ano: 2020
```

---

## Imagens — Especificações

| Tipo | Formato | Tamanho | Proporção |
|------|---------|---------|-----------|
| Foto banda | JPG/WebP | 300×400px | 3:4 retrato |
| Hero banda | JPG/WebP | 1200×400px | 3:1 paisagem |
| Foto artista | JPG/WebP | 300×400px | 3:4 retrato |
| Capa álbum | JPG/WebP | 600×600px | 1:1 quadrado |
| Logo gravadora | PNG/WebP | 400×400px | 1:1 ou livre |

- Formato preferido: **WebP**
- Tamanho máximo por arquivo: **1MB**
- Nome do arquivo: sem espaços, use `_` ou `-` (ex: `crypta-foto.jpg`)

---

## Como enviar

Enquanto o acesso direto ao sistema não estiver disponível:

1. **Copie os campos acima** no corpo do e-mail ou documento
2. **Preencha** com os dados da banda/artista
3. **Anexe as imagens** nos tamanhos recomendados
4. **Envie** conforme combinado com a equipe

---

## Dicas para um bom cadastro

- **Prefira fontes confiáveis**: Wikipedia, site oficial, Metal Archives, Discogs
- **Seja consistente**: use o mesmo nome da banda em todos os lugares
- **Grave o ano de formação**: mesmo que aproximado, é essencial
- **Biografia em português**: nosso público é brasileiro
- **Fotos sem direitos autorais**: ou com permissão do fotógrafo
- **Na dúvida, não invente**: é melhor deixar um campo vazio do que colocar informação errada

---

## Checklist antes de enviar

- [ ] Nome da banda/artista está correto e completo?
- [ ] Gênero(s) musical(is) preenchido(s)?
- [ ] Ano de formação preenchido?
- [ ] Origem (cidade/país) preenchida?
- [ ] Foto nos tamanhos corretos?
- [ ] Biografia revisada e em português?
- [ ] Integrantes com função definida?
- [ ] Relações entre bandas descritas?
