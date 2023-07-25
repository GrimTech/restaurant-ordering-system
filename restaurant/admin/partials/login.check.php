<?php
    include ('constants.php');
    //Authorization - Acess Control
    //Check Whether the user is logged in or not
    if (!isset($_SESSION['user'])) { //If user session is not set
        //User is not logged in
        //redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to access admin panel</div>";
        //redirect to login page
        header('location:./login.php');
    }