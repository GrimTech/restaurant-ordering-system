<?php
    include ('partials/header.php');
    //unset the session
    session_unset();
    //destroy the session
    session_destroy(); //Unsets $_SESSION['user']
    //abort session
    session_abort();
    header('location:login.php');
    //redirect to login page