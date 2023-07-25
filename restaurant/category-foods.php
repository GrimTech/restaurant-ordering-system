<?php
    include ('partials/header.php');
?>

<?php
    //Check whether the id is passed or not
    if (isset($_GET['category_id'])) {
        //get id
        $category_id = $_GET['category_id'];
        //get category title based on category_id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Get the value from database
        $row = mysqli_fetch_assoc($res);

        //Get the title
        $category_title = $row['title'];
    }
    else {
        //redirect to index
        header('location:index.php');
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Create SQL Query to Display Categories from Database
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                //Execute the query
                $res2 = mysqli_query($conn, $sql2);
                //Count rows to check whether the category is available or not
                $count2 = mysqli_num_rows($res2);
                
                if ($count2 > 0) {
                    //Categories available
                    while ($row = mysqli_fetch_assoc($res2)) {
                        //get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else {
                                    ?>
                                    <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else {
                    echo "<div class='error'>Food Menu Not Added</div>";
                }
            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php
    include ('partials/footer.php');
?>