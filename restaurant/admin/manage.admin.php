
<?php
	include ('partials/header.php');
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h2 class="title1">Admin</h2>
					
					<div class="table-responsive bs-example widget-shadow">
						<h4>Manage Admin:</h4>
						<br> <br>

						<?php
							//display status message
							if (isset($_SESSION['add'])) {
								echo $_SESSION['add'].'<br> <br>'; //display session message
								unset($_SESSION['add']); //remove session message
							}
							if (isset($_SESSION['delete'])) {
								echo $_SESSION['delete'].'<br> <br>'; //Displaying session Message
								unset($_SESSION['delete']); //Removing Session Message
							}
							if (isset($_SESSION['update'])) {
								echo $_SESSION['update'].'<br> <br>'; //Displaying session Message
								unset($_SESSION['update']); //Removing Session Message
							}
							if (isset($_SESSION['user_not_found'])) {
								echo $_SESSION['user_not_found'].'<br> <br>'; //Displaying session Message
								unset($_SESSION['user_not_found']); //Removing Session Message
							}
							if (isset($_SESSION['pwd_not_match'])) {
								echo $_SESSION['pwd_not_match'].'<br> <br>'; //Displaying session Message
								unset($_SESSION['pwd_not_match']); //Removing Session Message
							}
							if (isset($_SESSION['change_pwd'])) {
								echo $_SESSION['change_pwd'].'<br> <br>'; //Displaying session Message
								unset($_SESSION['change_pwd']); //Removing Session Message
							}
							if (isset($_SESSION['user_not_found'])) {
								echo $_SESSION['user_not_found'].'<br><br>'; //Displaying Session Message
								unset($_SESSION['user_not_found']); //Removing Session Message
							}
						?>

						<a href="add.admin.php" class="btn btn-primary hvr-icon-float-away">Add Admin</a>
						<br> <br>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>S.N.</th> 
									<th>Full Name</th> 
									<th>Username</th> 
									<th>Actions</th> 
								</tr> 
							</thead> 
							<tbody> 
							<?php
                            //Query to Get all Admins
                            $sql = 'SELECT * FROM tbl_admin';
                            //Execute the query
                            $res = mysqli_query($conn, $sql);

                            //check whether the query is executed or not
                            if ($res == TRUE) {
                                //Count Rows to check whether we have data in database or not
                                $rows = mysqli_num_rows($res); // function to get all the rows in database

                                $sn = 1; //Create a variable and assign the value
                                //check the num of rows
                                if($rows > 0) {
                                    //use while loop to get all the data from the database
                                    //and while loop will run as long as we have data in database
                                    while ($rows = mysqli_fetch_assoc($res)) {

                                        //get individual data
                                        $id = $rows['id'];
                                        $fullname = $rows['full_name'];
                                        $username = $rows['username'];
                                        
                                        //display the individual data gotten
                                        ?>  

                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                                <a href="update.password.php?id=<?php echo $id; ?>" class="btn btn-success hvr-icon-up col-4"">Update Password</a>
                                                <a href="update.admin.php?id=<?php echo $id; ?>" class="btn btn-success hvr-icon-drop col-6"">Update Admin</a>
                                                <a href="delete.admin.php?id=<?php echo $id; ?>" class="btn btn-danger hvr-icon-sink-away">Delete Admin</a>
                                            </td>
                                        </tr>
                                        <?php
                                        
                                    }
                                }
                                else {
                                    // no data in database
									?>

									<tr>
										<td colspan="6"><div class='alert-danger'>No Admin Added.</div></td>
									</tr>
									
							<?php

								}
							}
							else {
								?>
				
								<tr>
									<td colspan="6"><div class='alert-danger'>No Admin Added.</div></td>
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