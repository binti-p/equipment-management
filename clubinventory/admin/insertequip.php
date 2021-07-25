<?php
session_start();
include('../base/config.php');
if (isset($_POST['insert'])) {
    try {
        //Code for student ID
        $eqname = $_POST['name'];
        $spec = $_POST['specs'];
        $imgpath = $_POST['path'];
        $sql = "INSERT INTO club_equipment(equipment_name,specification,image_path) VALUES(:eqname,:spec,:imgpath)";
        $query = $db->prepare($sql);
        $query->bindParam(':eqname', $eqname, PDO::PARAM_STR);
        $query->bindParam(':spec', $spec, PDO::PARAM_STR);
        $query->bindParam(':imgpath', $imgpath, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $db->lastInsertId();
        if ($lastInsertId) {
            echo '<script>alert("Successfully added "+"' . $eqname . '")</script>';
            echo "<script> document.location ='equipment.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Check if all the information is valid.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title></title>
    <!-- BOOTSTRAP CORE STYLE  -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <?php include('../base/adminheader.php'); ?>

    <div class="container">
        <h4 class="header-line">Enter Equipment</h4>
        <form name="insert" method="post">
            <div class="form-group">
                <label>Enter Name</label>
                <input class="form-control" type="text" name="name" autocomplete="off" required />
            </div>
            <div class="form-group">
                <label>Enter Specifications</label>
                <input class="form-control" type="text" name="specs" autocomplete="off" required/>
            </div>
            <div class="form-group">
                <label>Enter Path</label>
                <input class="form-control" type="text" name="path" autocomplete="off" required/>
            </div>
            <button type="submit" name="insert" class="btn btn-primary my-2" id="submit">Insert</button>
        </form>
        <a href="equipment.php"><button class="btn btn-danger"> Cancel </button></a>
    </div>
</body>

</html>