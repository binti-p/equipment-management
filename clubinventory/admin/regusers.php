<?php
session_start();
error_reporting(0);
include('../base/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    // code for block student    
    if (isset($_GET['inid'])) {
        echo "<script>alert('block check1')</script>";
        $id = $_GET['inid'];
        $status = 0;
        $sql = "update user set corestatus=:status  WHERE ID=:id";
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('block check2')</script>";
        header('location:regusers.php');
    }



    //code for active students
    if (isset($_GET['id'])) {
        echo "<script>alert('activate check1')</script>";
        $id = $_GET['id'];
        $status = 1;
        $sql = "update user set corestatus=:status  WHERE ID=:id";
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('activate check2')</script>";
        header('location:regusers.php');
    }


?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('../base/adminheader.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Manage Registered Students</h4>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Reg Students
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student ID</th>
                                                <th>Name </th>
                                                <th>Mobile Number</th>
                                                <th>Email-ID</th>
                                                <th>Core Member</th>
                                                <th>Change Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from user";
                                            $query = $db->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->rno); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->fname); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->mobile_no); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->emailid); ?></td>
                                                        <td class="center"><?php if ($result->corestatus == 1) {
                                                                                echo htmlentities("Core Member");
                                                                            } else {
                                                                                echo htmlentities("Non-Core");
                                                                            }
                                                                            ?></td>
                                                        <td class="center">
                                                            <?php if ($result->corestatus == 1) { ?>
                                                                <a href="regusers.php?inid=<?php echo htmlentities($result->ID); ?>" onclick="return confirm('Are you sure you want to block this student?');" >  
                                                                <button class="btn btn-primary btn-sm">remove</button></a>
                                                            <?php } else { ?>
                                                                <a href="regusers.php?id=<?php echo htmlentities($result->ID); ?>" onclick="return confirm('Are you sure you want to make this student a core member?');">
                                                                <button class="btn btn-primary btn-sm">make core</button></a>
                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>



            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>

    </html>
<?php } ?>