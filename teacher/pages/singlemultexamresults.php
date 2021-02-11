<?php
   $classid = $_GET['classid'];    
   $examid = $_GET['examid'];    
   $uname = $_GET['uname']; 

   $quizres = mysqli_query($db,"select * from answers where exam_id = '$examid' ") or die(mysqli_error($db));
   $quizrows = mysqli_num_rows($quizres); 
   
   $studentres = mysqli_query($db,"select * from students where username='$uname' ") or die(mysqli_error($db));
   $studentarray = mysqli_fetch_array($studentres);

   $answerres = mysqli_query($db,"select * from answers where exam_id = '$examid' and uname='$uname' and correct=1") or die(mysqli_error($db));
   $answerzrows = mysqli_num_rows($answerres);

?>

<?php include "includes/header2.php"?> 
<?php include "includes/config.php"?> 
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php
                        $multexamres = mysqli_query($db,"select * from exams where classid= '$classid' and id = '$examid' ") or die(mysqli_error($db));
                        $multexamarray = mysqli_fetch_array($multexamres);
                    ?>
                    <div class="card-header"><h2><strong><?php echo $multexamarray['name'] ?> Results</strong></h2>
                    <!-- CArd Body -->
                    <div class="card-body bg-white my-2">
                        <div>
                            <h2>Student Name: <b><?php echo $studentarray['firstname']. " " . $studentarray['lastname']?></b></h2>
                            <h3 class="mb-1 mt-3">Score <span><strong><?php echo $answerzrows. " / " . $quizrows ?></strong></span></h3>

                            <?php
                                $multcommentres = mysqli_query($db,"select * from exam_mult_comments where uname = '$uname' and examid = '$examid' ") or die(mysqli_error($db));
                                $multcommentrows = mysqli_num_rows($multcommentres);
                                $multcommentarray = mysqli_fetch_array($multcommentres);
                                if($multcommentrows>0):
                            ?>
                                    <div style="display:inline-block;margin: 20px 0px;background-color: #eee;padding:20px"><span class="text-dark">Comment:</span> <i>"<?php echo $multcommentarray['comment']?>"</i></div>
                                <?php else: ?>
                                    <button class="btn btn-outline-success my-4" data-toggle="modal" data-target="#examcomment">Comment</button>
                                <?php endif ?>
                        </div>
                        
                        <h2 class="mx-4">Answers</h2>
                        <div class="p-3">
                        <?php
                            $answerres = mysqli_query($db,"select * from answers where exam_id = '$examid' and uname='$uname' ") or die(mysqli_error($db));
                            while($row = mysqli_fetch_assoc($answerres)):
                        ?>
                            <div class="mx-3 mt-2" style="display:flex;background-color: #eee;padding: 15px">
                                <?php
                                    $quizres = mysqli_query($db,"select * from questions where examid='$examid' and question_no = '$row[quiz_no]' ") or die(mysqli_error($db));
                                    $quizarray = mysqli_fetch_array($quizres);
                                ?>
                                <div>
                                    <h4 class="mb-2"><?php echo $quizarray['question'] ?></h4>
                                    <div style="margin: 5px 20px;">
                                        <p style="padding:0; margin:5px 0"><?php echo $quizarray['option1'] ?></p>
                                        <p style="padding:0; margin:5px 0"><?php echo $quizarray['option2'] ?></p>
                                        <p style="padding:0; margin:5px 0"><?php echo $quizarray['option3'] ?></p>
                                        <p style="padding:0; margin:5px 0"><?php echo $quizarray['option4'] ?></p>
                                    </div>
                                </div>
                                <div style="margin:30px 50px">
                                    <h6>Answer given : <strong><?php echo $row['answer'] ?></strong></h6>
                                    <?php if($row['correct']==1):?>
                                        <h2><span class="text-success">&check;</span></h2>
                                    <?php else: ?>
                                        <h2><span class="text-danger">&times;</span></h2>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endwhile ?>
                    </div>
                    </div>
                    <!-- End Card Body -->                
                </div>
                <!-- .card -->
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['examcommentsubmit'])){
        mysqli_query($db, "insert into exam_mult_comments (`comment`, `examid`, `uname`) values('$_POST[resultcomment]', '$examid','$uname')") or die(mysqli_error($db));
        ?>
            <script type="text/javascript">
                alert("Comment Added Successfully...");
                window.location.href = window.location.href;
            </script>   
        <?php
    }
?>


<?php include "includes/modals.php"?> 
<?php include "includes/footer.php"?> 