
<?php
	include ('partials/header.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            else {
                header('location:manage.admin.php');
            }
        ?>
		<div id="page-wrapper">
			<div class="main-page login-page">
				<div class="widget-shadow">
					<h2 class="title1">Change Password</h2>
					<br><br>
                    <?php
                        if (isset($_SESSION['change_pwd'])) {
                            echo $_SESSION['change_pwd'];
                            unset($_SESSION['change_pwd']);
                        }
                        if (isset($_SESSION['pwd_not_match'])) {
                            echo $_SESSION['pwd_not_match'];
                            unset($_SESSION['pwd_not_match']);
                        }
                        if (isset($_SESSION['user_not_found'])) {
                            echo $_SESSION['user_not_found'];
                            unset($_SESSION['user_not_found']);
                        }
                    ?>
					<div class="login-body">

						<form action="#" method="POST">
							<input type="password" class="lock" name="current_password" placeholder="Old Password" required="">
							<input type="password" name="new_password" class="lock" placeholder="New Password" required="">
							<input type="password" name="confirm_password" class="lock" placeholder="Confirm Password" required="">
							<input type="text" name="id" value="<?php echo $id; ?>" hidden>
							<input type="submit" name="submit" value="Update Password">
						</form>
					</div>
				</div>
			</div>
		</div>

<?php

    //check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        //get the data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        //check whether the user with current ID and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id = '$id' AND password = '$current_password'";

        //execute the query
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            //check whether data is avaialable or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //User Exists and Password can be changed
                //check whether the new password and its confirmation match or not
                if ($new_password == $confirm_password) {
                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    //check whether the query got executed or not
                    if ($res2 == TRUE) {
                        //Display Success Storage
                        //Redirect to Manage Admin Page with Error Message
                        $_SESSION['change_pwd'] = "<div class='success'>Password Changed Successfully</div>";
                        //redirect the user
                        header('location:manage.admin.php');
                        exit();
                    }
                    else {
                        $_SESSION['change_pwd'] = "<div class='success'>Unable to Change Password</div>";
                        //redirect user
                        header('location:add.admin.php');
                    }
                }
                else {
                    //redirect to manage admin page with error message
                    $_SESSION['pwd_not_match'] = "<div class='error'>Passwords don't Match</div>";
                    //redirect user
                    header('location:add.admin.php');
                }
            }
            else {
                //User Does Not Exist Set Message and Redirect
                $_SESSION['user_not_found'] = "<div class='error'>User Not Found.</div>";
                //Redirect user
                header('location:add.admin.php');
            }
        }
        else {
            header('location:manage.admin.php');
        }
    }
?>

<!--footer-->
<?php
    include ('partials/footer.php');
?>