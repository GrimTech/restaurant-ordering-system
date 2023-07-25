<?php
	include ('partials/header.php');
?>
        <?php
            //check whether the ID is set or not
            if (isset($_GET['id'])) {
                //GET the id and other details
                $id = $_GET['id'];
                //Create SQl query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count the rows to check if id exists or not
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active']; 
                }
                else {
                    //redirect the manage category with session message
                    $_SESSION['no_category_found'] = "<div class='error'>No Category Found</div>";
                    header('location:manage.category.php');
                }
            }
            else {
                //redirect to manage Category
                header('location:manage.category.php');
            }
        ?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page">
				<div class="widget-shadow">
					<h2 class="title1">Change Password</h2>
					<br><br>
                    <?php
                        if (isset($_SESSION['upload'])) {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                        if (isset($_SESSION['failed_removal'])) {
                            echo $_SESSION['failed_removal'];
                            unset($_SESSION['failed_removal']);
                        }

                        if (isset($_SESSION['update'])) {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                    ?>
					<div class="login-body">

						<form method="post" enctype="multipart/form-data">
							<label for="title">Title:</label>
							<input type="text" class="" name="title" placeholder="" required="">
							Current Image:
							<?php
                                if ($current_image != "") {
                                    //display image
                                    ?>
                                    <img src="<?php echo '../images/category/'.$current_image; ?>" width="100px">
                                    <?php
                                }
                                else {
                                    //display message
                                    echo "<div class='error'>Image Not Added.</div>";
                                }
                            ?>
                            <br>
							<label for="image">New Image:</label>
							<input type="file" name="image" class="">
							<label for="featured">Featured:</label>
							<input <?php if ($featured == "Yes") {echo "checked";}; ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if ($featured == "No") {echo "checked";}; ?> type="radio" name="featured" value="No"> No
							<br>
							<label for="active">Active:</label>
							<input <?php if ($featured == "Yes") {echo "checked";}; ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if ($featured == "No") {echo "checked";}; ?> type="radio" name="active" value="No"> No
							<!--<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>-->
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
        <?php
            if (isset($_POST['submit'])) {
                //Get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //Updating new image if selected
                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];
                    //Get The Image Details
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
                        if ($upload == FALSE) {
                            //Set Message
                            $_SESSION['upload'] = "<div class='danger'>Failed to Upload Image</div>";
                            //redirect to Add Category page
                            header('location:manage.category.php');
                            //Stop process
                            die();
                        }
                        if ($current_image != "") {
                            //remove the current image
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            //check whether the image is removed or not
                            //If it fails, display message and stop the process
                            if ($remove == FALSE) {
                                //Failed to remove image
                                $_SESSION['failed_removal'] = "<div class='error'>Failed to Remove Current Image.</div>";
                                header('location:manage.category.php');
                                die;
                            }
                        }
                    }
                    else {
                        $image_name = $current_image;
                    }
                }
                else {
                    $image_name = $current_image;
                }

                //update the database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                //Execute the Query
                $res = mysqli_query($conn, $sql2);

                //Redirect To Manage Category with Message
                //Check whether it's executed or not
                if ($res == TRUE) {
                    //Category Added
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header('location:manage.category.php');
                }
                else {
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                    header('location:add.category.php');
                }

                //Redirect to manage category with message
                //check whether it executed or not
            }
        ?>
		<?php
			include ('partials/footer.php');
		?>

			