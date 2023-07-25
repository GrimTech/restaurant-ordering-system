
<?php
	include ('partials/header.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="login-page">
				<div class="widget-shadow">
					<h2 class="title1">Add Admin</h2>
					
					<div class="login-body">
						
					<?php
						//display status message
						if (isset($_SESSION['add'])) {
							{
								echo ('<br><br>'.$_SESSION['add'].'<br><br><br>'); //display session message
								unset($_SESSION['add']); //remove session message
							}
						}
					?>
						 <form action="" method="POST">
							<label for="fullname">Fullname:</label>
							<input type="text" name="fullname" id="" placeholder="Enter Full Name">

							<label for="username">Username:</label>
							<input type="text" name="username" id="" placeholder="Enter Username">

							<label for="password">Password:</label>
							<input type="password" name="password" id="" placeholder="Enter Password">

							<input type="submit" value="Add Admin" name="submit">
						 </form>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		<?php
			//Process the value from form and save it in Database
			//Check whether the submit button is clicked or not
			if(isset($_POST['submit'])){
				//button clicked
				//echo 'button clicked
				//Get the form data
				$fullname = $_POST['fullname'];
				$username = $_POST['username'];
				$password = md5($_POST['password']);

				// SQL query to save the data into database
				$sql = "INSERT INTO tbl_admin SET
					full_name = '$fullname',
					username = '$username',
					password = '$password';
				";

				//execute query and save data in database
				$res = mysqli_query($conn, $sql) or die(mysqli_error());

				//check whether the (query is executed) data is inserted or and display appropriate message
				if ($res == TRUE) {
					//Data Inserted
					//Create a session variable to display message
					$_SESSION['add'] = "<div class='alert-success'>Admin Added Successfully</div>";
					//redirect page to manage admin
					header('location:manage.admin.php');
				}
				else {
					//Failed to Insert Data
					//Create a session variable to display message
					$_SESSION['add'] = "<div class='alert-danger'>Failed to add admin</div>";
					//redirect page to manage admin
					header('location:add.admin.php');
				}
			}
		?>
		<?php
			include ('partials/footer.php');
		?>