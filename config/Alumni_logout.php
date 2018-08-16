<?php

  session_start();
  unset($_SESSION['Alumni_name']);
  session_destroy();
  header("location: ../home.php");

 ?>
