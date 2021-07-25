

<?php
session_start();
// error_reporting(0);
include('../base/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} 
else{
    if (isset($_GET['inid'])) {
        echo "<script>alert('block check1')</script>";
        $id = $_GET['inid'];
        $status = 1;
        $sql = "update issues set returnstatus=:status,date_of_return=CURRENT_DATE  WHERE issueID=:id";
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('block check2')</script>";
        header('location:issues.php');
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
                        <h4 class="header-line">View Issue Records</h4>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Issues
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <!-- <th>Request ID</th> -->
                                                <th>Student ID</th>
                                                <!-- <th>Request Time</th> -->
                                                <th>Date of Issue</th>
                                                <th>Equipment Name</th>
                                                <th>Issue Period</th>
                                                
                                                <th>Status</th>
                                                <th>Change Return Status</th>
                                                <th>Date of Return</th>
                                                <!-- <th>Change Return Status</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT issueID,issuerID,date_of_issue,equipment_name,issue_period,returnstatus,date_of_return  from issues, club_equipment where issues.equipmentID=club_equipment.ID";
                                            $query = $db->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {          
                                                    $id = $result->issuerID;
                                                    $sql1 = "select * from user where ID=:id";
                                                    $query1 = $db->prepare($sql1);
                                                    $query1->bindParam(':id', $id, PDO::PARAM_STR);
                                                    $query1->execute();
                                                    $row = $query1->fetch(PDO::FETCH_ASSOC); 
                                                    $name = $row['rno'];  
                                                        ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($name); ?></td>
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
                                                        <td class="center">
                                                            <?php if ($result->returnstatus == 0) { ?>
                                                                <a href="issues.php?inid=<?php echo htmlentities($result->issueID); ?>" onclick="return confirm('Are you sure you want to remove the approval?');" >  
                                                                <button class="btn btn-primary btn-sm">Mark as Returned</button></a>
                                                            <?php 
                                                            // } else {
                                                                 ?>
                                                                <!-- <a href="requests.php?id=<?php echo htmlentities($result->requestID); ?>" onclick="return confirm('Are you sure you want to approve this request ?');"> -->
                                                                <!-- <button class="btn btn-primary btn-sm">Approve</button></a> -->
                                                            <?php } ?>

                                                        </td>
                                                        <td class="center"><?php if ($result->returnstatus == 1) {
                                                                                echo htmlentities($result->date_of_return);
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
<?php  }?>