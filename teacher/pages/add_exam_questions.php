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
   if(isset($_GET['examid'])){
          $examid= $_GET['examid'];
        $res = mysqli_query($db, "select * from exam_category where id='$examid' ") or die(mysqli_error($db));
        while($row = mysqli_fetch_array($res)){
            $exam_time = $row['time'];
            $exam_title = $row['title'];
            $exam_desc = $row['description'];
        } 
   }else{
        ?>
        <script>
            alert("No exam id passed");
            window.location.href = 'exam_manage.php'
        </script>
      <?php
   }


?>

<?php include "includes/header2.php"?> 
<?php include "includes/config.php"?> 
<div class="breadcrumbs">
        <div class="col-sm-4">
          <div class="page-header float-left">
            <div class="page-title pt-2">
              <h5>MANAGE EXAM</h5>
              <p>Add Question for <strong><?php echo $exam_title ?> </strong></p>
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
                                    <input disabled type="text" value="<?php echo $exam_title ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="vat" class=" form-control-label">Exam Time In Minutes</label>
                                    <input disabled type="text" value="<?php echo $exam_time ?>" class="form-control">
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
                        <?php
                            $qres = mysqli_query($db, "select * from questions where examid ='$examid' order by id asc")or die(mysqli_error($db));
                            $qrows = mysqli_num_rows($qres);
                            ?>
                            <div class="card-header">
                                <div class="row">
                                    <div class=" col col-9">
                                        <strong>EXAM QUESTIONS</strong><span class="badge badge-primary ml-3"><?php echo $qrows?></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Add Question
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button data-toggle="modal" data-target="#modalForAddQuestion" class="btn btn-primary dropdown-item">Multiple Question</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card-block">
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

<?php include("includes/modals.php"); ?>
<?php include "includes/footer.php"?> 


