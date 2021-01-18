<?php include "includes/config.php"?> 
<?php
    session_start();
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
    $suname = $_SESSION['username'];

     $jcres = mysqli_query($db, "select * from joinedclasses where classid=$_GET[classid] AND suname = '$suname'");
    $jcrows = mysqli_num_rows($jcres); 
?>

<?php include "includes/header2.php"?> 
<?php 
   if(isset($_GET['classid'])){?>   
        <div class="home">
            <?php include "includes/sidebar.php"?>
            <div class="home-content">
                <?php if($jcrows <=0 ): ?>
                    <div class="members-title">
                        <h3>No Class Found</h3>
                    </div>
                <?php else:?>
                    <?php
                        $jclass = mysqli_fetch_array($jcres);
                        $classresult = mysqli_query($db, "select * from classes where id=$jclass[classid]");
                        $class= mysqli_fetch_array($classresult);
                    ?>
                    <div class="results-title">
                        <h1><?php echo $class['code'] ?></h1>
                        <h5><?php echo $class['name'] ?></h5>
                    </div>
                    <div class="wrapper">
                        <h2>Exam Name</h2>
                    </div>
                <?php endif ?>
            </div>
        </div>
   <?}else{
        header('Location: classes.php');
   }
?>