<?php
    include ('partials/header.php');
?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Create SQL Query to Display Categories from Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 3";
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);
                
                if ($count > 0) {
                    //Categories available
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //get the values
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        ?>
                        <a href="category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else {
                                    ?>
                                    <img src="images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    
                                    <?php
                                }
                                ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>
                        <?php
                    }
                }
                else {
                    echo "<div class='error'>Category Not Added</div>";
                }
            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php
    include ('partials/footer.php');
?>