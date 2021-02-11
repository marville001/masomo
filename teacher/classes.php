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
        $cres = mysqli_query($db, "select * from classes where id = '$_GET[classid]' && lecid = '$_SESSION[lecid]' ");
        $crows = mysqli_num_rows($cres);

        if($crows>0){              
            include("pages/class.php");
        }else{
            include("pages/no_class.php"); 
        }
   }else{
    header('Location: index.php');
   }


?>