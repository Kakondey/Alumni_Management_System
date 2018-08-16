<?php

    session_start();
    if (!isset($_SESSION['Admin_name'])) {
        header("location: Admin_Signin.php");
    }
    else{
        include_once('../../config/dbconnect.php');
    }

        $alumni_id = "";
        $alumni_name = "";
        $gender = "";
        $alumniPhoneNo = "";
        $alumni_Email = "";
        $alumni_Address = "";
        $password = "";

    //deleting a row.
    if (isset($_GET['delete'])) {
        $sqlD = "DELETE FROM alumni WHERE A_id='{$_GET['A_id']}'";
        $dQuery = mysqli_query($conn,$sqlD);
        if ($dQuery) {
            header('Refresh:1; Alumni_list.php');
        }
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
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="../Dashboard.php">Alumni Management System </a>
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
                    <div class="span9">
                    <div class="content" style="margin-left: 100px;">

                        <div class="module" style="width: 1000px;">
                            <div class="module-head">
                                <h3>Alumni List</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Contact number</th>
                                            <th>Department</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql="SELECT * FROM `alumni`";
                                        $query=mysqli_query($conn,$sql);

                                        if (mysqli_num_rows($query)>0) {
                                            while ($row=mysqli_fetch_object($query)) {
                                                ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row->Alumni_name; ?></td>
                                                <td><?php echo $row->Alumni_email; ?></td>
                                                <td><?php echo $row->Alumni_gender; ?></td>
                                                <td><?php echo $row->Alumni_address; ?></td>
                                                <td><?php echo $row->Alumni_contactNo; ?></td>
                                                <td><?php echo $row->Department; ?></td>
                                                <td><a href="../forms/Edit_AlumniDetails.php?edit=1&A_id=<?php echo $row->A_id; ?>" ><input class="btn btn-primary btn-small" value="EDIT" type="submit" name="EDIT"></a></td>
                                                <td><a href="Alumni_list.php?delete=1&A_id=<?php echo $row->A_id; ?>"><input class="btn btn-primary btn-small" value="DELETE" type="submit" name="DELETE"></a></td>
                                                <td><a href="../forms/Edit_workDetails.php?view=1&A_id=<?php echo $row->A_id; ?>"><input class="btn btn-primary btn-small" value="DETAILS" type="submit" name="DETAILS"></a></td>
                                            </tr>
                                        </tbody>
                                        <?php
                                            }
                                        }
                                    ?>
                                    
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Contact number</th>
                                            <th>Department</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Details</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!--/.module-->

                        
                        
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
        <script src="../../Assets/scripts/common.js" type="text/javascript"></script>
    </body>
