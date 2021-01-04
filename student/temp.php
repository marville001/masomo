<?php
    session_start();
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
    include 'includes/header2.php';
?>

<div class="row" style="margin-top: 10px; padding:0px; margin-bottom: 50px;">
    <div class="col-lg-12" style="min-height: 500px; background-color: white;"></div>
</div>

<?php
    include 'includes/footer.php';
?>

<?php
    session_start();
    include "includes/config.php";
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
    $suname = $_SESSION['username'];
?>

<?php
   $jcres = mysqli_query($db, "select * from joinedclasses where suname = '$suname'");
   $jcrows = mysqli_num_rows($jcres);

   if($jcrows>0){ 
       include("pages/class.php");
   }else{
       include("pages/no_class.php"); 
   }
?>