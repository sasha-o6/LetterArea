<?php
define("SITE_NAME", "LetterArea");
define("HOST", "http://" . $_SERVER['HTTP_HOST']);
define('DB_HOST', 'localhost');
// define('DB_NAME', 'db_letterarea');
define('DB_USER', 'root');
define('DB_PASS', 'root');

// add new code frome site  https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'db_letterarea');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}