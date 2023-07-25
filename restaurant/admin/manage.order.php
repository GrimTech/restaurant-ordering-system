
<?php
	include ('partials/header.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">Manage Order</h2>
					
					<?php
						if (isset($_SESSION['update'])) {
							echo $_SESSION['update'];
							unset($_SESSION['update']);
						}
					?>

					<div class="table-responsive bs-example widget-shadow">
						<h4>Responsive Table:</h4>
						<br> <br>

						<a href="add.category.php" class="btn btn-primary hvr-icon-float-away">Add Category</a>
						<br> <br>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>S.N.</th> 
									<th>Food</th> 
									<th>Price</th> 
									<th>Qty</th>
									<th>Total</th>
									<th>Order Date</th>
									<th>Status</th>
									<th>Customer Name</th>
									<th>Contact</th>
									<th>Email</th>
									<th>Address</th>
									<th>Actions</th>
									<?php  ?>
								</tr> 
							</thead> 
							<tbody> 
							<?php
								//query to get all categories from database
								$sql = "SELECT * FROM tbl_order ORDER BY id DESC";

								//execute query
								$res = mysqli_query($conn, $sql);

								//count rows
								$count = mysqli_num_rows($res);

								//Create serial number variable and assign value as 1
								$sn = 1;

								//check whether we have data in database or not
								if ($count>0) {
									//we have data in database
									//get the data and display
									while ($row = mysqli_fetch_assoc($res)) {
										$id = $row['id'];
										$food = $row['food'];
										$price = $row['price'];
										$qty = $row['qty'];
										$total = $row['total'];
										$order_date = $row['order_date'];
										$status = $row['status'];
										$customer_name = $row['customer_name'];
										$customer_contact = $row['customer_contact'];
										$customer_email = $row['customer_email'];
										$customer_address = $row['customer_address'];

										?>

										<tr>
											<td><?php echo $sn++; ?></td>
											<td><?php echo $food; ?></td>
											<td><?php echo $price; ?></td>
											<td><?php echo $qty; ?></td>
											<td><?php echo $total; ?></td>
											<td><?php echo $order_date; ?></td>
											<td><?php echo $status; ?></td>
											<td><?php echo $customer_name; ?></td>
											<td><?php echo $customer_contact; ?></td>
											<td><?php echo $customer_email; ?></td>
											<td><?php echo $customer_address; ?></td>
											<td>
												<a href="update.order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
												<!--<a href="delete.category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>-->
											</td>
										</tr>
									<?php
									}
								}
								else {
									//we do not have data
									//we will display the message inside table
									?>
									<tr>
										<td colspan="6"><div class='error'>No Category Added.</div></td>
									</tr>
							<?php

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