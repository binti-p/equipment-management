<?php
session_start();
include('base/config.php');
if (isset($_POST['signup'])) {
    try{
        //Code for student ID
        $StudentId = $_POST['rollno'];
        $fname = $_POST['fullname'];
        $mobileno = $_POST['mobileno'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "INSERT INTO user(rno,fname,mobile_no,emailid,password) VALUES(:StudentId,:fname,:mobileno,:email,:password)";
        $query = $db->prepare($sql);
        $query->bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $db->lastInsertId();
        if ($lastInsertId) {
            echo '<script>alert("Your Registration successful with StudentID  "+"' . $StudentId . '")</script>';
            echo "<script> document.location ='userlogin.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Check if all the information is valid.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error : ".$e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html >

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Student Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
        <style>
        .background {
            background-image: url("https://images.unsplash.com/photo-1470770841072-f978cf4d019e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80");
            background-color: #cccccc;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: -2;

        }

        #overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.6;
            z-index: -1;
        }
        .form-control{
            padding: 10px!important;
            background-color: rgba(255,255,255, 0.7)!important;
            border-radius: 0.5rem!important;
        }
        .btn{
            padding: 10px!important;
            border-radius: 0.5rem!important;
        }
        .form-control:focus{
            padding: 10px!important;
            background-color: rgba(255,255,255,1)!important;
            border-radius: 0.5rem!important;
        }
        a{
            color: white; text-decoration: none;
        }
        a:hover, a:active  {
  color: green;
}
    </style>
</head>

<body>
    <div class="background">
        <div id="overlay"></div>
    </div>
    <div class="container" style="padding: 10px 25px">
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm-6">
        <h1 class="display-5 mb-4 mt-2 text-light text-center">User Signup</h1>
        <form name="signup" method="post" onSubmit="return valid();">
            <div class="form-group mb-3">
                <input class="form-control" placeholder="Student ID" type="text" name="rollno" autocomplete="off" required />
            </div>
            <div class="form-group mb-3">
                <input class="form-control" placeholder="Full Name" type="text" name="fullname" autocomplete="off" required />
            </div>
            <div class="form-group mb-3">
                <input class="form-control" placeholder="Mobile Number" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
            </div>

            <div class="form-group mb-3">
                <input class="form-control" placeholder="Email ID" type="email" name="email" autocomplete="off" required />
            </div>

            <div class="form-group mb-3">
                <input class="form-control" placeholder="Password" type="password" name="password" autocomplete="off" required />
            </div>

            <div class="form-group mb-3">
                <input class="form-control" placeholder="Confirm Password" type="password" name="confirmpassword" autocomplete="off" required />
            </div>
            <div class="d-grid gap-2">
            <button type="submit" name="signup" class="btn btn-success btn-block" id="submit">Register Now </button>
            </div>
            <div class="text-center mt-2 back">
                <a href="index.php" >< Go Back</a>
            </div>

        </form>
        </div>
        <div class="col-sm"></div>

    </div>
        
    </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
