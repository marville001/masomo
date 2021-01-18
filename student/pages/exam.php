<?php
    $jcres = mysqli_query($db, "select * from joinedclasses where classid=$_GET[classid] AND suname = '$suname'");
    $jcrows = mysqli_num_rows($jcres); 

    // Exams
    $examsres = mysqli_query($db, "select * from exams where classid = '$_GET[classid]' and id = '$_GET[examid]'");
    $examsrows = mysqli_num_rows($examsres);
    $examsarray = mysqli_fetch_array($examsres);

    $now = strtotime(date('Y-m-d'));
    $duedate=strtotime($examsarray['date']);

    $diff_hours = ($duedate- $now)/3600;
    $diff_days = $diff_hours/24;
?>

<div class="home-content">
    <?php if($jcrows <=0 ): ?>
        <div class="exams-title">
            <h3>No Class Found</h3>
        </div>
    <?php else:?>
        <?php if($examsrows == 0):?>
            <div class="exams-title">
                <h3>No Exam Found</h3>
            </div>
        <?php else:?>
            <?php
                $jclass = mysqli_fetch_array($jcres);
                $classresult = mysqli_query($db, "select * from classes where id=$jclass[classid]");
                $class= mysqli_fetch_array($classresult);

                $quizresult = mysqli_query($db, "select * from questions_upload where classid=$_GET[classid] and examid=$_GET[examid]");
                $quiz= mysqli_fetch_array($quizresult);
            ?>
            <div class="results-title">
                <h1 class="text-success"><?php echo $class['name'] ?></h1>
                <h6>Exam Name :<strong><?php echo $examsarray['name'] ?></strong></h6>
                <h6>Date :<strong><?php echo $examsarray['date'] ?></strong></h6>
            </div>
            <div class="wrapper">
                <h5 class="my-3 text-primary">Exam Description</h5>
                <p class="px-5"><?php echo $examsarray['description'] ?></p>  
                <hr>
                <?php if($diff_days == 0):?>
                    <?php if($examsarray['type'] == "upload"):?>        
                        <div class="p-3">
                            <a href="/masomo/uploads/<?php echo $quiz['file'] ?>" class="btn btn-outline-success">Download File</a>
                            <p class="mt-2  ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae et commodi.</p>
                        </div>    
                        <div class="jumbotron m-2 p-4">
                            <?php
                                $answwercheckresult = mysqli_query($db, "select * from answers_upload where uname='$suname' and classid=$_GET[classid] and exam_id=$_GET[examid]");
                                $answwercheckrows = mysqli_num_rows($answwercheckresult);
                                if($answwercheckrows < 1):
                            ?>
                                <button data-toggle="modal" data-target="#submitExamModal" class="btn btn-primary">Submit Answers</button>
                            <?php else:?>
                            <?php
                                $answwercheckarray = mysqli_fetch_array($answwercheckresult);                            
                            ?>
                            <h4>Answers submitted</h4>
                            <h6>Date : <?php echo $answwercheckarray['time'] ?></h6>
                            <h4>Score : 
                                <span class="text-success">
                                    <?php 
                                        if($answwercheckarray['score'] != null){
                                            echo $answwercheckarray['score'];
                                        }else{
                                            echo "No score yet";
                                        } 
                                    ?>
                                </span>
                            </h4>
                            <h4 class="mt-4">Teachers Comment</h4>
                            <p>
                                <span class="text-dark">
                                <?php 
                                    if($answwercheckarray['teachers_comment'] != null){
                                        echo "<i>\"".$answwercheckarray['teachers_comment']."\"</i>";
                                    }else{
                                        echo "No Comment yet";
                                    } 
                                    ?>
                                </span>
                            </p>
                        </div>  
                        <?php endif?>
                    <?php else:
                        $multquizres = mysqli_query($db, "select * from questions where examid=$_GET[examid]");
                        $multquizrows = mysqli_num_rows($multquizres);    
                    ?>
                        <h6>There are <? echo $multquizrows ?> questions in this test</h6>
                        <button class="btn btn-outline-success my-3">Start  Exam</button>
                    <?php endif?>
                 

                    
                <?php elseif($diff_days < 0):?>
                    <h3>Timed Out</h3>              
                <?php else:?>
                    <h3 >The exam will be in <? echo $diff_days?> days</h3>              
                <?php endif?>              
            </div>
        <?php endif ?>
    <?php endif ?>
</div>


<?php
    if(isset($_POST['submitExamAnswers'])){
      $examanswersname = $_FILES['examanswers']['name'];
      $examanswersdestination = '../answeruploads/' . $examanswersname;
        // get the file extension
      $extension = pathinfo($examanswersname, PATHINFO_EXTENSION);

      // the physical file on a temporary uploads directory on the server
      $file = $_FILES['examanswers']['tmp_name'];
      $size = $_FILES['examanswers']['size'];

      $date = date("Y-m-d");

      if (!in_array($extension, ['pdf', 'docx'])) {
          echo "<script>alert('You file extension must be .pdf or .docx')</script>";
      } else {
          // move the uploaded (temporary) file to the specified destination
          if (move_uploaded_file($file, $examanswersdestination)) {
              $sql = "INSERT INTO answers_upload (exam_id,file, uname,classid,time) VALUES ('$_GET[examid]', '$examanswersname','$suname','$_GET[classid]','$date')";
              $queried = mysqli_query($db, $sql) or die(mysqli_error($db));
              if ($queried) {
//                   ?>
                     <script type="text/javascript">
                        alert("Answers Uploaded Successfully...");
                        window.location.href = window.location.href;
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