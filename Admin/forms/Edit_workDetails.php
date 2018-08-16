
<?php

    session_start();
    
    include_once('../../config/dbconnect.php');
    

        $A_id = "";
        $Wk_id = "";
        $Company_name = "";
        $Company_location = "";
        $industry = "";
        $package = "";
        $working_from = "";
        $working_to = ""; 

        $Alumni_id = $_GET['A_id'];

    if (isset($_POST['Update'])) {
        $Wk_id = $_POST['Wk_id'];
        $Company_name = $_POST['Company_name'];
        $Company_location = $_POST['Company_location'];
        $industry = $_POST['industry'];
        $package = $_POST['package'];
        $working_from = date("Y-m-d", strtotime($_POST['working_from']));
        $working_to = date("Y-m-d", strtotime($_POST['working_to']));

        $sqlU = "UPDATE worksfor SET Company_name='$_POST[Company_name]', Company_location='$_POST[Company_location]', industry='$_POST[industry]', package='$_POST[package]', working_from='$_POST[working_from]', working_to='$_POST[working_to]'
                WHERE Wk_id='$_POST[Wk_id]'"; 

        if (mysqli_query($conn, $sqlU)) 
        {
            $successmsz = 'Your work details are successfully Updated.';
            header("refresh:1; url=Edit_work_details.php");
        }
        else
        {
            $errormsz = mysqli_error($conn);
        }

    }

    if (isset($_POST['Add'])) {
        $Company_name = $_POST['Company_name'];
        $Company_location = $_POST['Company_location'];
        $industry = $_POST['industry'];
        $package = $_POST['package'];
        $working_from = date("Y-m-d", strtotime($_POST['working_from']));
        $working_to = date("Y-m-d", strtotime($_POST['working_to']));

        $sqlI = "INSERT INTO worksfor(A_id, Company_name, Company_location, industry, package, working_from, working_to) 
                VALUES('$Alumni_id','$Company_name','$Company_location','$industry','$package','$working_from','$working_to')"; 

        if (mysqli_query($conn, $sqlI)) 
        {
            $successmsz = 'Your work details are successfully added.';
            header("refresh:1; url=Edit_workDetails.php");
        }
        else
        {
            $errormsz = mysqli_error($conn);
        }

    }

    if (isset($_GET['view'])) {
        $sqlE = "SELECT * FROM worksfor WHERE A_id='{$_GET['A_id']}'";
        $eQuery = mysqli_query($conn,$sqlE);
        if (mysqli_num_rows($eQuery)>0){
        $row = mysqli_fetch_object($eQuery);

        $A_id = $row->A_id;
        $Company_name = $row->Company_name;
        $Company_location = $row->Company_location;
        $industry = $row->industry;
        $package = $row->package;
        $working_from = $row->working_from;
        $working_to = $row->working_to;
        }
        else{
            $emptyError = "Please Enter Alumni Work Details First";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">


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
        <script src="../../Assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/common.js" type="text/javascript"></script>
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
                            <div class="module" >
                            <div class="module-head">
                                <h3 style="text-align: center;">Your Work Details</h3>
                            </div>
                            <div class="module-body">

                                        <?php
                                            if(isset($successmsz))
                                            {
                                              ?>
                                              <div class="alert alert-success"><?php echo $successmsz; ?>
                                              </div>
                                              <?php
                                            }
                                            else if (isset($emptyError)) {
                                                ?>
                                                <div class="alert alert-danger"><?php echo $emptyError; ?>
                                              </div>
                                              <?php
                                            }
                                       ?>
                                    <br />

                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                        <input type="hidden" id=" Wk_id" value="<?php echo $Wk_id; ?>" name="Wk_id" class="span8">
                                        <input type="hidden" id=" A_id" value="<?php echo $A_id; ?>" name="A_id" class="span8">

                                        <div class="control-group">
                                            <label class="control-label" for="  Company_name">  Company Name</label>
                                            <div class="controls">
                                                <input type="text" id=" Company_name" value="<?php echo $Company_name; ?>" name="Company_name" class="span8"><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Company_location">Company location</label>
                                            <div class="controls">
                                                <input type="text" id="Company_location" value="<?php echo $Company_location; ?>" name="Company_location" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="industry">Industry</label>
                                            <div class="controls">
                                                <input type="text" id="industry" value="<?php echo $industry; ?>" name="industry" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="package">Package(in rupees/annum)</label>
                                            <div class="controls">
                                                <input type="text" id="package" value="<?php echo $package; ?>" name="package" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="working_from">Working From</label>
                                            <div class="controls">
                                                <input type="date" id="working_from"
                                                name="working_from" value="<?php echo $working_from; ?>" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="working_to">Working To</label>
                                            <div class="controls">
                                                <input type="date" id="working_to"
                                                name="working_to" value="<?php echo $working_to; ?>" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="Update" type="submit" class="btn btn-primary btn-xl" onclick="checkFields()">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
</body>