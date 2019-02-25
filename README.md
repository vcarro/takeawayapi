# Takeaway API
Steps to configure and run Takeaway API

## Configure Database
First, configure the user and password database to generate data. Open file .env and put user, password and name of database in DATABASE_URL. For instance:

```sh
DATABASE_URL=mysql://user:password@127.0.0.1:3306/database
```
and then run next commands to create database and schema
```sh
$~/takeawayAPI php bin/console doctrine:database:create
$~/takeawayAPI php bin/console doctrine:schema:update --force
```
## Import Data
Go to ./data directory and open *importCSV.php* and add user, password and database to import the data.
```sh
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
```
and then run next command to import data:
```sh
$~/takeawayAPI/data php -f importCSV.php
```
## Run unit test
Now you can run the tests over the API:
```sh
$~/takeawayAPI/ php bin/phpunit tests/Controller/TestApiController.php
```
## Test API
To test API you have to run the server with the following command
```sh
$~/takeawayAPI/ php -S localhost:8000 -t public/
```
## Show documentation
To know the endpoints you can open a browser an write
```sh
http://localhost:8000/api/doc
```
The API endpoints are:
- /api/v1/restaurants -> to list all restaurants with sort default
- /api/v1/restaurants/sort -> to list all restaurants choosing sort option
- /api/v1/restaurants/search -> to search for a restaurant name

## ToDos
- Finish JWT API authentication.
- Refactor code to separate infraestructure from domain.
- Use an Application Service.
- Improve unit testing.
