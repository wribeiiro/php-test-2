# PHPTest-2 🐘
Small registration developed for testing.

You can check the project running with mysql database [click me :D](https://wribeiiro.com/php-test-2)

# Screenshot
![image](https://user-images.githubusercontent.com/20648572/112701746-827cdf80-8ea2-11eb-8d9c-1fcc7abda42b.png)

### Functionalities

- Creating products 
- Creating Type of products 
- Realization of sales
- Calculation of product taxes based on their type

### Tecnologies

- PHP (No framework) / PDO
- Composer
- Postgres or MySQL 
- JavaScript with Jquery
- Bootstrap 4

### Getting started

Clone the repository
```bash
$ git clone https://github.com/wribeiiro/php-test-2
```
Switch to the repo folder
```bash
$ cd php-test-2
```
Install all the dependencies using composer
```bash
$ composer install
```
Set the database params APP_ENVIRONMENT, DB_ENVIRONMENT and BASE_URL in app\Config\config.php 
```bash
$ define("APP_ENVIRONMENT", "development");
$ define("DB_ENVIRONMENT", "mysql");
$ define("BASE_URL", "http://localhost:8000/");
```

After changing the above parameters,

- Import the test_2_postgres.sql file or restore test_2_postgres.backup file for postgres database 
- Import the test_2_mysql.sql file for mysql database

Start the local development server
```bash
$ php -S localhost:8000
```
