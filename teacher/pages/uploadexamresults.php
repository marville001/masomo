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
                                    <th scope="col">Exam File</th>
                                    <th scope="col">Total Attempts</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count=0;
                                    $res = mysqli_query($db,"select * from exam_upload_answers where classid = '$classid' ") or die(mysqli_error($db));
                                    $rows = mysqli_num_rows($res);
                                    while( $row= mysqli_fetch_array($res)){
                                        $count+=1;
                                        $ares = mysqli_query($db,"select * from exam_upload where id = $row[exam_id]; ") or die(mysqli_error($db));
                                        $arow= mysqli_fetch_array($ares)
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $arow['title']; ?></td>
                                            <td><a href="../uploads/<?php echo $row['file'] ?>">Download</a></td>
                                            <td><?php echo $rows; ?></td>
                                            <td><a href="results.php?classid=<?php echo $classid; ?>&examid=<?php echo $row['id']; ?>">View</a></td>
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