<?php include 'includes/header2.php'; ?>

<?php
   $suname = $_SESSION['username'];
   $jcres = mysqli_query($db, "select * from joinedclasses where classid=$_GET[classid] AND suname = '$suname'");
   $jcrows = mysqli_num_rows($jcres); 
   $class= mysqli_fetch_array($jcres);

   $classresult = mysqli_query($db, "select * from classes where id=$class[classid]");
   $class= mysqli_fetch_array($classresult);
   
   $lecres = mysqli_query($db, "select * from teachers where id = '$class[lecid]'");
   $leccarray = mysqli_fetch_array($lecres);

   $uexamres = mysqli_query($db, "select * from exam_category where classid = $_GET[classid]");
   $uexamrows = mysqli_num_rows($uexamres);
   $examarray = mysqli_fetch_array($uexamres);
?>

<div style="margin: 0px; padding:0px; margin-bottom: 50px;">
    <?php if($jcrows<=0){?>
        <div > <h1 class="text-center mt-5"> No class found </h1></div>
    <?php  } else {?>
        <div class="row p-3">
            <div class="col">
                <h3><?php echo $class["name"];?></h3>
                <h5>Lecturer : <?php echo $leccarray["name"];?></h5>
            </div>               
        </div>
        <div class="row p-3">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header bg-success text-white"><strong> <?php echo $examarray["title"];?></strong></div>
                    <div class="card-body">
                        <p><strong>Description: </strong> <?php echo $examarray["description"];?></p>
                        <h5><strong>Score: </strong><span class="text-success"> 20/39</score></h5>

                        
                        <div class="teachers-comment">
                            <h6>Teachers Comment</h6>
                            <p>"<i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est reiciendis a et!</i>"</p>
                        </div>
                    </div>
                </div>
            </div>               
        </div>
    <?php  } ?>
</div>

<!-- Modal To Upload Exam Answer-->
<div class="modal fade" id="uploadexamanswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Exam Answer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="col-md-12">
        <p>Your answer can be in pdf of docs format</p>
          <div class="form-group">
            <label>Exam Answer File</label>
            <input required type="file" name="examanswerfile" style="height:60px;padding:12px; 20px"  class="form-control">
          </div>          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="examansweruploadsubmit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>        

<?php
    if(isset($_POST['examansweruploadsubmit'])){
        if($checkows>0){
            echo "<script>alert('You cannot upload twice...";
        }else{
            $datetime = date("Y-m-d h:i:s");
            $examfilename = $_FILES['examanswerfile']['name'];
            $examanswerdestination = '../answeruploads/' . $examfilename;
                // get the file extension
            $extension = pathinfo($examfilename, PATHINFO_EXTENSION);

            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['examanswerfile']['tmp_name'];
            $size = $_FILES['examanswerfile']['size'];

            if (!in_array($extension, ['pdf', 'docx'])) {
                echo "<script>alert('You file extension must be .pdf or .docx')</script>";
            } else {
                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($file, $examanswerdestination)) {
                    $sql = "INSERT INTO exam_upload_answers (exam_id,file, uname,classid,time) VALUES ('$_GET[examid]','$examfilename','$suname','$_GET[classid]','$datetime')";
                    $queried = mysqli_query($db, $sql) or die(mysqli_error($db));
                    if ($queried) {
                        ?>
                            <script type="text/javascript">
                                alert("Exam Answer Uploaded Successfully...");
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
  }
?>

<?php include "includes/footer.php" ?>