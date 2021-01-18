<?php include 'includes/config.php'; ?>
<?php include 'includes/header2.php'; ?>

<?php
    session_start();
    $suname = $_SESSION['username'];
    $examid = $_GET["examid"];
    $examresult = mysqli_query($db, "select * from exams where id=$examid");
    $examrows = mysqli_num_rows($examresult); 
    $exams= mysqli_fetch_array($examresult);

    $classresult = mysqli_query($db, "select * from classes where id=$_GET[classid]");
    $class= mysqli_fetch_array($classresult);
    $quizno = 0;
     if(isset($_GET['quizno'])){
        $quizno = $_GET['quizno'];
        if($quizno > 1){
            $prevno = $quizno - 1;
        }
        $quizres = mysqli_query($db, "select * from questions where examid = $examid and question_no = $quizno");
        $quizesrow = mysqli_num_rows(mysqli_query($db, "select * from questions where examid = $examid"));
        $quiz = mysqli_fetch_array($quizres);
    }
?>

<?php
// check whether exam is already done
    $eres = mysqli_query($db, "select * from examsession where exam_id = '$examid' and uname = '$suname'");
    $erows = mysqli_num_rows($eres); 
    if ($erows>0) {
        ?>
            <script type="text/javascript">
                alert("Seems you have already done the exam...visit the result page to see your result")
                window.location.href = window.location.href.split("&examid")[0];
            </script>
        <?php
    }
?>

<?php
// check whether question is answered
    $answerresult = mysqli_query($db, "select * from answers where exam_id = '$examid' and quiz_no = '$quizno' and uname = '$suname'");
    $answerrows = mysqli_num_rows($answerresult); 
    if ($answerrows>0) {
        if ($quiz["question_no"] < $quizesrow) {
            ?>
                <script type="text/javascript">
                    alert("Question already done..")
                    let path = window.location.pathname;
                    let searchArray = window.location.search.split("quizno=");
                    let quizno = (parseInt(searchArray[1]))+1
                    window.location.href = path+searchArray[0]+"quizno="+quizno;
                </script>
            <?php
        } else {
            ?>
                <script type="text/javascript">
                    alert("Question already done.. click view classes")
                    window.location.href = "classes.php";
                </script>
            <?php
        }
    }
?>

<div class="timer">
    <h3><?php echo $exams["name"]?></h3>
</div>
<div class="exam-container">
    <?php
        if(!isset($_GET["quizno"])):        
    ?>
        <div class="exam-content">
            <h3>The exam has a total of 20 questions</h3>
            <a href="examsession.php?classid=<?php echo $_GET["classid"]?>&examid=<?php echo $exams["id"]?>&quizno=1" class="btn btn-outline-success m-5">Start Answering</a>
        </div>
    <?php 
        else:
    ?>
            <div class="exam-content">
                <h3><span class="quizcounter">(<?php echo $quiz["question_no"]?> of <?php echo $quizesrow?>)</span><?php echo $quiz["question"]?></h3>
                <form class="answers" action="" method="post">
                    <input type="radio" name="answer" id="" value="<?php echo $quiz["option1"]?>"><?php echo $quiz["option1"]?> <br>
                    <input type="radio" name="answer" id="" value="<?php echo $quiz["option2"]?>"><?php echo $quiz["option2"]?> <br>
                    <input type="radio" name="answer" id="" value="<?php echo $quiz["option3"]?>"><?php echo $quiz["option3"]?> <br>
                    <input type="radio" name="answer" id="" value="<?php echo $quiz["option4"]?>"><?php echo $quiz["option4"]?><br>

                    <div style="display:flex;justify-content:space-between;padding:30px 0px">
                        <?php if(isset($prevno)): ?>
                            <a href="classes.php?classid=<?php echo $_GET["classid"]?>&examid=<?php echo $exams["id"]?>&quizno=<?echo $prevno?>" class="btn btn-outline-success">Previous</a>
                        <?php endif ?>                        
                        <button name="nextsubmit" class="btn btn-outline-primary"><?if ($quiz["question_no"] < $quizesrow) {
                            echo "Next";
                        } else {
                            echo "Finish";
                        }
                        ?></button>
                    </div>
                </form>
                <?php if ($quiz["question_no"] < $quizesrow) {
                    echo "<p class=\"text-center\">Note that once you click next you cannot change your answer</p>";
                } else {
                    echo "<p class=\"text-center\">Thank you for attempting all the questions..To complete click finish</p>";
                }
                ?>
                
            </div>
    <?php endif ?>
    
</div>

<?php
    if(isset($_POST['nextsubmit'])&& !empty($_POST['answer'])){  
        $answer = $_POST['answer'];
        $correct = 0;
        if ($answer == $quiz["answer"]) {
            $correct = 1;
        } else {
            $correct = 0;
        }
        
        mysqli_query($db, "INSERT INTO answers VALUES (NULL, '$examid','$quizno','$suname','$answer','$correct') ") or die(mysqli_error($db));
        if ($quiz["question_no"] < $quizesrow) {
            ?>
                <script type="text/javascript">
                    let path = window.location.pathname;
                    let searchArray = window.location.search.split("quizno=");
                    let quizno = (parseInt(searchArray[1]))+1
                    window.location.href = path+searchArray[0]+"quizno="+quizno;
                </script>
            <?php
        } else {
            mysqli_query($db, "INSERT INTO examsession VALUES (NULL,'$suname', '$examid','done') ") or die(mysqli_error($db));
            ?>
                <script type="text/javascript">
                    window.location.href = "results.php";
                </script>
            <?php
        }
    }
?>