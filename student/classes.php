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
            if(isset($_GET['mult']) && $_GET['mult']=="true"){
                include("pages/multresults.php");   
            }else{
                include("pages/examsession.php");             
            }
        }else{
            include("pages/class1.php");        
       }
   }else{
        include("pages/allclasses.php");
   }
?>