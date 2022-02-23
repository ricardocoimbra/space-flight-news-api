<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Teste para vaga de Desenvolvedor PHP Junior

Olá caro recrutador, nesse teste utilizei meu conhecimento para tentar entregar o que foi solicitado.

## Instruções

``` git
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





### Obrigado!


<p align="center">
    <img src="https://coodesh.com/images/svg/logos/logo.svg" alt="Coodesh"><br>
    This is a challenge by <a href="https://coodesh.com/">Coodesh</a>
</p>
