# Gerenciador de portfólio API

<div align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">

![Status](http://img.shields.io/static/v1?label=STATUS&message=FINALIZADO&color=RED&style=for-the-badge)

[![Build](https://img.shields.io/github/actions/workflow/status/felipesilva15/portfolio-manager-api/build.yml?logo=github&label=build)](https://github.com/felipesilva15/portfolio-manager-api/actions/workflows/build.yml)
[![Tests](https://img.shields.io/github/actions/workflow/status/felipesilva15/portfolio-manager-api/run-tests.yml?logo=github&label=testes)](https://github.com/felipesilva15/portfolio-manager-api/actions/workflows/run-tests.yml)
![Top language](https://img.shields.io/github/languages/top/felipesilva15/portfolio-manager-api.svg)
![Language count](https://img.shields.io/github/languages/count/felipesilva15/portfolio-manager-api.svg)
![Repository size](https://img.shields.io/github/repo-size/felipesilva15/portfolio-manager-api.svg)
[![Last commit](https://img.shields.io/github/last-commit/felipesilva15/portfolio-manager-api.svg)](https://github.com/felipesilva15/portfolio-manager-api/commits/main)
[![Issues](https://img.shields.io/github/issues/felipesilva15/portfolio-manager-api.svg)](https://github.com/felipesilva15/portfolio-manager-api/issues)
[![Licence](https://img.shields.io/github/license/felipesilva15/portfolio-manager-api.svg)](https://github.com/felipesilva15/portfolio-manager-api/blob/main/LICENSE)

</div>

API RESTful desenvolvida em Laravel com MySQL com intuito de fornecer o backend para o meu site de portólio. Possui autenticação via JWT, CRUD, documentação com Swagger, testes automatizados, CI/CD com publicação no DockerHub e deploy em uma VPS.

## 📑 Sumário

- [Descrição geral](#-descrição-geral)
- [Principais funcionalidades](#-principais-funcionalidades)
- [Tecnologias utilizadas](#%EF%B8%8F-tecnologias-utilizadas)
- [Executando localmente](#-executando-localmente)
- [Executando com Docker](#-executando-com-docker)
- [Testes](#-testes)
- [Documentação no Swagger](#-documentação-no-swagger)
- [Endpoints](#-endpoints)
- [Autores](#%EF%B8%8F-autores)
- [Licença](#-licença)

## 📘 Descrição Geral

- **Versão:** 1.0.0  
- **Autor:** [Felipe Silva](mailto:felipe.allware@gmail.com)  
- **Licença:** [Licença API](https://github.com/felipesilva15/portfolio-manager-api/blob/main/LICENSE)
- **Deploy:** [Swagger](https://portfolio-manager-api.felipesilva15.com.br/api/documentation)

## ⚙ Principais funcionalidades

- CRUD completo.
- CI/CD com GitHub Actions e deploy para DockerHub.
- Documentação com Swagger.
- Testes automatizados (Unitários e de integração).
- Autenticação com JWT.

## 🚀 Executando localmente

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

### 📋 Pré-requisitos

- PHP v8.2.0
- Composer

### 🔧 Instalação

1. Clone o projeto utilizando o comando abaixo

    ``` bash
    git clone https://github.com/felipesilva15/portfolio-manager-api.git
    ```

2. Acesse a pasta dos fonts deste projeto

    ```bash
    cd portfolio-manager-api
    ```

3. Instale as dependências do projeto

    ```bash
    composer install
    ```

4. Copie o arquivo de exemplo de variáveis de ambiente  

    ```bash
    cp .env.example .env
    ```

5. Atualize as credenciais de acesso ao seu banco de dados preenchendo os campos abaixo no arquivo `.env`

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=portfolio_manager
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Gere as tabelas da aplicação e a semente para o serviço de autenticação

    ```bash
    php artisan migrate --seed
    ```

7. Gere a chave da aplicação

    ```bash
    php artisan key:generate
    ```

8. Gere o secret para a validação da assinatura do JWT

    ```bash
    php artisan jwt:secret
    ```

9. Inicie a aplicação

    ```bash
    php artisan serve
    ```

10. Acesse a aplicação em <http://localhost:8000>.

## 🐳 Executando com Docker

```bash
# Realiza o build da imagem e executa o container
docker compose up -d
```

Após completar a execução, basta acessar a aplicação em <http://localhost:8080/api/documentation>.

## 🧪 Testes

Execute o comando de testes do Laravel (PHPUnit).

```bash
php artisan test
```

## 📄 Documentação no Swagger

Acesse a documentação através do endpoint `/api/documentation` (Veja a versão do [deploy](https://rifa-api.felipesilva15.com.br/api/documentation)).

## 📁 Endpoints

### 🔐 Autenticação

| Método | Endpoint                 | Descrição                              |
|--------|--------------------------|----------------------------------------|
| POST   | `/api/login`             | Obtém o token JWT para autenticação    |
| POST   | `/api/logout`            | Realiza o logout e invalida o token    |
| POST   | `/api/refresh-token`     | Atualiza um token JWT                  |
| GET    | `/api/me`                | Retorna o usuário autenticado do token |

### 🚧 Projetos

| Método | Endpoint                 | Descrição                     |
|--------|--------------------------|-------------------------------|
| GET    | `/api/project`           | Lista todos os projetos       |
| GET    | `/api/project/{id}`      | Detalha um projeto pelo ID    |
| POST   | `/api/project`           | Cadastra um novo projeto      |
| PUT    | `/api/project/{id}`      | Atualiza um projeto           |
| DELETE | `/api/project/{id}`      | Remove um projeto             |
| GET    | `/api/project/{id}/tags` | Lista as tags de um projeto   |

### 🏷 Tags

| Método | Endpoint                 | Descrição                     |
|--------|--------------------------|-------------------------------|
| GET    | `/api/tag`               | Lista todos as tags           |
| GET    | `/api/tag/{id}`          | Detalha uma tag pelo ID       |
| POST   | `/api/tag`               | Cadastra uma novo tag         |
| PUT    | `/api/tag/{id}`          | Atualiza uma tag              |
| DELETE | `/api/tag/{id}`          | Remove uma tag                |
| GET    | `/api/tag/{id}/projects` | Lista os projetos de uma tag  |

### 💼 Experiências

| Método | Endpoint                 | Descrição                         |
|--------|--------------------------|-----------------------------------|
| GET    | `/api/experience`        | Lista todos as experiências       |
| GET    | `/api/experience/{id}`   | Detalha uma experiência pelo ID   |
| POST   | `/api/experience`        | Cadastra uma novo experiência     |
| PUT    | `/api/experience/{id}`   | Atualiza uma experiência          |
| DELETE | `/api/experience/{id}`   | Remove uma experiência            |

### 🎓 Educações

| Método | Endpoint                 | Descrição                     |
|--------|--------------------------|-------------------------------|
| GET    | `/api/education`         | Lista todos as educações      |
| GET    | `/api/education/{id}`    | Detalha uma educação pelo ID  |
| POST   | `/api/education`         | Cadastra uma novo educação    |
| PUT    | `/api/education/{id}`    | Atualiza uma educação         |
| DELETE | `/api/education/{id}`    | Remove uma educação           |

### 🔧 Certificações

| Método | Endpoint                     | Descrição                         |
|--------|------------------------------|-----------------------------------|
| GET    | `/api/certifiaction`         | Lista todos as certificações      |
| GET    | `/api/certifiaction/{id}`    | Detalha uma certificação pelo ID  |
| POST   | `/api/certifiaction`         | Cadastra uma novo certificação    |
| PUT    | `/api/certifiaction/{id}`    | Atualiza uma certificação         |
| DELETE | `/api/certifiaction/{id}`    | Remove uma certificação           |

### ✉ Contatos

| Método | Endpoint             | Descrição                     |
|--------|----------------------|-------------------------------|
| GET    | `/api/contact`       | Lista todos os contatos       |
| GET    | `/api/contact/{id}`  | Detalha um contato pelo ID    |
| POST   | `/api/contact`       | Cadastra um novo contato      |
| PUT    | `/api/contact/{id}`  | Atualiza um contato           |
| DELETE | `/api/contact/{id}`  | Remove um contato             |

### ⭐ Habilidades

| Método | Endpoint             | Descrição                         |
|--------|----------------------|-----------------------------------|
| GET    | `/api/skill`         | Lista todos as habilidades        |
| GET    | `/api/skill/{id}`    | Detalha uma habilidade pelo ID    |
| POST   | `/api/skill`         | Cadastra uma novo habilidade      |
| PUT    | `/api/skill/{id}`    | Atualiza uma habilidade           |
| DELETE | `/api/skill/{id}`    | Remove uma habilidade             |

### 🔹 Tipos de projeto

| Método | Endpoint                 | Descrição                             |
|--------|--------------------------|---------------------------------------|
| GET    | `/api/project-type`      | Lista todos os tipos de projeto       |
| GET    | `/api/project-type/{id}` | Detalha um tipo de projeto pelo ID    |
| POST   | `/api/project-type`      | Cadastra um novo tipo de projeto      |
| PUT    | `/api/project-type/{id}` | Atualiza um tipo de projeto           |
| DELETE | `/api/project-type/{id}` | Remove um tipo de projeto             |

### 👨‍💻 Tecnologias

| Método | Endpoint                 | Descrição                         |
|--------|--------------------------|-----------------------------------|
| GET    | `/api/technology`        | Lista todos as tecnologias        |
| GET    | `/api/technology/{id}`   | Detalha uma tecnologia pelo ID    |
| POST   | `/api/technology`        | Cadastra uma novo tecnologia      |
| PUT    | `/api/technology/{id}`   | Atualiza uma tecnologia           |
| DELETE | `/api/technology/{id}`   | Remove uma tecnologia             |

### 📢 Testemunhos

| Método | Endpoint                 | Descrição                         |
|--------|--------------------------|-----------------------------------|
| GET    | `/api/testimonial`       | Lista todos os testemunhos        |
| GET    | `/api/testimonial/{id}`  | Detalha um testemunho pelo ID     |
| POST   | `/api/testimonial`       | Cadastra um novo testemunho       |
| PUT    | `/api/testimonial/{id}`  | Atualiza um testemunho            |
| DELETE | `/api/testimonial/{id}`  | Remove um testemunho              |

### 🔗 Links

| Método | Endpoint             | Descrição                     |
|--------|----------------------|-------------------------------|
| GET    | `/api/link`          | Lista todos os links          |
| GET    | `/api/link/{id}`     | Detalha um link pelo ID       |
| POST   | `/api/link`          | Cadastra um novo link         |
| PUT    | `/api/link/{id}`     | Atualiza um link              |
| DELETE | `/api/link/{id}`     | Remove um link                |

### 👤 Usuários

| Método | Endpoint             | Descrição                     |
|--------|----------------------|-------------------------------|
| GET    | `/api/user`          | Lista todos os usuários       |
| GET    | `/api/user/{id}`     | Detalha um usuário pelo ID    |
| PUT    | `/api/user/{id}`     | Atualiza um usuário           |
| DELETE | `/api/user/{id}`     | Remove um usuário             |

## 🛠️ Tecnologias utilizadas

- **Laravel 12.0**
- **PHP 8.2**
- **MySQL**
- **JWT**
- **Swagger UI**
- **Docker**
- **GitHub Actions (CI/CD)**

## ✒️ Autores

- **Felipe Silva** - *Desenvolvedor e mentor* - [felipesilva15](https://github.com/felipesilva15)

## 📄 Licença

Este projeto está sob a licença (MIT) - veja o arquivo [LICENSE](https://github.com/felipesilva15/portfolio-manager-api/blob/main/LICENSE) para detalhes.

---

Documentado por [Felipe Silva](https://github.com/felipesilva15) 😊
