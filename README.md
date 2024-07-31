# Projeto Laravel com Docker

## Introdução

Este projeto oferece um ambiente de desenvolvimento isolado e reproduzível para aplicações Laravel, utilizando Docker. Ao containerizar a aplicação, você garante que o ambiente de desenvolvimento seja idêntico ao de produção, evitando problemas de compatibilidade.

## Estrutura do Projeto

├── Dockerfile
├── docker-compose.yml
├── .env.example
├── .env
└── app/


## Configuração

1. **Crie o arquivo env:**
   Para uso com docker use a seguinte parametrização:
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=lojacorr
    DB_USERNAME=lojacorr
    DB_PASSWORD=lojacorr
 Ou
 cp .env.example .env

2. **Inicie os contêineres:**
docker-compose up --build

3. **Acesse o contêiner do Laravel**
docker-compose exec app bash

4. **Dentro do contêiner, instale as dependencias, gere a chave de aplicação e execute as migrações e seeders:**
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed

5. **Acessando o phpMyAdmin:**
Caso queira visualizar configuraçoes, tabelas, dados e etc, acesse:
http://localhost:8080
Faça login com:
Usuário: lojacorr
Senha: lojacorr

6. **Acessando a Aplicação:**
Aplicação Laravel: http://localhost:8000

7. **Autenticação:**
Usuário padrão do Laravel:
Email: admin@lojacorr.com
Senha: admin
O usuário padrão pode ser criado com o seeder fornecido. Certifique-se de que o seeder foi executado.
