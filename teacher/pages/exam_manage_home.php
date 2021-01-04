<?php 
session_start();
include "includes/header2.php";
include "includes/config.php";
?> 
<div class="breadcrumbs">
        <div class="col-sm-12">
          <div class="page-header float-left">
            <div class="page-title">
              <h1>Select Exam to Edit Quetions</h1>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Exam Name</th>
                                <th scope="col">Exam Time</th>
                                <th scope="col">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count=0;
                                $res = mysqli_query($db,"select * from exam_category where classid = '$_SESSION[classid]'") or die(mysqli_error($db));
                                while( $row= mysqli_fetch_array($res)){
                                    $count+=1;?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['time']; ?></td>
                                        <td><a href="../teacher/exam_manage.php?page=quiz&examid=<?php echo $row['id']; ?>">Select</a></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
              </div>
              <!-- .card -->
            </div>
          </div>
        </div>
      </div>

<?php include "includes/footer.php"?> 