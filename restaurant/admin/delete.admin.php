<?php
    
    //include constants.php file here
    include ('config/constants.php');

    // get the id of the admin to be deleted
    $id = $_GET['id'];

    //Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    //Execute SQL QUERY to Delete Admin
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if ($res == TRUE) {
        //Query Executed Successfully and admin deleted
        //echo "Admin Selected"
        //Create Session Variable To display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage Admin page
        header('location:manage.admin.php');
    }
    else {
        //Failed to Delete Admin
        //echo 'Failed to delete admin'

        $_SESSION['delete'] = "<div class='badge-danger'>Failed to Delete Admin, Try Again Later</div>";
        header('location:manage.admin.php');
    }

    //Redirect to manage admin page with message (success/error)





