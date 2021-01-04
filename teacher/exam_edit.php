<?php
session_start();
if(isset($_SESSION['lecid'])){
        $lecid= $_SESSION['lecid'];
}else{
    header('Location: login.php');
}
?>

<?php 
include "includes/header2.php";
include "includes/config.php";

$id = $_GET["id"];
$res = mysqli_query($db, "select * from exam_category where id='$id' ") or die(mysqli_error($db));
while($row = mysqli_fetch_array($res)){
    $exam_time = $row['time'];
    $exam_title = $row['title'];
    $exam_description = $row['description'];
} 
?> 

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
        <div class="page-title">
            <h1>Edit Exam --- <?php echo $exam_title ?></h1>
        </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <!-- CArd Body -->
                    <form action="" method="post">
                        <div class="card-body">
                            <!-- Update Exam  -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header"><strong>Edit Exam</strong></div>
                                    <div class="card-body card-block">                                        
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Exam Title</label>
                                            <input required type="text"  value="<?php echo $exam_title ?>" placeholder="Exam Title" name="examtitle" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Exam Time In Minutes</label>
                                            <input required type="text" value="<?php echo $exam_time ?>" placeholder="Exam Time In Minutes" name="examtime" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Exam Description</label>
                                            <textarea required type="text" placeholder="Exam Description" rows="5" name="examdescription" class="form-control"><?php echo $exam_description ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input 
                                            type="submit" 
                                            name="update-category-submit" class="btn btn-success" value="Update Exam">
                                        </div>                                
                                    </div>                                
                                </div>                                
                            </div>
                            <!-- End Update Exam -->                                                        
                        </div>
                        <!-- End Card Body -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['update-category-submit'])){
        mysqli_query($db, "Update exam_category set time='$_POST[examtime]', title='$_POST[examtitle]', description='$_POST[examdescription]' where id='$id' ") or die(mysqli_error($db));
        ?>
            <script type="text/javascript">
                window.location.href = "classes.php?classid=<?php echo $_SESSION['classid']; ?>";
            </script>   
        <?php
    }
?>

<?php include "includes/footer.php"?> 