
<?php
	include ('partials/header.php');
?>
		<?php
			if (isset($_GET['id'])) {
				//Get the ID of Selected Admin
				$id = $_GET['id'];
				//Create SQL Query to Get the details

				$sql = "SELECT * FROM tbl_admin WHERE id = $id";

				//Execute the query
				$res = mysqli_query($conn, $sql);

				//check whether the query is executed or not
				if ($res == TRUE) {
					//check whether the dats is available or not
					$count = mysqli_num_rows($res);
					//check we have admin data or not;
					if ($count==1) {
						//Get the Details
						//echo "Admin Available"
						$row = mysqli_fetch_assoc($res);

						$fullname = $row['full_name'];
						$username = $row['username'];
					}
					else {
						//redirect to manage admin page
						$_SESSION['user_not_found'] = "Admin Not Found";
						header('location:manage.admin.php');
					}
				}
			}
			else {
				header('location:manage.admin.php');
			}
		?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page">
				<div class="widget-shadow">
				<h2 class="title1">Update Admin</h2>
					<div class="login-body">
						<?php
							if (isset($_SESSION['update'])) {
								echo $_SESSION['update'];
								unset($_SESSION['update']);
							}
						?>

						<form action="#" method="post">
							<label for="fullname">Full Name:</label> 
							<input type="text" class="user" name="fullname" placeholder="" value="<?php echo $fullname; ?>">
							<label for="username">Username:</label>
							<input type="text" name="username" class="user" placeholder="" value="<?php echo $username; ?>">
							<input type="text" name="id" value="<?php echo $id; ?>" hidden>
							<input type="submit" name="submit" value="Update Admin">
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
		//Check whether the submit button is checked or not
        if (isset($_POST['submit'])) {
            //Get all the values from form to update
            $id = $_POST['id'];
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];

            //Create a SQL query to update Admin
            $sql = "UPDATE tbl_admin SET
                full_name = '$fullname',
                username = '$username'
                WHERE id = '$id'
            ";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //check whether the query executed successfully or not
            if ($res == TRUE) {
                //Query executed and admin updated
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
                //redirect to manage admin page
                header('location:manage.admin.php');
            }
            else {
                //Failed to update Admin
                $_SESSION['update'] = "<div class='error'>Failed to Update Admin Info.:".mysqli_error()."</div>";
                //redirect to manage admin page
                header('location:add.admin.php');
            }
        }
    ?>
	<?php
		include ('footer.php');
	?>
