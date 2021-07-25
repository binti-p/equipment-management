

<?php
session_start();
// error_reporting(0);
include('base/config.php');
// Validating Session
if(strlen($_SESSION['ulogin'])==0)
{
header('location:userlogin.php');
}
else {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>PMC Equipment Management System | User Dashboard</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!------MENU SECTION START-->
    <?php include('base/userheader.php');
    $username = $_SESSION['ulogin'];
    $sql0 = "SELECT `ID` from `user` where `rno`=:username";
    $query0 = $db->prepare($sql0);
    $query0->bindParam(':username', $username, PDO::PARAM_STR);
    $query0->execute();
    $row = $query0->fetch(PDO::FETCH_ASSOC);
    $id = $row['ID'];
    ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">USER DASHBOARD</h4>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-success back-widget-set text-center">
                        <i class="fa fa-book fa-5x"></i>
                        <?php
                        $sql = "SELECT id from club_equipment";
                        $query = $db->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $listd = $query->rowCount();
                        ?>
                        <h3><?php echo htmlentities($listd); ?></h3>
                        Total Equipments Listed
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-bars fa-5x"></i>
                        <?php
                        $sql1 = "SELECT issueID from issues where issuerID=:id";
                        $query1 = $db->prepare($sql1);
                        $query1->bindParam(':id', $id, PDO::PARAM_STR);
                        $query1->execute();
                        $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                        $issued = $query1->rowCount();
                        ?>
                        <h3><?php echo htmlentities($issued); ?> </h3>
                        Times Equipments Issued
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-warning back-widget-set text-center">
                        <i class="fa fa-recycle fa-5x"></i>
                        <?php
                        $status = 0;
                        $sql2 = "SELECT * from request where status=:status and userID=:id";
                        $query2 = $db->prepare($sql2);
                        $query2->bindParam(':status', $status, PDO::PARAM_STR);
                        $query2->bindParam(':id', $id, PDO::PARAM_STR);
                        $query2->execute();
                        $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                        $requests = $query2->rowCount();
                        ?>
                        <h3><?php echo htmlentities($requests); ?></h3>
                        Pending Request(s)
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-danger back-widget-set text-center">
                        <i class="fa fa-users fa-5x"></i>
                        <?php
                        $status=0;
                        $sql3 = "SELECT * from issues where returnstatus=:status and issuerID=:id";
                        $query3 = $db->prepare($sql3);
                        $query3->bindParam(':status', $status, PDO::PARAM_STR);
                        $query3->bindParam(':id', $id, PDO::PARAM_STR);
                        $query3->execute();
                        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                        $returns = $query3->rowCount();
                        ?>
                        <h3><?php echo htmlentities($returns); ?></h3>
                        Pending Return(s)
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="assets/img/1.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="assets/img/2.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="assets/img/3.jpg" alt="" />
                            </div>
                        </div>
                        <!--INDICATORS-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example" data-slide-to="1"></li>
                            <li data-target="#carousel-example" data-slide-to="2"></li>
                        </ol>
                        <!--PREVIUS-NEXT BUTTONS-->
                        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


<?php } ?>