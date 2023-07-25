
<?php
	include ('partials/header.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">Category</h2>
					
					<div class="table-responsive bs-example widget-shadow">
						<h4>Manage Category:</h4>
						<br> <br>

						<?php
							if (isset($_SESSION['add'])) {
								echo $_SESSION['add'].'<br><br>';
								unset($_SESSION['add']);
							}

							if (isset($_SESSION['remove'])) {
								echo $_SESSION['remove'].'<br><br>';
								unset($_SESSION['remove']);
							}

							if (isset($_SESSION['delete'])) {
								echo $_SESSION['delete'].'<br><br>';
								unset($_SESSION['delete']);
							}

							if (isset($_SESSION['no_category_found'])) {
								echo $_SESSION['no_category_found'].'<br><br>';
								unset($_SESSION['no_category_found']);
							}

							if (isset($_SESSION['update'])) {
								echo $_SESSION['update'].'<br><br>';
								unset($_SESSION['update']);
							}

							if (isset($_SESSION['upload'])) {
								echo $_SESSION['upload'].'<br><br>';
								unset($_SESSION['upload']);
							}

							if (isset($_SESSION['failed_removal'])) {
								echo $_SESSION['failed_removal'].'<br><br>';
								unset($_SESSION['failed_removal']);
							}
						?>

						<a href="add.category.php" class="btn btn-primary hvr-icon-float-away">Add Category </a>
						<br> <br>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>S.N.</th> 
									<th>Title</th> 
									<th>Image</th> 
									<th>Featured</th> 
									<th>Active</th> 
									<th>Actions</th> 
								</tr> 
							</thead> 
							<tbody> 
							<?php
								//query to get all categories from database
								$sql = "SELECT * FROM tbl_category";

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
										$image_name = $row['image_name'];
										$featured = $row['featured'];
										$active = $row['active'];

										?>

										<tr>
											<td><?php echo $sn++; ?></td>
											<td><?php echo $title; ?></td>
											<td>
												<?php
													//check whether image name is available or not
													if ($image_name!="") {
														//display the image
														?>
													<img src="<?php echo "../images/category/".$image_name; ?>" alt="" width="100px">
													<?php
													} 
													else {
														//Display the message
														echo "<div class='alert-danger'>Image Not Added</div>";
													}
												?>
											</td>
											<td><?php echo $featured; ?></td>
											<td><?php echo $active; ?></td>
											<td>
												<a href="update.category.php?id=<?php echo $id; ?>" class="btn btn-success hvr-icon-up col-4"> Update Category</a>
												<a href="delete.category.php?id=<?php echo $id; ?>" class="btn btn-danger hvr-icon-sink-away">Delete Category</a>
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
										<td colspan="6"><div class='alert-danger'>No Category Added.</div></td>
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