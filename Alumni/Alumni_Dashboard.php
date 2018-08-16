<?php

    session_start();
    if (!isset($_SESSION['Alumni_name'])) {
        header("location: Alumni_Signin.php");
    }
    else{
        include_once('../config/dbconnect.php');

        $Alumni_name = $_SESSION['Alumni_name'];

        if(isset($_POST["insert"]))  
         {  
              $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
              $queryD = "DELETE FROM images WHERE alumni_name = '$Alumni_name'";
              mysqli_query($conn,$queryD);  
              $query = "INSERT INTO images(alumni_name,image) VALUES ('$Alumni_name','$file')";  
              if(mysqli_query($conn, $query))  
              {  
                    header('Refresh:1; Alumni_Dashboard.php');  
              }  
         } 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alumni Panel</title>
        <link type="text/css" href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../Assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../Assets/bootstrap/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../Assets/bootstrap/css/custom.css" rel="stylesheet">
        <link type="text/css" href="../Assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='../Assets/http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="Alumni_Dashboard.php">Alumni Management System </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li><a class="User" href="#"><?php echo $_SESSION['Alumni_name']; ?></a></li>
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
                                <li class="active"><a href="Alumni_Dashboard.php"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li style="height: 30px; text-align: center;padding-top: 10px; background-color: #4268f4;"><b><h4>Enter Your details.(If not filled)</h4></b></li>
                                <li><a href="forms/work_details.php"><i class="menu-icon icon-tasks"></i>Work </a>
                                </li>
                                <li><a href="forms/higher_education.php"><i class="menu-icon icon-tasks"></i>Higher Education </a>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a href="../config/Alumni_logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                        <?php  
                        $query = "SELECT * FROM images WHERE alumni_name = '$Alumni_name'";  
                        $result = mysqli_query($conn, $query);  
                        while($row = mysqli_fetch_object($result))  
                        {  
                        ?>      <div style=""><?php       echo ' 
                                            <img src="data:image/jpeg;base64,'.base64_encode($row->image ).'" height="200" width="200" class="img-thumnail" />
                                        ';
                             ?>  
                             </div>
                             <?php 
                        }  
                        ?>  
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                    <p><h3>View Your Details here:</h3></p>
                                <div class="btn-box-row row-fluid">
                                    <a href="forms/Edit_work_details.php" class="btn-box big span4"><i class="icon-group"></i>
                                        <p class="text-muted">
                                            Work Details</p>
                                    </a>
                                    <a href="forms/Edit_higher_education.php" class="btn-box big span4"><i class="icon-group"></i>
                                        <p class="text-muted">
                                            Higher Education Details</p>
                                    </a>
                                </div>
                                <form method="post" enctype="multipart/form-data">  
                                     <p><h3>Upload your Profile Picture :</h3></p>
                                     <input style="color: black;" type="file" name="image" id="image" />  
                                     <br />  
                                     <input type="submit" name="insert" id="insert" value="Upload" required class="btn btn-primary" />  
                                </form>
                            </div>
                            <!--/#btn-controls-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <script src="../Assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../Assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../Assets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../Assets/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../Assets/scripts/common.js" type="text/javascript"></script>

    </body>
