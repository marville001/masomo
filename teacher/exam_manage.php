<?php
   if(isset($_GET['page'])){
     @$page = $_GET['page'];     
     if($page == "home"){
       include("pages/exam_manage_home.php");
     }
     else if($page == "quiz")
     {
       include("pages/add_exam_questions.php");
     }     
   }else{
     include("pages/exam_manage_home.php"); 
   }


?>