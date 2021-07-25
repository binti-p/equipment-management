<?php
session_start();
include('base/config.php');
if (isset($_POST['userlogin'])) {
    echo "<script> document.location ='userlogin.php'; </script>";
}
if (isset($_POST['adminlogin'])) {
    echo "<script> document.location ='admin/adminlogin.php'; </script>";
}
if (isset($_POST['signup'])) {
    echo "<script> document.location ='signup.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    </style>
</head>

<body>
    <div class="background">
        <div id="overlay"></div>
    </div>
    <div class="container-fluid px-5" style="position: fixed; z-index: 0">
        <div class="d-flex flex-column align-items-center justify-content-center m-0 text-center text-wrap text-light" style="height: 100vh;">
            <h1 class="display-2" >My Club</h1>
            <hr>
            <p>Welcome to the equipment inventory for My Club. Students can login as users and issue equipments for their personal usage.</p>
            <hr>
            <form name="signup" method="post" onSubmit="return valid();">
                <button type="submit" name="signup" class="btn btn-success rounded-pill m-1" id="submit">Register Now </button>

                <button type="submit" name="userlogin" class="btn btn-success rounded-pill m-1" id="submit">Login as User</button>
                <button type="submit" name="adminlogin" class="btn btn-success rounded-pill m-1" id="submit">Login as Admin</button>
            </form>
        </div>
    </div>


    </div>

</body>

</html>