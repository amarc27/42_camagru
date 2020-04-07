# 42_camagru
Camagru is a small Instagram-like site allowing users to make and share photo-montages. We have implemented, with bare hands (frameworks are forbidden), the basic functionalities found on most sites with a user base.

We also learned a lot about :
* Responsive design
* DOM Manipulation
* SQL Debugging
* Cross Site Request Forgery
* Cross Origin Resource Sharing

### Build with
* [PHP](http://www.php.net/) - Backend
* [Javascript](https://www.javascript.com/) - Frontend
* [MySQL](https://www.mysql.com/fr/) - Database
* HTML/CSS - Frontend

## Get the requirement

### Prerequisites
You need to have installed [PHP](http://www.php.net/), [MySQL](https://www.mysql.com/fr/) and a local web server of your choice ([Apache](https://httpd.apache.org/), [nginx](https://www.nginx.com/), etc)

### Modify the config file
*config/database.php* contains all the information needed by [MySQL](https://www.mysql.com/fr/) to connect Camagru to its database. Modify it so it matches your MySQL config.
```
$DB_DSN = 'mysql:host=127.0.0.1;dbname=camagru';
$DB_USER = 'root';
$DB_PASSWORD = "[Password entered during MAMP/WAMP/LAMP installation]";
```
### Launch the server
Start the server you have installed.

### Create the database
If no database is found a *"cliquez ici"* link will appear. Click on it to create a new database.

## Get started
You can now create a new profile or sign in with one of the profile below:
* food : *food*
* travel : *travel*
* architecture : *architecture*
* people : *people*

### Screenshots

![alt text](https://raw.githubusercontent.com/amarc27/42_camagru/master/public/sreenshots/Screens.001.png)

### Authors
[amarc](https://github.com/amarc27/) & [cecourt](https://github.com/CesarCourt)
