
<?php
	include ('partials/header.php');
	// header('location:manage.admin.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page">
				<div class="widget-shadow">
					
					<div class="login-body">
						<h2 class="title1">Add Category</h2>
						<br> <br>

						<?php
							if (isset($_SESSION['add'])) {
								echo $_SESSION['add'].'<br><br>';
								unset($_SESSION['add']);
							}

							if (isset($_SESSION['upload'])) {
								echo $_SESSION['upload'].'<br><br>';
								unset($_SESSION['upload']);
							}
						?>

						<form method="post" enctype="multipart/form-data">
							<label for="fullname">Title:</label> 
							<input type="text" class="user" name="title" placeholder="Category Title">

							<label for="username">Select Image:</label>
							<input type="file" name="image">
							<br>
							<label for="featured">Featured:</label>
							<input type="radio" name="featured" value="Yes" id="">Yes 
							<input type="radio" name="featured" value="No" id="">No 
							<br>
							<br>
							<label for="active">Active:</label>
							<input type="radio" name="active" value="Yes" id="">Yes 
							<input type="radio" name="active" value="No" id="">No 

							<input type="submit" name="submit" value="Add Category">
						</form>

							<?php
								 //Check whether the submit button is clicked or not
								if (isset($_POST['submit'])) {
									//echo clicked

									//Get the value from Category Form
									$title = $_POST['title'];

									//For the Radio Input, we want to check the whether the button is selected or not
									if (isset($_POST['featured'])) {
										//Set the value from form
										$featured = $_POST['featured'];
									}
									else {
										//set the default value
										$featured = "No";
									}
									if (isset($_POST['active'])) {
										$active = $_POST['active'];
									}
									else {
										$active = "No";
									}
									//Check whether the image is uploaded or not and set the value for image accordingly
									//die()
									/*var_dump($_FILES['image']);
									die;
									header("location:SITEURL");*/
									
									if (isset($_FILES['image']['name'])) {
										//Upload the Image
										//To upload we need image name, source path and destination path
										$image_name = $_FILES['image']['name'];
										if ($image_name != "") {
											//Auto rename the image
											//Get the image extension
											$ext = end(explode('.', $image_name));

											//rename the image
											$image_name = "Food_Category_".rand(000,999).'.'.$ext;

											$source_path = $_FILES['image']['tmp_name'];

											$destination_path = "../images/category/".$image_name;

											//finally upload the Image
											$upload = move_uploaded_file($source_path, $destination_path);

											//check whether the image is uploaded or not
											//and if the image is not uploaded then stop the process and redirect with error message
											if ($upload == false) {
												//Set Message
												$_SESSION['upload'] = "<div class='alert-danger'>Failed to Upload Image</div>";
												//redirect to Add Category page
												header('location:add.category.php');
												//Stop process
												die();
											}
										}
									}
									else {
										//don't upload image and set the image_name value as blank
										$image_name = "";
									}

									// Create SQL Query to Insert category into database
									$sql = "INSERT INTO tbl_category SET
										title = '$title',
										image_name = '$image_name',
										featured = '$featured',
										active = '$active'
									";

									// Execute the Query and Save in Database
									$res = mysqli_query($conn, $sql);

									//check whether the query executed or not and data was added or not
									if ($res == TRUE) {
										//Query executed and category added
										$_SESSION['add'] = "<div class='alert-success'>Category Added Successfully</div>";
										//redirect to manage category.php
										header('location:manage.category.php');
									}
									else {
										//Failed to add category
										$_SESSION['add'] = "<div class='alert-danger'>Failed to Add Category</div>";
										//Redirect to Manage category page
										header('location:add.category.php');
									}
								}
								
							?>
							</tbody> 
						</table> 
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		<?php
			include ('partials/footer.php');
		?>