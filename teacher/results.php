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
    if(isset($_GET['examid'])){
        if(isset($_GET['mult']) && $_GET['mult'] == "true"){
            if(isset($_GET['uname']) && $_GET['uname'] != ""){
                include("pages/singlemultexamresults.php");
            }else{
                include("pages/multexamresults.php");
                
            }
        }else{
            include("pages/uploadexamresults.php");        
        }
    }else{
        echo "No Exam Id is given";
   }
   }else{
        echo "No Class Id is given";
   }
?>