# PHP Impuls Test

# Requirements

* git
* composer
* php >= 7.1

# Installation

````
Step 1: git clone <repository-url> 
Step 2: composer install
````

* Step 3: config\db.php set param db_name
````
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=name',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
````

````
Step 4: yii migrate
````
