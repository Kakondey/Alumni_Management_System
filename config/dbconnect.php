<?php
  $servername = 'localhost';
  $username = 'root'; 
  $password = '';
  $dbname = 'alumni_management_system';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn)
  {
    echo "Connection Error!".mysqli_connect_error();
  }


 ?>
