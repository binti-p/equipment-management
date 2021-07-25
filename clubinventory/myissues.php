

<?php
session_start();
// error_reporting(0);
include('base/config.php');
if (strlen($_SESSION['ulogin']) == 0) {
    header('location:index.php');
} else {
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
        <?php include('base/userheader.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">My Requests</h4>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <!-- <th>Request ID</th> -->
                                                <th>Date of Issue</th>
                                                <th>Equipment Name</th>
                                                <th>Issue Period</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $username = $_SESSION['ulogin'];
                                            $sql1 = "SELECT `ID` from `user` where `rno`=:username";
                                            $query1 = $db->prepare($sql1);
                                            $query1->bindParam(':username', $username, PDO::PARAM_STR);
                                            $query1->execute();
                                            $row = $query1->fetch(PDO::FETCH_ASSOC);
                                            $userid = $row['ID'];

                                            $sql = "SELECT issueID,date_of_issue,equipment_name,issue_period,returnstatus,date_of_return  from issues, club_equipment where issues.equipmentID=club_equipment.ID and issuerID=:userid";
                                            $query = $db->prepare($sql);
                                            $query->bindParam(':userid', $userid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {  ?>
                                                    <tr class="odd gradeX">
                                                    <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->date_of_issue); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->equipment_name); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->issue_period); ?></td>
                                                        <td class="center"><?php if ($result->returnstatus == 1) {
                                                                                echo htmlentities("Returned");
                                                                            } 
                                                                            else if ($result->returnstatus == 0) {
                                                                                echo htmlentities("Not Returned Yet");
                                                                            } 
                                                                            
                                                                            ?></td>
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