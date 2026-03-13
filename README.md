# 📚 Controle de Estoque — SENAI Livros Didáticos

Sistema de gerenciamento de estoque de livros didáticos desenvolvido para o SENAI, permitindo o controle completo do acervo com autenticação, movimentações de entrada e saída, alertas de reposição e histórico de ações.

---

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades](#funcionalidades)
- [Requisitos Não Funcionais](#requisitos-não-funcionais)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Prototipagem](#prototipagem)
- [Metodologias Ágeis](#metodologias-ágeis)
- [Roadmap de Sprints](#roadmap-de-sprints)
- [Como Executar](#como-executar)
- [Versionamento](#versionamento)
- [Autoras](#autoras)

---

## 💡 Sobre o Projeto

O **SENAI Livros** é uma aplicação web para controle de estoque de livros didáticos, voltada para almoxarifes e coordenadores da instituição. O sistema permite registrar entradas e saídas de livros, consultar o saldo em tempo real e emitir alertas quando o estoque está abaixo do mínimo necessário.

---

## ✅ Funcionalidades

| ID | Requisito | Descrição | Prioridade |
|----|-----------|-----------|------------|
| RF1 | Autenticação | Login via JWT para Almoxarifes e Coordenadores | Alta |
| RF2 | Cadastro de Livros | CRUD de títulos (Título, ISBN, Matéria) | Alta |
| RF3 | Entrada de Estoque | Registrar chegada de livros e somar ao saldo atual | Alta |
| RF4 | Saída de Estoque | Subtrair livros do saldo ao retirar para turmas | Crítica |
| RF5 | Consulta de Saldo | Listagem em tempo real da quantidade de cada livro | Alta |
| RF6 | Alerta de Reposição | Listar livros com estoque abaixo de 10 unidades | Média |
| RF7 | Histórico / Log | Registrar quem fez a movimentação e quando | Baixa |

---

## ⚙️ Requisitos Não Funcionais

| ID | Categoria | Descrição |
|----|-----------|-----------|
| RNF1 | Segurança | Senhas criptografadas com BCrypt e rotas protegidas por Token |
| RNF2 | Integridade | Uso de transações ACID (Atomicidade, Consistência, Isolamento e Durabilidade) para evitar erros de cálculo no saldo |
| RNF3 | Performance | Respostas da API em menos de 200ms para consultas simples |
| RNF4 | Usabilidade | Mensagens de erro claras (ex: "Estoque insuficiente para a Turma A") |
| RNF5 | Padrão | Arquitetura REST com respostas em JSON |

---

## 🛠️ Tecnologias Utilizadas

- **Back-End:** Laravel (PHP)
- **Banco de Dados:** MySQL (relacional)
- **ORM:** Eloquent ORM
- **API:** RESTful com retorno em JSON
- **Padrões:** PSR e Clean Code
- **Autenticação:** JWT
- **Testes:** Insomnia / Postman
- **Versionamento:** Git + GitHub

---

## 🎨 Prototipagem

O projeto passou por três etapas de prototipagem:

- **Baixa Fidelidade (Wireframes):** Rascunho focado na estrutura e no fluxo de telas — rápido e barato para validar ideias iniciais.
- **Média Fidelidade (Mockups):** Adiciona cores, fontes e estilo gráfico (identidade visual SENAI — vermelho `#C8102E`), ainda como imagem estática.
- **Alta Fidelidade (Funcional):** Simula o comportamento real do software, com botões clicáveis e transições, ideal para testes finais com usuários.

---

## 📌 Metodologias Ágeis

O projeto é desenvolvido em **Sprints** curtas (iterações de 2 a 4 semanas), seguindo os princípios ágeis.

**Kanban (Trello):** acompanhamento visual do fluxo de trabalho com cartões por tarefa.  
🔗 [Board no Trello](https://trello.com/b/6oArYACB/biblioteca-senai)

---

## 🗓️ Roadmap de Sprints

| Sprint | Período | Entregas |
|--------|---------|----------|
| **Sprint 1** | 20/02 – 25/02/2026 | Levantamento de requisitos, prototipagem, metodologias ágeis, versionamento e documentação inicial |
| **Sprint 2** | 13/03 – 18/03/2026 | Revisão de requisitos, prototipagem, diagrama de classes e diagrama de sequência |
| **Sprint 3** | 01/04 – 10/04/2026 | Revisão dos diagramas e diagramação do banco de dados |
| **Sprint 4** | 29/04 – 08/05/2026 | Revisão do banco de dados, testes de acessibilidade e funcionalidades |
| **Sprint 5** | 27/05 – 29/05/2026 | Qualidade de software e implantação (Parte I) |
| **Sprint 6** | 12/06 – 17/06/2026 | Implantação (Parte II), entrega e apresentação final |

---


## 🔀 Versionamento

Projeto versionado com Git e hospedado no GitHub.

```bash
git clone https://github.com/MariaEduarda-Nepo/ProjetoEstoqueLivros.git
```

---

## 👩‍💻 Autoras

Feito com ❤️ por:

| [<img src="https://github.com/MariaEduarda-Nepo.png" width="80px" style="border-radius:50%"/><br><sub><b>Maria Eduarda Nepomuceno</b></sub>](https://github.com/MariaEduarda-Nepo) | [<img src="https://github.com/Takemi2005.png" width="80px" style="border-radius:50%"/><br><sub><b>Luiza Takemi Araujo</b></sub>](https://github.com/Takemi2005) |
|:---:|:---:|

Alunas do curso Técnico de Análise e Desenvolvimento de Sistemas — **SENAI-SP**
