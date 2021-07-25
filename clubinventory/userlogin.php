<?php
session_start();
error_reporting(0);
include('base/config.php');
if ($_SESSION['ulogin'] != '') {
    $_SESSION['ulogin'] = '';
}
if (isset($_POST['login'])) {
    try {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT `rno`,`password` FROM `user` WHERE `rno`=:username and `password`=:password";
        $query = $db->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $count = $query->rowCount();
        $row   = $query->fetch(PDO::FETCH_ASSOC);
        if ($count == 1 && !empty($row)) {
            $_SESSION['ulogin'] = $_POST['username'];
            echo "<script> document.location ='welcome.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    } catch (PDOException $e) {
        echo "Error : ".$e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="base/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="base/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="base/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="base/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="base/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="base/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="base/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="base/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="base/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="base/css/util.css">
	<link rel="stylesheet" type="text/css" href="base/css/main.css">
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" role="form" method="post">
					<span class="login100-form-title p-b-43">
						Login as User
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Student ID</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<!-- <div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div> -->

						<!-- <div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div> -->
					<!-- </div> -->
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name='login' type='submit'>
							Login
						</button>
					</div>
                    <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
						<a href="index.php">< Go Back</a>	
						</span>
					</div>
                    <!-- <div class="container-login100-form-btn">
						<button class="login100-form-btn" name='signup' type='submit'>
							
						</button>
					</div> -->
					
					<!-- <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div> -->

					<!-- <div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div> -->
				</form>
                
				<div class="login100-more" style="background-image: url('https://images.unsplash.com/photo-1517999144091-3d9dca6d1e43?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=582&q=80');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="base/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="base/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="base/vendor/bootstrap/js/popper.js"></script>
	<script src="base/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="base/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="base/vendor/daterangepicker/moment.min.js"></script>
	<script src="base/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="base/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="base/js/main.js"></script>

</body>
</html>