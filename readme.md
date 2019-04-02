# Plataforma de Recrutamento

## Sobre
Uma plataforma para envio e gerenciamento de currículos.

### Tecnologias
  * Laravel 5.6
  * PHP 7.1
  * Material Design Lite
  * MongoDB

## Instalação
> Configure o seu .env

> Entre no diretório do projeto e execute os seguintes comandos
```
  - $ npm install
  - $ composer install
  - $ yarn run dev
  - $ yarn watch
```
## Configurações
* Logo: As logos devem ser colocadas em public/images, com o mesmo nome ou com outro e nesse caso lembre-se de alterar também nos locais onde elas são chamadas.
* Áreas de Interesse: Abra o terminal e execute os comandos:
```
 1 - php artisan tinker
 2 - $office = new App\Office
 3 - $office->name = 'Área de interesse'
 4 - $office->is_office = true
 5 - $office->save()
 ```
* Usuário Admin: Abra o terminal e execute os comandos:
```
 1 - php artisan tinker
 2 - $user = new App\User
 3 - $user->name = 'Nome do usuário'
 4 - $user->email = 'email_do_usuário@email.com.br'
 5 - $user->password = 'senha'
 5 - $user->save()
```
