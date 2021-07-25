<?php
session_start();
unset($_SESSION['alogin']); // unset session variable
session_destroy(); // destroy session
header("location:adminlogin.php");
?>