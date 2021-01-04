<?php
    session_start();
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
?>

<?php include "includes/config.php"?> 
<?php
   if(isset($_GET['classid'])){   
        if(isset($_GET['examid'])){
            include("pages/examsession.php");   
        }else{
            include("pages/class.php");        
       }
   }else{
        include("pages/allclasses.php");
   }
?>