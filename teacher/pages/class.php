<?php
   $classid = $_GET['classid'];    

?>

<?php include "includes/header2.php"?> 
<?php include "includes/config.php"?> 
<div class="breadcrumbs">
        <div class="col-sm-4">
          <div class="page-header float-left">
            <div class="page-title">
            <?php
                $cres = mysqli_query($db, "select * from classes where id = '$classid'");
                $crow = mysqli_fetch_array($cres);
            ?>
              <h1 class="text-primary h1"><strong><?php echo $crow['name'] ?></strong></h1>
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
                    <!-- Add Exam Catogory -->
                    <form action="" method="post">
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header"><strong>Add Exam</strong></div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="vat" class=" form-control-label">Exam Title</label>
                                        <input required type="text" placeholder="Exam Title" name="examtitle" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="vat" class=" form-control-label">Exam Time In Minutes</label>
                                        <input required type="text" placeholder="Exam Time In Minutes" name="examtime" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="vat" class=" form-control-label">Exam Description</label>
                                        <textarea required type="text" placeholder="Exam Description" rows="5" name="examdescription" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input 
                                        type="submit" 
                                        name="add-exam-submit" class="btn btn-success" value="Add Exam">
                                    </div>                                
                                </div>                                
                            </div>                                
                        </div>
                    </form>
                    <!-- End Add Exam Catogory -->

                    <!-- Table -->
                    <div class="col-lg-7">
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
                                            <th scope="col">Exam Time</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count=0;
                                            $res = mysqli_query($db,"select * from exam_category where classid = '$classid' ") or die(mysqli_error($db));
                                            while( $row= mysqli_fetch_array($res)){
                                                $count+=1;?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['time']; ?></td>
                                                    <td><a href="exam_edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                                                    <td><a href="exam_delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->
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
                                            $res = mysqli_query($db,"select * from revisionmaterials") or die(mysqli_error($db));
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
    if(isset($_POST['add-exam-submit'])){
        mysqli_query($db, "insert into exam_category values(NULL, '$_POST[examtime]', '$_POST[examtitle]', '$_POST[examdescription]','$classid')") or die(mysqli_error($db));
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
        $sql = "SELECT * FROM files";
        $result = mysqli_query($conn, $sql);

        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
              $sql = "INSERT INTO revisionmaterials (file, description,classid) VALUES ('$filename', '$description','$_GET[classid]')";
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