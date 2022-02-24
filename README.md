<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


![Badge](https://img.shields.io/badge/MySpaceFlightNewsAPI-1.0.0-%23542F61?style=for-the-badge)
![Badge](https://img.shields.io/badge/Laravel-v8.75-red?style=for-the-badge&logo=laravel)
![Badge](https://img.shields.io/badge/PHP-v^7.4|^8.0-%233570B2?style=for-the-badge&logo=php)
![Badge](https://img.shields.io/badge/Composer-v2.1.9-%238B4513?style=for-the-badge&logo=appveyor)


# Teste para vaga de Desenvolvedor PHP Junior

Olá caro recrutador, nesse teste utilizei meus conhecimentos para tentar entregar o que foi solicitado.

## 🎯 Desafio proposto:



## 🛠 Ferramentas

#### PHP
#### Laravel
#### Guzzle
#### MySQL
#### Docker
#### Nginx

## 📦 Requisitos para rodar o sistema

-[PHP 7.4 ou superior](https://www.php.net/downloads)
-[Composer](https://getcomposer.org/download/)
-[Docker](https://getcomposer.org/download/)

## 🚀 Executando o projeto

Baixe o projeto ou faça um clone 

```bash
  git clone https://github.com/ricardocoimbra/space-flight-news-api.git
```

Faça uma cópia do arquivo .env.exeample para .env e edite as configurações de acesso ao banco de dados.
```bash
  cp .env.example .env
```

de:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
para:

```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=spaceflight_database
DB_USERNAME=spaceflight_user
DB_PASSWORD=sp4c3fl1gh7
```

Execute o comando para fazer o deploy no docker
```docker
    docker-compose up -d
```

A resposta do terminal dever ser
```bash
Successfully built <a8f619d421f5> #Id do container
Successfully tagged spaceflight:latest
Creating spaceflight-app   ... done
Creating spaceflight-nginx ... done
Creating spaceflight-db    ... done
```

baixe as dependências do composer 
```shell
   docker exec spaceflight-app composer install
```

crie uma chave criptografada para o sistema
```shell
   docker exec spaceflight-app php artisan key:generate
```

crie as tabelas no banco de dados, executando a migração
```shell
   docker exec spaceflight-app php artisan migrate 
```

```markdown
 GET
```

Para pegar os dados da API https://api.spaceflightnewsapi.net/v3/articles para essa, execute o comando de seed 
```shell
   docker exec spaceflight-app php artisan db:seed
```

### API Endpoint

The following endpoints are available:
####  ° Articles
| Endpoints                             | Usage                                       | 
| ------------------------------------- | ------------------------------------------- | 
| `GET /api/`                           | Index message                               |
| `GET /api/v1/articles`                | Get all of the articles.                    |
| `GET /api/v1/articles/:id`            | Get the details of a single article         |
| `POST /api/v1/articles`               | Create an article.                          | 
| `PATCH /api/v1/articles/:id`          | Edit the details of an existing article.    | 
| `DELETE /api/v1/articles/:id`         | Remove the article.                         |


### Obrigado!

<p align="center">
    <img src="https://coodesh.com/images/svg/logos/logo.svg" alt="Coodesh"><br>
    This is a challenge by <a href="https://coodesh.com/">Coodesh</a>
</p>
