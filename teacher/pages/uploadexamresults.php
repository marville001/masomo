<?php
   $classid = $_GET['classid'];    

?>

<?php include "includes/header2.php"?> 
<?php include "includes/config.php"?> 
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Exam Upload Results</strong></div>
                    <!-- CArd Body -->
                    <div class="card-body">
                        <!-- Add Exam Catogory -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Exam Title</th>
                                    <th scope="col">Student Username</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count=0;
                                    $res = mysqli_query($db,"select * from answers_upload where classid = '$classid' ") or die(mysqli_error($db));
                                    $rows = mysqli_num_rows($res);
                                    if($rows <=0 ){ ?>
                                        <tr>
                                            <td colspan=5><h5>No answer uploaded yet</h5></td>
                                        </tr>
                                    <?php
                                    }
                                    while( $row= mysqli_fetch_array($res)){
                                        $count+=1;
                                        $ares = mysqli_query($db,"select * from questions_upload where examid = $row[exam_id]; ") or die(mysqli_error($db));
                                        $arow= mysqli_fetch_array($ares);
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><a href="../answeruploads/<?php echo $row['file'] ?>">Download</a></td>
                                            <td><?php echo $row['uname']; ?></td>
                                            <td><?php echo $row['time']; ?></td>
                                            <td><?php if($row['score']== null){echo "Unmarked";}else{echo $row['score'];} ?></td>
                                            <td><button class="btn btn-success" data-toggle="modal" data-target="#exammark"><?php if($row['score']== null){echo "Mark";}else{echo "Remark";}?></button></td>
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

<?php
    if(isset($_POST['exammarkssubmit'])){
        $examscore =$_POST['examresultscore'];
        $examcomment =$_POST['examresultcomment'];

        $sql = "UPDATE answers_upload SET score='$examscore',teachers_comment='$examcomment' WHERE exam_id = $_GET[examid]";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if ($res) {
//      ?>
            <script type="text/javascript">
                alert("Marks added Successfully...");
            </script>   
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Failed to add marks...try again later");
            </script>   
        <?php
        }
    }
?>

<?php include "includes/modals.php"?> 
<?php include "includes/footer.php"?> 