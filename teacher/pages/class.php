<?php
   $classid = $_GET['classid'];    

?>

<?php include "includes/header2.php"?> 
<?php include "includes/config.php"?> 
<div class="breadcrumbs">
        <div class="col-sm-4">
          <div class="page-header">
            <div class="page-title">
            <?php
                $cres = mysqli_query($db, "select * from classes where id = '$classid'");
                $crow = mysqli_fetch_array($cres);
            ?>
              <h1 class="text-primary h1"><strong><?php echo $crow['name'] ?></strong></h1>
              <h6 style="margin:10px 0px">Joining Code : <?php echo $crow['joincode'] ?></h6>
            </div>
          </div>
        </div>
      </div>
      <div class="content mt-3">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">

              <!-- CArd Body -->
                <div class="card-body">
                    <div class="col-12 my-3" style="display:flex;justify-content:flex-end;">
                        <button class="btn btn-outline-success m-1" data-toggle="modal" data-target="#addexammodal">Add Exam</button>                         
                        <!-- <button class="btn btn-outline-success m-1" data-toggle="modal" data-target="#uploadexam">Upload Exam</button>  -->
                     </div>   

                    <!-- Table -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">All Exams</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Exam Title</th>
                                            <th scope="col">Exam Date</th>
                                            <th scope="col">Exam Description</th>
                                            <th scope="col">Attempts</th>
                                            <th colspan=3 scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count=0;
                                            $res = mysqli_query($db,"select * from exams where classid = '$classid' ") or die(mysqli_error($db));
                                            
                                            while( $row= mysqli_fetch_array($res)){
                                                $count+=1;?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <?php
                                                        if($row["type"]=="multiple"):
                                                            $answerresults = mysqli_query($db,"select distinct uname from answers where exam_id = '$row[id]' ") or die(mysqli_error($db));
                                                            $answersrows = mysqli_num_rows($answerresults); 
                                                    ?>
                                                            <td><?php echo $answersrows; if($answersrows >= 1){?><a class="ml-2 text-primary" href="results.php?classid=<?php echo $classid?>&examid=<?php echo $row['id'] ?>&mult=true">View</a> <?php } ?></td>
                                                        <?php else: 
                                                                $uploadanswerresult =  mysqli_query($db,"select uname from answers_upload where exam_id = '$row[id]' ") or die(mysqli_error($db));
                                                                $uploadanswersrows = mysqli_num_rows($answerresults); 
                                                            
                                                            ?>
                                                            <td><?php echo $uploadanswersrows; if($uploadanswersrows >= 1){?><a class="ml-2 text-primary" href="results.php?classid=<?php echo $classid?>&examid=<?php echo $row['id'] ?>&mult=false">View</a> <?php } ?></td>
                                                        <?php endif ?>
                                                    <td><a href="exam_edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                                                    <td><a href="exam_delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                                                    <td><a href="exam_manage.php?classid=<?php echo $_GET['classid']; ?>&examid=<?php echo $row['id']; ?>">View</a></td>
                                                </tr>
                                            <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->



                    <!-- Revision Material Table -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Revision Materials</strong></div>
                            <div class="card-body card-block p-3">  
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count=0;
                                            $res = mysqli_query($db,"select * from revisionmaterials where classid = $_GET[classid]") or die(mysqli_error($db));
                                            while( $row= mysqli_fetch_array($res)){
                                                $count+=1;?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['file']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><a href="../uploads/<?php echo $row['file'] ?>">Download</a></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>                                      
                                <div class="upload-section">
                                    <button class="btn btn-outline-success m-1" data-toggle="modal" data-target="#modalToupload">Upload Revision Material</button>  
                                </div>                            
                            </div>                                
                        </div>                                                   
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
    if(isset($_POST['addexamsubmit'])){
        mysqli_query($db, "insert into exams (`date`, `name`, `description`,`type`, `classid`)  values('$_POST[examdate]', '$_POST[examname]', '$_POST[examdescription]','$_POST[examtype]','$classid')") or die(mysqli_error($db));
        ?>
            <script type="text/javascript">
                alert("Exam Added Successfully...");
                window.location.href = window.location.href;
            </script>   
        <?php
    }
?>
<?php
    if(isset($_POST['uploadSubmit'])){
      $filename = $_FILES['file']['name'];
      $description =$_POST['filedescription'];
      $destination = '../uploads/' . $filename;
        // get the file extension
      $extension = pathinfo($filename, PATHINFO_EXTENSION);

      // the physical file on a temporary uploads directory on the server
      $file = $_FILES['file']['tmp_name'];
      $size = $_FILES['file']['size'];

      if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
          echo "You file extension must be .zip, .pdf or .docx";
      } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
          echo "File too large!";
      } else {
          // move the uploaded (temporary) file to the specified destination
          if (move_uploaded_file($file, $destination)) {
              $sql = "INSERT INTO revisionmaterials (file, description,classid,lecid) VALUES ('$filename', '$description','$_GET[classid]','$lecid')";
              $queried = mysqli_query($db, $sql) or die(mysqli_error($db));
              if ($queried) {
                  ?>
                    <script type="text/javascript">
                        alert("File Uploaded Successfully...");
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

<?php include "includes/footer.php"?> 
<?php include "includes/modals.php"?> 