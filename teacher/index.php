<?php
session_start();
if(isset($_SESSION['lecid'])){
        $lecid= $_SESSION['lecid'];
}else{
    header('Location: login.php');
}
?>

<?php 
include "includes/header.php"; 
include "includes/config.php";
?> 

<div class="breadcrumbs">
        <div class="col-sm-12">
          <div class="page-header fdloat-left">
            <div class="page-title" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
              <h1>My Classes</h1>
              <button class="btn btn-outline-primary mt-0" data-toggle="modal" data-target="#modalToCreate">Create Class</button>
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
                        <?php 
                        $result = mysqli_query($db, "SELECT * FROM classes WHERE lecid = $lecid ");
                        $rows  = mysqli_num_rows($result);

                        if($rows == 0){?>
                            <p>No classes yet Create class</p>
                            
                            <button class="btn btn-outline-primary mt-0" data-toggle="modal" data-target="#modalToCreate">Create Class</button>
                        <?php } else{?>                    
                            <div class="row mt-5">   
                                <?php                  
                                    while($row = mysqli_fetch_assoc($result)){?>      
                                            <div class="col col-sm-12 col-md-12 col-lg-4">
                                                <div class="card m-3">
                                                <div class="card-header bg-success p-4">
                                                    <h4 class="card-title text-white"><?php  echo $row['name'];?></h4>
                                                </div>
                                                    <div class="card-body" style="min-height:70px">
                                                        <p class="card-text"><?php  echo $row['description'];?></p>
                                                    </div>
                                                    <div class="card-footer p-0" style="display:flex;height:50px;align-items:center">
                                                        <a href="classes.php?classid=<?php echo $row['id'];?>" style="display:block;width:80%;height:100%;color:#000;text-align:center;padding:10px 0 0 0;">See More</a>
                                                        <img style="width:20px;margin-left:auto;margin-right:10px;cursor:pointer;" src="img/menu.png" alt="Menu" />
                                                    </div>
                                                </div>
                                            </div>
                                <?php } }?>      
                            </div>
                </div>
              </div>
              <!-- .card -->
            </div>
          </div>
        </div>
      </div>


<?php
  if(isset($_POST['addClassSubmit'])){ 
    $joincode = uniqid();     
      mysqli_query($db, "INSERT INTO classes (`name`,`code`,`description` ,`lecid`,`joincode` ) VALUES ('$_POST[classname]','$_POST[classcode]','$_POST[classdescription]','$lecid','$joincode') ") or die(mysqli_error($db));
      ?>
          <script type="text/javascript">
              alert("Class created Successfully")
              window.location.href = window.location.href;
          </script>
      <?php
  }
  
?>

<?php include "includes/footer.php"?> 
<?php include "includes/modals.php"?>