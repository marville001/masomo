<?php
   $classid = $_GET['classid'];    
   $examid = $_GET['examid'];    

?>

<?php include "includes/header2.php"?> 
<?php include "includes/config.php"?> 
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php
                        $multexamres = mysqli_query($db,"select * from exam_category where classid= '$classid' and id = '$examid' ");
                        $multexamarray = mysqli_fetch_array($multexamres);
                    ?>
                    <div class="card-header"><strong><?php echo $multexamarray['title'] ?> Results</strong></div>
                    <!-- CArd Body -->
                    <div class="card-body">
                        <!-- Add Exam Catogory -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count=0;
                                    $quizres = mysqli_query($db,"select * from questions where examid = '$examid' ") or die(mysqli_error($db));
                                    $quizrows = mysqli_num_rows($quizres);
                                    

                                    $res = mysqli_query($db,"select DISTINCT uname from answers where exam_id = '$examid' ") or die(mysqli_error($db));
                                    
                                    while( $row= mysqli_fetch_assoc($res)){
                                        $count +=1;
                                        $studentres = mysqli_query($db,"select * from students where username='$row[uname]' ") or die(mysqli_error($db));
                                        
                                        $studentarray = mysqli_fetch_array($studentres);
                                        $answerres = mysqli_query($db,"select * from answers where exam_id = '$examid' and uname='$row[uname]' and correct=1") or die(mysqli_error($db));
                                        $answerzrows = mysqli_num_rows($answerres);

                                        ?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $studentarray['firstname']. " " . $studentarray['lastname']?></td>
                                            <td><?php echo $answerzrows. " / " . $quizrows ?></td>
                                            <td><a href="results.php?classid=<?php echo $classid; ?>&examid=<?php echo $examid; ?>&mult=true&uname=<?php echo $row['uname']; ?>">View</a></td>
                                        </tr>
                                    <?php 
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        <!-- End Add Exam Catogory -->
                    </div>
                    <!-- End Card Body -->                
                </div>
                <!-- .card -->
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"?> 