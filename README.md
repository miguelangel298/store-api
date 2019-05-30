# Store-api
E-commerce store to be used in APP and web system

### Prerequisites
* [Docker](https://www.docker.com/)

### Container
 - [nginx](https://hub.docker.com/_/nginx/) 1.15.+
 - [php-fpm](https://hub.docker.com/_/php/) 7.2.+
    - [composer](https://getcomposer.org/) 
    - [yarn](https://yarnpkg.com/lang/en/) and [node.js](https://nodejs.org/en/) (if you will use [Encore](https://symfony.com/doc/current/frontend/encore/installation.html) for managing JS and CSS)
- [mysql](https://hub.docker.com/_/mysql/) 5.7.+

### Installing

run docker and connect to container:
```
 docker-compose up --build
```
copy the ENV in the project:
```
 docker-compose exec php cp .env.example .env
```
install dependencies of project:
```
 docker-compose exec php composer install
```
run migration for creating the tables:
```
 docker-compose exec php bin/console doctrine:migrations:migrate
```
run seeder:
```
 docker-compose exec php bin/console doctrine:fixtures:load
```
call localhost in your browser:
- [http://localhost/api/products](http://localhost/api/products)

### Usage

To obtain the list of products.
Get query params:

* search.
* category.
* startPrice.
* tarfetPrice.
* page.
* perPage.

- [http://localhost/api/products](http://localhost/api/products)

Create a new product.
`Method: POST`
- [http://localhost/api/products](http://localhost/api/products)

### Test

```
docker-compose exec php bin/phpunit
```
