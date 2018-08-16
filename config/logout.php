<?php

  session_start();
  unset($_SESSION['Admin_name']);
  session_destroy();
  header("location: ../home.php");

 ?>
