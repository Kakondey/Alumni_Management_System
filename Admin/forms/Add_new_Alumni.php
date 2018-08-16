<?php

    session_start();
    if (!isset($_SESSION['Admin_name'])) {
        header("location: Admin_Signin.php");
    }
    else{
        include_once('../../config/dbconnect.php');
    }

        $error = false;

        $alumni_name = "";
        $gender = "";
        $alumniPhoneNo = "";
        $alumni_Email = "";
        $alumni_Address = "";
        $department = "";
        $password = "";

    if (isset($_POST['Register'])) {
        $alumni_name = $_POST['alumni_name'];
        $gender = $_POST['gender'];
        $alumniPhoneNo = $_POST['alumniPhoneNo'];
        $alumni_Email = $_POST['alumni_Email'];
        $alumni_Address = $_POST['alumni_Address'];
        $department = $_POST['department'];
        $password = $_POST['password'];
    
        if (!filter_var($alumni_Email, FILTER_VALIDATE_EMAIL)) {
          $error = true;  
          $emailErr = "Invalid email format"; 
        }
        
        if(strlen($alumniPhoneNo)<10)
        {
          $error = true;
          $errPhoneNo = 'please enter a valid Phone number';
        }

        if(strlen($alumniPhoneNo)>10)
        {
          $error = true;
          $errPhoneNo = 'please enter a valid Phone number';
        }

        if (!$error) {
            
        
            $sql = "INSERT INTO alumni(Alumni_name, Alumni_gender, Alumni_contactNo, Alumni_email,  Department, Alumni_address, Alumni_password) VALUES ('$alumni_name','$gender','$alumniPhoneNo','$alumni_Email','$department','$alumni_Address','$password')";    

            if (mysqli_query($conn, $sql)) 
            {
                $successmsz = 'You are successfully registered. Press here to login.';
                header("refresh:1; url=Add_new_Alumni.php");
            }
            else
            {
                $errormsz = mysqli_error($conn);
            }
        }

        header("refresh:3; url=Add_new_Alumni.php");

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link type="text/css" href="../../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/custom.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='../../Assets/http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="Dashboard.php">Alumni Management System </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li><a class="User" href="#"><?php echo $_SESSION['Admin_name']; ?></a></li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="../Dashboard.php"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-tasks">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Alumni </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="Add_new_Alumni.php"><i class="icon-group"></i>Add new Alumni</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a href="department.php"><i class="menu-icon icon-tasks"></i>Add new Department </a>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a href="../../config/logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <center><h3>Add Alumni Details</h3></center>
                            </div>
                            <div class="module-body">

                                    <?php
                                            if(isset($successmsz))
                                            {
                                              ?>
                                              <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <a href="signin.php"><?php echo $successmsz; ?><a/> 
                                              </div>
                                              <?php
                                            }
                                       ?>

                                    <br />

                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                        <div class="control-group">
                                            <label class="control-label" for="alumni_name">Your Name</label>
                                            <div class="controls">
                                                <input type="text" id="alumni_name" name="alumni_name" placeholder="eg: Your name" class="span8"><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Gender</label>
                                            <div class="controls">
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" id="optionsRadios1" value="Male" checked="">
                                                    Male
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" id="optionsRadios2" value="Female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="phone_number">Phone number</label>
                                            <div class="controls">
                                                <input type="text" id="phone_number" style="margin-bottom: 10px;"
                                                name="alumniPhoneNo" placeholder="Phone number" class="span8" required><br>
                                                <p style="color: red;"><?php if(isset($errPhoneNo)) echo $errPhoneNo; ?></p><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input type="text" style="margin-bottom: 10px;"
                                                 name="alumni_Email" id="email" placeholder="kiko8797@gmail.com" class="span8" required><br>
                                                <p style="color: red;"><?php if(isset($emailErr)) echo $emailErr; ?></p><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="address">Address</label>
                                            <div class="controls">
                                                <textarea id="address" name="alumni_Address" class="span8" rows="5" required></textarea><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Department</label>
                                            <div class="controls">
                                                <select name="department" class="span8">
                                                    <option selected="selected">--Select Department--</option>
                                                    <?php
                                                        $queryD = "SELECT * FROM department";
                                                        $resultD = mysqli_query($conn,$queryD);
                                                        while($row=mysqli_fetch_assoc($resultD))
                                                        {
                                                            ?>
                                                            <option value="<?php echo $row['Department_name']; ?>"><?php echo $row['Department_name']; ?></option>
                                                            <?php
                                                        } 
                                                    ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                                <input type="password" id="password"
                                                name="password"  class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="Register" type="submit" class="btn btn-primary btn-xl" onclick="checkFields()">Register</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div><!--/.content-->
                </div><!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <script src="../../Assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/common.js" type="text/javascript"></script>
        
    </body>
