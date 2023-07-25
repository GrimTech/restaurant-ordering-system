<?php
    //start session
    session_start();

    //create constants to store non repeating values
    define('SITEURL', 'https://localhost:8888/restaurant/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'test');
    define('DB_PASSWORD', 'test');
    define('DB_NAME', 'food_order');

    $milk = 'scream';
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die('Database Failed: '.mysqli_connect_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Select Database
?>