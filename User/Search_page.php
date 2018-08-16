<?php

    
        include_once('../config/dbconnect.php');
    
        $keywords = "";

        $alumni_id = "";
        $alumni_name = "";
        $gender = "";
        $alumniPhoneNo = "";
        $alumni_Email = "";
        $alumni_Address = "";
        $password = "";

        $Company_name = "";
        $Company_location = "";
        $industry = "";
        $package = "";
        $working_from = "";
        $working_to = ""; 

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
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
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="Dashboard.php">Alumni Management System </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li><a class="User" href="../home.php">Home</a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                        <input type="search" name="keywords" placeholder="Search by Department" class="span3">
                        </form>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container" style="margin-left: 150px;">
                <div class="row">
                    <div class="span9">
                    <div class="content">
                        <?php 

                                if (isset($_POST['keywords'])) 
                                {
                                    $keywords = $conn->escape_string($_POST['keywords']);

                                    $query1 = mysqli_query($conn,"SELECT * FROM alumni
                                              WHERE Department LIKE '%$keywords%' OR Alumni_name LIKE '%$keywords%'");
                                    $num_rows1 = mysqli_num_rows($query1);

                                    // $query2 = mysqli_query($conn,"SELECT * FROM worksfor WHERE Company_name LIKE '%$keywords%' OR Company_location LIKE '%$keywords%' OR industry LIKE '%$keywords%'");
                                    // $num_rows2 = mysqli_num_rows($query2);

                                    // $query = mysqli_query($conn,"SELECT alumni.Department, alumni.Alumni_name, alumni.Alumni_address
                                    //          , worksfor.Company_name, worksfor.Company_location, worksfor.industry 
                                    //          FROM alumni INNER JOIN worksfor ON
                                    //          alumni.A_id = worksfor.A_id WHERE 
                                    //          alumni.Department LIKE '%$keywords%' OR alumni.Alumni_name LIKE '%$keywords%' 
                                    //          OR alumni.Alumni_address LIKE '%$keywords%' OR worksfor.Company_name LIKE '%$keywords%' 
                                    //          OR worksfor.Company_location
                                    //          LIKE '%$keywords%' OR worksfor.industry LIKE '%$keywords%'");

                                    while ($row1 = mysqli_fetch_array($query1)) {
                                        $alumni_id = $row1['A_id'];
                                        $alumni_name = $row1['Alumni_name'];
                                        $gender = $row1['Alumni_gender'];
                                        $alumniPhoneNo = $row1['Alumni_contactNo'];
                                        $alumni_Email = $row1['Alumni_email'];
                                        $alumni_Address = $row1['Alumni_address'];

                                        $queryPP = "SELECT * FROM images WHERE alumni_name = '$alumni_name'";
                                        $resultPP = mysqli_query($conn,$queryPP);
                                   

                             ?>
                        <div class="module" style="">
                            <div class="module-head">
                                <h3 style="text-align: center;">Alumni Details</h3>
                            </div>
                            <div class="module-body">
                                    <br />

                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                        <input type="hidden" id="alumni_id" value="<?php echo $alumni_id; ?>" name="alumni_id" class="span8"><br><br>

                                         <div class="control-group">
                                            <label class="control-label" for="alumni_name">Profile Picture : </label>
                                            <div class="controls">
                                                <p><?php
                                                    if (mysqli_num_rows($resultPP)>0) {
                                                        while ($rowPP = mysqli_fetch_array($resultPP)) {
                                                            $alumni_image = $rowPP['image'];
                                                    echo ' 

                                                                        <img src="data:image/jpeg;base64,'.base64_encode($alumni_image ).'" height="200" width="200" class="img-thumnail" />
                                                         '; 
                                                        }
                                                    }
                                                    else{
                                                        ?>
                                                            <p><?php echo "No Profile Image." ?></p>
                                                        <?php    
                                                    }    
                                                 ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="alumni_name">Alumni Name : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $alumni_name; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Gender : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $gender; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="phone_number">Phone number : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $alumniPhoneNo; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="email">Email : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $alumni_Email; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="address">Address : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $alumni_Address; ?></p>
                                            </div>
                                        </div>

                                        <?php 

                                                    // quering the work details.
                                                $sqlE = "SELECT * FROM worksfor WHERE A_id='$alumni_id'";
                                                $eQuery = mysqli_query($conn,$sqlE);
                                                if (mysqli_num_rows($eQuery)>0){
                                                while($row = mysqli_fetch_object($eQuery)){

                                                $Company_name = $row->Company_name;
                                                $Company_location = $row->Company_location;
                                                $industry = $row->industry;
                                                $package = $row->package;
                                                $working_from = $row->working_from;
                                                $working_to = $row->working_to;
                                            

                                         ?>
                                         <hr>
                                        <div><h5 style="color: grey; text-align: center;">Work Details</h5></div>
                                         <hr>
                                        <div class="control-group">
                                            <label class="control-label" for="Company_name">Company Name : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $Company_name; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Company_location">Company location : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $Company_location; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="industry">Industry : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $industry; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="package">Package(in rupees/annum) : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $package; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="working_from">Working From : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $working_from; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="working_to">Working To : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $working_to; ?></p>
                                            </div>
                                        </div>

                                        <?php 
                                            }}
                                            $sqlHS = "SELECT * FROM higher_studies WHERE A_id = '$alumni_id'";
                                            $queryHS = mysqli_query($conn,$sqlHS);
                                            if (mysqli_num_rows($queryHS)>0){
                                            while($row = mysqli_fetch_object($queryHS)){

                                                $HS_id = $row->HS_id;
                                                $Institute_name = $row->Institute_name;
                                                $course_name = $row->course_name;
                                            

                                         ?>

                                        <hr>
                                        <div><h5 style="color: grey; text-align: center;">Higher Education Details</h5></div>
                                         <hr>

                                         <div class="control-group">
                                            <label class="control-label" for="  Institute_name">Institute Name : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $Institute_name; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="course_name">Course Name : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $course_name; ?></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php
                            }}  }
                                } ?>
                        
                        
                    </div><!--/.content-->
                </div><!--/.span9-->
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
