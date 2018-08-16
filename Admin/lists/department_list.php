<?php

    session_start();
    if (!isset($_SESSION['Admin_name'])) {
        header("location: Admin_Signin.php");
    }
    else{
        include_once('../../config/dbconnect.php');
    }

        $Department_name = "";

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
                    <div class="content" style="margin-left: 150px;">

                        <div class="module">
                            <div class="module-head">
                                <h3>Department List</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Department ID</th>
                                            <th>Department Name</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql="SELECT * FROM `department`";
                                        $query=mysqli_query($conn,$sql);

                                        if (mysqli_num_rows($query)>0) {
                                            while ($row=mysqli_fetch_object($query)) {
                                                ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row->D_id; ?></td>
                                                <td><?php echo $row->Department_name; ?></td>
                                                <td><a href="../forms/Edit_Department.php?edit=1&D_id=<?php echo $row->D_id; ?>" ><input class="btn btn-primary btn-small" value="EDIT" type="submit" name="EDIT"></a></td>
                                            </tr>
                                        </tbody>
                                        <?php
                                            }
                                        }
                                    ?>
                                    
                                    <tfoot>
                                        <tr>
                                            <th>Department ID</th>
                                            <th>Department Name</th>
                                            <th>Edit</th>
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
