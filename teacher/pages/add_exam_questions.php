<?php
session_start();
if(isset($_SESSION['lecid'])){
        $lecid= $_SESSION['lecid'];
}else{
    header('Location: login.php');
}
?>

<?php
    include  'includes/config.php';
    $examid= $_GET['examid'];
    $res = mysqli_query($db, "select * from exams where id='$examid' ") or die(mysqli_error($db));
    $row = mysqli_fetch_array($res);
    $exam_date = $row['date'];
    $exam_name = $row['name'];
    $exam_desc = $row['description'];
    $exam_type = $row['type'];

    $qres = mysqli_query($db, "select * from questions where examid ='$examid' order by id asc")or die(mysqli_error($db));
    $qrows = mysqli_num_rows($qres);

    $uploadquestionsres = mysqli_query($db, "select * from questions_upload where examid ='$examid' order by id asc")or die(mysqli_error($db));
    $uploadquestionsrows = mysqli_num_rows($uploadquestionsres);  
       


?>

<?php include "includes/header2.php"?> 
<?php include "includes/config.php"?> 
<div class="breadcrumbs">
        <div class="col-12">
          <div class="page-header float-left">
            <div class="page-title pt-2">
              <h5>MANAGE EXAM</h5>
              
              <p>Add Question for <strong><?php echo $exam_name ?> </strong></p>
              
            </div>
          </div>
        </div>
      </div>

      <div class="content mt-3">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">

                <!-- Examination Info -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header"><strong>EXAM INFORMATION</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="company" class=" form-control-label">Exam Name</label>
                                    <input disabled type="text" value="<?php echo $exam_name ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="vat" class=" form-control-label">Exam Date</label>
                                    <input disabled type="text" value="<?php echo $exam_date ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="vat" class=" form-control-label">Exam Description</label>
                                    <textarea disabled type="text"  class="form-control"><?php echo $exam_desc ?></textarea>
                                </div>                              
                            </div>                                
                        </div>                                
                    </div>
                <!-- End Examination Info -->

                <!-- Examination Questions -->
                    <div class="col-lg-8">
                        <div class="card">
                        
                            <div class="card-header">
                                <div class="row">
                                    <div class=" col col-8">
                                        <strong>EXAM QUESTIONS</strong>
                                        <?php if($exam_type == "multiple"){ ?>
                                        <span class="badge badge-primary ml-3"><?php echo $qrows?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col col-2">
                                        <?php if($exam_type == 'multiple'): ?>
                                            <button data-toggle="modal" data-target="#modalForAddQuestion" class="btn btn-primary">Add Question</button>  
                                        <?php else:?>                                      
                                            <?php if($uploadquestionsrows > 0): ?>                                      
                                                <button data-toggle="modal" disabled data-target="#uploadexam" class="btn btn-primary">Upload Questions</button>
                                            <?php else:?>
                                                <button data-toggle="modal" data-target="#uploadexam" class="btn btn-primary">Upload Questions</button>
                                            <?php endif?>
                                        <?php endif?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card-block">
                            <?php if($exam_type == 'multiple'): ?>
                                <?php 
                                    if($qrows == 0){
                                    ?>
                                        <h3>No questions yet !</h3>
                                        <?php
                                    }else{
                                        ?>
                                        <ul class="list-group">
                                            <?php while($qrow = mysqli_fetch_assoc($qres)){ ?>                                            
                                                <li class="list-group-item disabled">
                                                    <h5><?php echo $qrow['question_no'] ?>.) <?php echo $qrow['question'] ?></h5>
                                                    <p style="margin-left:20px;">a. <?php echo $qrow['option1'] ?></p>
                                                    <p style="margin-left:20px;">b. <?php echo $qrow['option2'] ?></p>
                                                    <p style="margin-left:20px;">c. <?php echo $qrow['option3'] ?></p>
                                                    <p style="margin-left:20px;">d. <?php echo $qrow['option4'] ?></p>
                                                </li>
                                            <?php } ?>
                                        </ul>

                                        <?php
                                    }
                                ?>  
                                <?php else:?>
                                <?php
                                      
                                    if($uploadquestionsrows==0){
                                ?>
                                    <h3>No questions uploaded yet</h3>
                                    <?php }else{
                                        $uploadedexam = mysqli_fetch_array($uploadquestionsres);
                                        ?> 
                                        <h2>Exam File Uploaded</h2>
                                        <div class="jumbotron" style="padding:20px;margin-top:20px">
                                        <a style="text-decoration:underline" target="_blank" href="../uploads/<?php echo $uploadedexam['file']?>" > <?php echo $uploadedexam['file'] ?></a>
                                        <h6 class="mt-2">Instructions</h6>
                                        <p><?php echo $uploadedexam['instructions'] ?></p>
                                        </div>
                                    <?}?>
                                <?php endif?>                              
                            </div>                                
                        </div>                                
                    </div>
                <!-- End Examination Questions -->


                </div>
              </div>
              <!-- .card -->
            </div>
          </div>
        </div>
      </div>

<?php
if(isset($_POST['addquestionsubmit'])){
    $loop=0;
    $count = 0;
    $res = mysqli_query($db, "select * from questions where examid ='$examid' order by id asc") or die(mysqli_error($db));
    $count = mysqli_num_rows($res);  

    if($count=0){
       
        ?>
            <script type="text/javascript">
                document.getElementById('failure').style.display="block";
                document.getElementById('success').style.display="block";
            </script>
        <?php
    }else{
        while($row = mysqli_fetch_array($res)){
            $loop +=1;
            mysqli_query($db,"update quetions set question_no = '$loop' where id='$row[id]' "); 
        }
    }
    $loop+=1;
    mysqli_query($db, "INSERT INTO questions VALUES (NULL, '$loop','$_POST[question]','$_POST[choice_A]','$_POST[choice_B]','$_POST[choice_C]','$_POST[choice_D]','$_POST[correctAnswer]','$examid') ") or die(mysqli_error($db));

    ?>
        <script type="text/javascript">
            alert("Question added successfully")
            window.location.href = window.location.href;
        </script>
    <?php

}
?>

<?php
    if(isset($_POST['examuploadsubmit'])){
      $examfilename = $_FILES['examfile']['name'];
      $examinstructions =$_POST['examinstructions'];
      $examdestination = '../uploads/' . $examfilename;
        // get the file extension
      $extension = pathinfo($examfilename, PATHINFO_EXTENSION);

      // the physical file on a temporary uploads directory on the server
      $file = $_FILES['examfile']['tmp_name'];
      $size = $_FILES['examfile']['size'];

      if (!in_array($extension, ['pdf', 'docx'])) {
          echo "<script>alert('You file extension must be .pdf or .docx')</script>";
      } else {
          // move the uploaded (temporary) file to the specified destination
          if (move_uploaded_file($file, $examdestination)) {
              $sql = "INSERT INTO questions_upload (file, instructions,classid,examid) VALUES ('$examfilename', '$examinstructions','$_GET[classid]','$_GET[examid]')";
              $queried = mysqli_query($db, $sql) or die(mysqli_error($db));
              if ($queried) {
//                   ?>
                     <script type="text/javascript">
                        alert("Exam Uploaded Successfully...");
                    </script>   
                 <?php
              }
          } else {
              ?>
                    <script type="text/javascript">
                        alert("Failed to Upload file...try again later");
                    </script>   
                 <?php
          }
      }
  }
?>

<?php include("includes/modals.php"); ?>
<?php include "includes/footer.php"?> 


