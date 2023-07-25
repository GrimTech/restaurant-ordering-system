<?php
    include ('partials/header.php');
?>

    <?php
        //check if food id is set or not
        if (isset($_GET['food_id'])) {
            //get the food_id and details of the selected food
            $food_id = $_GET['food_id'];
            //get the details of the selected food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            //execute the query

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //get data from the database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else {
                //redirect to home page
                header('location:index.php');
            }
        }
        else {
            //redirect to homepage
            header('location:index.php');
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check if image is available
                            if ($image_name == "") {
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else {
                                //image is available
                                ?>
                                <img src="images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Jackson" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. logicalScum@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
                <?php
                var_dump('edges');
                ?>
            </form>

            <?php
                //check if submit button is clicked or not
                if (isset($_POST['submit'])) {
                    $food = $_POST['food'];
                    $price = (int)$_POST['price'];
                    $qty = (int)$_POST['qty'];
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $total = $price * $qty;

                    $order_date = date("Y-m-d H:i:s"); //order date

                    $status = "ordered"; //ordered, pending, confirmed, on delivery, delivered, cancelled

                    // var_dump($food);
                    // var_dump($price);
                    // var_dump($qty);
                    // var_dump($total);
                    // var_dump($customer_name);
                    // var_dump($customer_contact);
                    // var_dump($customer_email);
                    // var_dump($customer_address);
                    // var_dump($total);
                    // var_dump($order_date);
                    // die;

                    //Send Order into database
                    //Create sql query
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name  = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if ($res2 == true) {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success'>Food Ordered successfully</div>";
                        header('location:index.php');
                    }
                    else {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error'>Failed to place an order</div>".mysqli_error($conn);
                        header('location:index.php');
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php
    include ('partials/footer.php');
?>