<?php

  session_start();
  unset($_SESSION['User_name']);
  session_destroy();
  header("location: ../home.php");

 ?>
