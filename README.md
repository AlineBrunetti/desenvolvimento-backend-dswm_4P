# Desenvolvimento Back-end (DSWM II)
## Clonar projetos
1. Ativa o Wamp
2. No projeto o qual quer clonar, vai no arquivo .env e verifica o nome do banco de dados
3. Vai em phpmyadmin e cria um banco de dados com o mesmo nome
4. Com a pasta do projetoClone aberta no CMD rode
   ```CMD
   composer install
   ```
   Se der erro, tente entrar no CMD como administrador
5. Abra a pasta do projetoClone no VSCode
   ```bash
   php artisan migrate:fresh
   php artisan migrate:fresh --seed
   ```
   OU
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
6. Se necessário, retire o .exemple do arquivo .env
   
