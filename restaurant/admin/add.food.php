<?php
	include ('partials/header.php');
	// header('location:manage.admin.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page">
				<div class="widget-shadow">
                    <h2 class="title1">Add Food</h2>
                    <br> <br>
                    <?php
                        if (isset($_SESSION['upload'])) {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                        if (isset($_SESSION['add'])) {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }
                    ?>
					<div class="login-body">
						<form method="post" enctype="multipart/form-data">
                            <label for="title">Title:</label>
                            <input type="text" name="title" placeholder="Food Title">

                            <label for="description">Description:</label>
                            <br>
                            <textarea name="description" placeholder="Food Description" cols="40" rows="10"></textarea>
                            <br>

                            <label for="image">Food Image:</label>
                            <br>
                            <input type="file" name="image">
                            <br>
                            <label for="price">Price:</label>
                            <br>
                            <input type="number" name="price">
                            <br><br>

                            <label for="category">Category</label>
                            <select name="category">
                                <?php
                                    //Create code to display categories from database
                                    //1. Create SQL to get all active categories from database
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    //Executing the query
                                    $res = mysqli_query($conn, $sql);

                                    //Count the rows to check whether we have categories or not
                                    $count = mysqli_num_rows($res);

                                    //if count is > 0, we have categories or else we don't
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            //get detials of the categories
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else {
                                        //no category found
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <br><br>

                            <label for="featured">Featured:</label>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                            <br><br>

                            <label for="active">Active:</label>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No

                            <input type="submit" value="submit" name="submit">
                        </form>

						
                    </div>
                </div>
            </div>
        </div>

    <?php
        if (isset($_POST['submit'])) {
            //Add the food in Database

            // Get the Data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether the radio buttons were selected or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            }
            else {
                $featured = "No"; //Setting the default value
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            }
            else {
                $active = "No"; //Setting the default value
            }
            //upload the image if selected
            if (isset($_FILES['image']['name'])) {
                //Upload the Image
                //To upload we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    //Auto rename the image
                    //Get the image extension
                    $ext = end(explode('.', $image_name));

                    //rename the image
                    $image_name = "Food_Image_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/food/".$image_name;

                    //finally upload the Image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not
                    //and if the image is not uploaded then stop the process and redirect with error message
                    if ($upload == false) {
                        //Set Message
                        $_SESSION['upload'] = "<div class='alert-danger'>Failed to Upload Image</div>";
                        //redirect to Add Category page
                        header('location:add.food.php');
                        //Stop process
                        die();
                    }
                }
            }
            else {
                //don't upload image and set the image_name value as blank
                $image_name = "";
            }

            //insert into database
            $sql = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
            ";

            $res = mysqli_query($conn, $sql);
            //redirect with message to manage food page
            if ($res == TRUE) {
                //Data Inserted
                //Create a session variable to display message
                $_SESSION['add'] = "<div class='alert-success'>Food Added Successfully</div>";
                //redirect page to manage food
                header('location:manage.food.php');
            }
            else {
                //Failed to Insert Data
                //Create a session variable to display message
                $_SESSION['add'] = "<div class='alert-danger'>Failed to add Food:".mysqli_error()."</div>";
                //redirect page to manage admin
                header('location:add.food.php');
            }
        }
    ?>

<?php
    include ('partials/footer.php');
?>