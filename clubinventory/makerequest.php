<?php
session_start();
include('base/config.php');
// Validating Session
if(strlen($_SESSION['ulogin'])==0)
{
header('location:userlogin.php');
}
else{
    if (isset($_POST['submit'])) {
        try {
            $borrow = $_POST['borrow'];
            $period = $_POST['period'];
            $equipid = intval($_GET['reqid']);
            $username = $_SESSION['ulogin'];

            $sql1 = "SELECT `ID` from `user` where `rno`=:username";
            $query1 = $db->prepare($sql1);
            $query1->bindParam(':username', $username, PDO::PARAM_STR);
            $query1->execute();
            $row = $query1->fetch(PDO::FETCH_ASSOC);
            $userid = $row['ID'];

            $sql = "INSERT INTO request(equipmentID,userID,date_of_borrow,IssuePeriod) VALUES(:equipid,:userid,:borrow,:period)";
            $query = $db->prepare($sql);
            $query->bindParam(':equipid', $equipid, PDO::PARAM_STR);
            $query->bindParam(':userid', $userid, PDO::PARAM_STR);
            $query->bindParam(':borrow', $borrow, PDO::PARAM_STR);
            $query->bindParam(':period', $period, PDO::PARAM_STR);
            $query->execute();

            $_SESSION['requestmsg'] = "Request made successfully";
            header('location:inventory.php');
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <?php include('base/userheader.php'); ?>    
    <?php
    $reqid = intval($_GET['reqid']);
    $sql = "select * from club_equipment where ID=:reqid";
    $query = $db->prepare($sql);
    $query->bindParam(':reqid', $reqid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_ASSOC); 
    $name = $results['equipment_name'];
    ?>
    <div class="container my-2">
        <h3>Add request</h3>
        <form name="insert" method="post">
            <div class="form-group">
                <label>Equipment Name</label>
                <input type="text" class="form-control" readonly value ="<?php echo htmlentities($name); ?>" />
            </div>
            <div class="form-group">
                <label>Date for Borrow</label>
                <input type="date" class="form-control" name="borrow" autocomplete="off" required  value="<?php echo date('Y-m-d'); ?>" />
            </div>
            <div class="form-group">
                <label>Enter Specifications</label>
                <input class="form-control" autocomplete="off" type="number" name="period" min="1" max="7" value="1" required/>
            </div>
            <button type="submit" name="submit" class="btn btn-primary my-2" id="submit">Make request</button>
            <a href="inventory.php"><button class="btn btn-danger"> Cancel </button></a>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>
