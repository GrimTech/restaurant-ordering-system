<?php
    //include constants file
    include 'config/constants.php';

    //check whether the id and image_name value is set or not
    if (isset($_GET['id']) && isset($_GET['image_name'])) {
        //Get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file if available
        if ($image_name != "") {
            $path = "../images/food/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //if it fails to remove image then add an error message and redirect user
            if ($remove == false) {
                $_SESSION['remove'] = "<div class='badge-danger'>Failed to Remove Food Image.</div>";
                //Redirect to manage category page
                header("location:manage.food.php");
                //stop the process
                die;
            }
        }

        //Delete the data from database
        //sql query to delete data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is deleted from database or not

        if ($res == TRUE) {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //Redirect to manage category
            header('location:manage.food.php');
            //stop the process
            die;
        }
        else {
            $_SESSION['delete'] = "<div class='badge-danger'>Failed to Delete Food</div>";
            header('location:manage.food.php');
        }

        //redirect to manage food page with message
    }
    else {
        //redirect to Manage food Page
        header('location:manage.food.php');
    }
?>