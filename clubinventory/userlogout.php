<?php
session_start();
unset($_SESSION['ulogin']); // unset session variable
session_destroy(); // destroy session
header("location:userlogin.php");
?>