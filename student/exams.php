<?php
    session_start();
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
    $suname = $_SESSION['username'];
?>

<?php include "includes/config.php"?> 
<?php include "includes/header2.php"?> 
<?php
   if(isset($_GET['classid'])){?>
        <div class="home">
            <?php include "includes/sidebar.php"?>
            <?php if(isset($_GET['examid'])){
                include("pages/exam.php");   
                }else{
                    include('pages/allexams.php');
                }
            ?>
        </div>
   <?php }else{
        header('Location: classes.php');
   }
?>

<?php
    include 'includes/modals.php';
    include 'includes/footer.php';
    
?>