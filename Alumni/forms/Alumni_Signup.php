
<?php

    include_once('../../config/dbconnect.php');

    $alumni_name = "";
        $gender = "";
        $alumniPhoneNo = "";
        $alumni_Email = "";
        $alumni_Address = "";
        $password = "";

        $error = false;

    if (isset($_POST['Register'])) {
        $alumni_name = $_POST['alumni_name'];
        $gender = $_POST['gender'];
        $alumniPhoneNo = $_POST['alumniPhoneNo'];
        $alumni_Email = $_POST['alumni_Email'];
        $alumni_Address = $_POST['alumni_Address'];
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

            $sql = "INSERT INTO alumni(Alumni_name, Alumni_gender, Alumni_contactNo, Alumni_email,    Alumni_address, Alumni_password) VALUES ('$alumni_name','$gender','$alumniPhoneNo','$alumni_Email','$alumni_Address','$password')";    

            if (mysqli_query($conn, $sql)) 
            {
                $successmsz = 'You are successfully registered. Press here to login.';
                header("refresh:1; url=../Alumni_Signin.php");
            }
            else
            {
                $errormsz = mysqli_error($conn);
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="en">


<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup Form</title>
        <link type="text/css" href="../../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/custom.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <script src="../../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="#">
                    Alumni Management System
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">
                
                    <ul class="nav pull-right">

                        <li><a class="User" href="../../home.php">
                            Home
                        </a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->


                <div class="span9" style="margin-top: 50px; margin-left: 200px;">
                    <div class="content">

                        <div class="module" >
                            <div class="module-head">
                                <h3 style="text-align: center;">Alumni signup</h3>
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
                                            else if (isset($errormsz))
                                            {
                                            ?>
                                              <div class="alert alert-error">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <a href="../../../../../../signin.php"><?php echo $notice; ?><a/></div>
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
                                                <input type="number" id="phone_number"
                                                name="alumniPhoneNo" placeholder="Phone number" class="span8" required><br>
                                                <p style="color: red;"><?php if(isset($errPhoneNo)) echo $errPhoneNo; ?></p><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input type="text"
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
</body>
