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
You need to have installed [PHP](http://www.php.net/), [MySQL](https://www.mysql.com/fr/) and a local web server of your choice ([MAMP](https://bitnami.com/stack/mamp/installer), [WAMP](https://bitnami.com/stack/wamp/installer), [LAMP](https://bitnami.com/stack/lamp/installer))

### Modify the config file
*config/database.php* contains all the information needed by [MySQL](https://www.mysql.com/fr/) to connect Camagru to its database. Modify it so it matches your MySQL config.
```
$DB_DSN = 'mysql:host=127.0.0.1;dbname=camagru';
$DB_USER = 'root';
$DB_PASSWORD = "[Password entered during MAMP/WAMP/LAMP installation]";
```
### Launch the server
Start the server you have installed.

## Get started
1. In phpMyAdmin, add a db called `camagru`
2. In console, run `php config/setup.php`
3. Go to the path `localhost:[yourPort]` in your navigator
4. Have fun

### Screenshots

![alt text](https://raw.githubusercontent.com/amarc27/42_camagru/master/public/sreenshots/Screens.001.png)

### Authors
[amarc](https://github.com/amarc27/) & [cecourt](https://github.com/CesarCourt)
