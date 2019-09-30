## How the app is built

It is a simple app developed using CodeIgniter PHP MVC framework and MYSQL database. For better control over views Ocular libray is used. 
Some Active Record pattern is also used.

## Setup

Copy the /application/config/config.bkp.php to config.php and /application/config/database.bkp.php to database.php then configure as per your server settings. If you need help go to:http://codeigniter.com/user_guide/installation/ but its simple and well documented framework so you might not need any help.

## Database

The database is put in the /db folder and you can dump it in you MYSQL using PHPMYADMIN or other tool. Has just 2 tables, could have been lot better.
Then give the right credentials on /application/config/database.php.

Has XML output as well. Needs some change to pull updates.
