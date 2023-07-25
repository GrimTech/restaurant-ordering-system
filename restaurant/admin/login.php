<?php 
	include ('config/constants.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive Website Template | Login Page :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false) function hideURLbar(){ window.scrollTo(0,1); }; </script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- side nav css file -->
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->
 
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

</head> 
<body class="">
<div class="main-content">
	
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
					<?php
						if (isset($_SESSION['login'])) {
							echo $_SESSION['login'].'<br><br>';
							unset($_SESSION['login']);
						}
						if (isset($_SESSION['no-login-message'])) {
							echo $_SESSION['no-login-message'];
							unset($_SESSION['no-login-message']);
						}
					?>
						<form action="#" method="post">
							<input type="text" class="user" name="username" placeholder="Enter Username" required="">
							<input type="password" name="password" class="lock" placeholder="Password" required="">
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="submit" value="Login">
							<!--<div class="registration">
								Don't have an account ?
								<a class="" href="signup.html">
									Create an account
								</a>
							</div>-->
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<!--footer-->
	<?php
		include ('footer.php');
	?>

	<?php
    //check whether the submit button has been clicked or not
    if (isset($_POST['submit'])) {
        //Process for login
        //Get the data item from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQL to check whether the user exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='alert-success text-center'>Login unSuccessful.</div>";
            $_SESSION['user'] = $username; //checks whether user is logged in or not
            //redirect the user to Home
            header("location:index.php");
        }
        else {
            //User Unavailable and Login Fail
            $_SESSION['login'] = "<div class='alert-danger text-center'>Username or Password did not match.</div>";
            //redirect the user to Home
            header("location:login.php");
        }
    }