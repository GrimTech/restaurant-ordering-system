
<?php
	include ('partials/header.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">Food</h2>
					<?php
						if (isset($_SESSION['add'])) {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }
						if (isset($_SESSION['delete'])) {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
						if (isset($_SESSION['upload'])) {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
						if (isset($_SESSION['update'])) {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
						if (isset($_SESSION['food_not_found'])) {
                            echo $_SESSION['food_not_found'];
                            unset($_SESSION['food_not_found']);
                        }
                    ?>
					<div class="table-responsive bs-example widget-shadow">
						<h4>Manage Food:</h4>
						<br> <br>
						
						<a href="add.food.php" class="btn btn-primary hvr-icon-float-away">Add Food</a>
						<br> <br>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>S.N.</th> 
									<th>Title</th>
									<th>Price</th>  
									<th>Image</th> 
									<th>Featured</th> 
									<th>Active</th> 
									<th>Actions</th> 
								</tr> 
							</thead> 
							<tbody> 
							<?php
								//query to get all categories from database
								$sql = "SELECT * FROM tbl_food";

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
										$title = $row['title'];
										$price = $row['price'];
										$image_name = $row['image_name'];
										$featured = $row['featured'];
										$active = $row['active'];
										?>

										<tr>
											<td><?php echo $sn++; ?></td>
											<td><?php echo $title; ?></td>
											<td>$<?php echo $price; ?></td> 
											<td>
												<?php
													//check whether image name is available or not
													if ($image_name!="") {
														//display the image
														?>
													<img src="<?php echo "../images/food/".$image_name; ?>" alt="" width="100px">
													<?php
													} 
													else {
														//Display the message
														echo "<div class='danger'>Image Not Added</div>";
													}
												?>
											</td>
											<td><?php echo $featured; ?></td>
											<td><?php echo $active; ?></td>
											<td>
												<a href="update.food.php?id=<?php echo $id; ?>" class="btn btn-success hvr-icon-up col-4">Update Food</a>
												<a href="delete.food.php?id=<?php echo $id; ?>" class="btn btn-danger hvr-icon-sink-away">Delete Food</a>
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
										<td colspan="6"><div class='badge-danger'>No Food Added.</div></td>
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