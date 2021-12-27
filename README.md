## blog test


- #### 1

First of all, we need run docker images and containers with below command

`docker-compose up -d`

- #### 2

We need install project dependencies with below commands

`docker exec -it -u 1000 php_fpm_test bash`

After that container is run and we need to install dependencies

`composer install`

Then run migration

`php artisan migrate`

Then run seeder

`php artisan db:seed`



