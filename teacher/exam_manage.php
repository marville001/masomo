<?php
   if(isset($_GET['classid'])){
    if(isset($_GET['examid'])){      
        include("pages/add_exam_questions.php");    
      }else{
        echo "No exam id was passed";
    }
   }else{
     Header("Location: classes.php"); 
   }


?>