<?php

	include_once('../config/dbconnect.php');

	$Alumni_name = "";
	$Alumni_Password = "";

	if (isset($_POST['login'])) {
		$Alumni_name = $_POST['name'];
		$Alumni_Password = $_POST['password'];

		$sql = "SELECT * FROM alumni WHERE Alumni_name='$Alumni_name'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);

		if ($count == 1 && $row['Alumni_Password'] = $Alumni_Password) {
			session_start();
			$_SESSION['Alumni_name'] = $row['Alumni_name'];
			header("refresh:1; url=Alumni_Dashboard.php");
		}
		else{
			$errormsg = mysqli_error($conn).'Invalid name or Password';
			header("location:Alumni_Signin.php");
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta email="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign in</title>
	<link type="text/css" href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../Assets/bootstrap/css/theme.css" rel="stylesheet">
    <link type="text/css" href="../Assets/bootstrap/css/custom.css" rel="stylesheet">
    <link type="text/css" href="../Assets/bootstrap/images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <script src="../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="#">
			  		Alumni Management System(Alumni Section)
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">

						<li><a class="User" href="forms/Alumni_Signup.php">
							Signup
						</a></li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container" style="height: 500px;">
			<div class="row">
				<div class="module module-login span4 offset4">
						<div class="module-head">
						<form class="form-vertical" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
							<h3>Sign In</h3>
						</div>
						<div class="module-body">
										<?php
                                            if(isset($errormsg))
                                            {
                                              ?>
                                              <div class="alert alert-error">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <a href="Alumni_Signin.php"><?php echo $errormsg; ?><a/> 
                                              </div>
                                              <?php
                                            }
                                        ?>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" name="name" type="text"  placeholder="name">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" name="password" type="password" id="inputPassword" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" name="login" class="btn btn-primary pull-right">Login</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->
</body>