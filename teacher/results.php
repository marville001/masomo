<?php
session_start();
if(isset($_SESSION['lecid'])){
        $lecid= $_SESSION['lecid'];
}else{
    header('Location: login.php');
}
?>

<?php include "includes/config.php"?> 
<?php
   if(isset($_GET['classid'])){
       include("pages/allexamresults.php");        
   }
?>