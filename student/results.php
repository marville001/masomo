<?php include "includes/config.php"?> 
<?php
    session_start();
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
    $suname = $_SESSION['username'];

    // Exams
    $examsres = mysqli_query($db, "select * from exams where classid = '$_GET[classid]' and id = '$_GET[examid]'");
    $examsrows = mysqli_num_rows($examsres);
    $examsarray = mysqli_fetch_array($examsres);

    $jcres = mysqli_query($db, "select * from joinedclasses where classid=$_GET[classid] AND suname = '$suname'");
    $jcrows = mysqli_num_rows($jcres); 

    $multquizres = mysqli_query($db, "select * from questions where examid=$_GET[examid]");
    $multquizrows = mysqli_num_rows($multquizres); 
    $manswwercheckresult = mysqli_query($db, "select * from answers where uname='$suname' and exam_id=$_GET[examid]");
    $manswwercheckrows = mysqli_num_rows($manswwercheckresult);
    $manswwerarray = mysqli_fetch_array($manswwercheckresult);
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
                        <h2> Exam - <?php echo $examsarray['name'] ?></h2>
                        <hr>
                        <div class="jumbotron p-3">
                            <h5>Score: 20 / 30</h5>

                            <?php
                                $commentresult = mysqli_query($db, "SELECT * FROM `exam_mult_comments` where examid= '$_GET[examid]'");
                                $commentrow = mysqli_num_rows($commentresult);
                                $commentarray =mysqli_fetch_array($commentresult);
                            ?>
                            <p>
                                Teachers Comment: 
                                <?php 
                                    if($commentrow >=1){
                                        ?>
                                            <i>"<?php echo $commentarray['comment'];?>"</i>
                                        <?php
                                    }else{ 
                                        echo "No comment yet";
                                    }?>
                            </p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
   <?php }else{
        header('Location: classes.php');
   }
?>

<?php include "includes/modals.php"?> 
<?php include "includes/footer.php"?> 
