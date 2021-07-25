<?php
session_start();
// error_reporting(0);
include('../base/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $specs = $_POST['specs'];
        $imgpath = $_POST['imgpath'];
        $equipid = intval($_GET['equipid']);
        $sql = "update  club_equipment set equipment_name=:name,specification=:specs,image_path=:imgpath where ID=:equipid";
        $query = $db->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':specs', $specs, PDO::PARAM_STR);
        $query->bindParam(':imgpath', $imgpath, PDO::PARAM_STR);
        $query->bindParam(':equipid', $equipid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Equipment info updated successfully";
        header('location:equipment.php');
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Equipment</title>
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
                        <h4 class="header-line">Add Book</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
                        <div class=" panel panel-info">
                            <div class="panel-heading">
                                Book Info
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <?php
                                    $equipid = intval($_GET['equipid']);
                                    $sql = "select * from club_equipment where ID=:equipid";
                                    $query = $db->prepare($sql);
                                    $query->bindParam(':equipid', $equipid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {  ?>

                                            <div class="form-group">
                                                <label>Name<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="name" value="<?php echo htmlentities($result->equipment_name); ?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Specifications<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="specs" value="<?php echo htmlentities($result->specification); ?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Image Path<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="imgpath" value="<?php echo htmlentities($result->image_path); ?>" required />
                                            </div>


                                    <?php }
                                    } ?>

                                    <button type="submit" name="update" class="btn btn-info">Update </button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } ?>