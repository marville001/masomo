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
            <div class="home-content">
                
            </div>
        </div>
   <?}else{
        header('Location: classes.php');
   }
?>