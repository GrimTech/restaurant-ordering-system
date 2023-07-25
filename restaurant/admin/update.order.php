<?php
	include ('partials/header.php');
	// header('location:manage.admin.php');
?>
        <?php
            //check whether the ID is set or not
            if (isset($_GET['id'])) {
                //GET the id and other details
                $id = $_GET['id'];
                //Create SQl query to get all other details
                $sql = "SELECT * FROM tbl_food WHERE id=$id";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count the rows to check if id exists or not
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address']; 
                }
                else {
                    //redirect the manage Food with session message
                    $_SESSION['no_order_found'] = "<div class='error'>No Order Found</div>";
                    header('location:manage.order.php');
                }
            }
            else {
                //redirect to manage Food
                header('location:manage.order.php');
            }
        ?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page">
				<div class="widget-shadow">
                    <h2 class="title1">Update Order</h2>
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
                            <h4>Food Name:</h4>
                            <br>
                            <p><?php echo $food; ?></p>
                            <br>

                            <h4>Price:</h4>
                            <br>
                            <p>$<?php echo $price; ?></p>
                            <br>

                            <h4>Qty:</h4>
                            <p><?php echo $qty; ?></p>

                            <label for="status">Status:</label>
                            <br>
                            <select name="status">
                                <option <?php if($status == "Ordered"){echo "selected";} ?> value="Ordered"></option>
                                <option <?php if($status == "On Delivery"){echo "selected";} ?> value="On Delivery"></option>
                                <option <?php if($status == "Delivered"){echo "selected";} ?> value="Delivered"></option>
                                <option <?php if($status == "Cancelled"){echo "selected";} ?> value="Cancelled"></option>
                            </select>
                            <br>
                            <label for="customer_name">Customer Name:</label>
                            <br>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                            <br><br>

                            <label for="customer_contact">Customer Contact:</label>
                            <br>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                            <br><br>

                            <label for="customer_email">Customer Email:</label>
                            <br>
                            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                            <br><br>

                            <label for="customer_address">Customer Address:</label>
                            <br>
                            <textarea name="customer_address" value="<?php echo $customer_address; ?>"></textarea>
                            <br><br>

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" value="Update Food" name="submit">
                        </form>

						
                    </div>
                </div>
            </div>
        </div>

        <?php
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $price = (int)$_POST['price'];
                $qty = (int)$_POST['qty'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                $total = $price * $qty;

                $order_date = date("Y-m-d H:i:s"); //order date

                $status = $_POST['status']; //ordered, pending, confirmed, on delivery, delivered, cancelled

                //Send Order into database
                //Create sql query
                $sql2 = "UPDATE tbl_order SET
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name  = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id = $id
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether query executed successfully or not
                if ($res2 == true) {
                    //Query Executed and Order Saved
                    $_SESSION['update'] = "<div class='success'>Order Updated successfully</div>";
                    header('location:manage.order.php');
                }
                else {
                    //Failed to Save Order
                    $_SESSION['update'] = "<div class='error'>Failed to update order</div>".mysqli_error($conn);
                    header('location:manage.order.php');
                }
            }
        ?>


        ?>

<?php
    include ('partials/footer.php');
?>