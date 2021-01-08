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

   $uexamres = mysqli_query($db, "select * from exam_upload where classid = $_GET[classid]");
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
                <div class="card-header"><strong> <?php echo $examarray["title"];?></strong></div>
                <div class="card-body">
                    <p> <?php echo $examarray["description"];?></p>
                    <h5>Download the exam here</h5>
                    <div class="jumbotron" style="padding:10px; margin-bottom:10px">
                        <a class="text-dark hover-underline" href="../uploads/<?php echo $examarray['file'] ?>"><?php echo $examarray['file'] ?></a>
                    </div>
                    <p>Note: The exam should be done and submitted within the given time</p>

                    <div>
                    <?php
                        $checkres = mysqli_query($db, "select * from exam_upload_answer where exam_id = $_GET[examid] and classid = $_GET[classid] ")
                    ?>
                        <button class="btn btn-outline-success m-1" data-toggle="modal" data-target="#uploadexamanswer">Upload Your answer</button>
                    </div>
                </div>
                </div>
            </div>               
        </div>
    <?php  } ?>
</div>

        