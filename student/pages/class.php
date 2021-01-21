<?php include 'includes/header2.php'; ?>

<?php
   $suname = $_SESSION['username'];
   $jcres = mysqli_query($db, "select * from joinedclasses where classid=$_GET[classid] AND suname = '$suname'");
   $jcrows = mysqli_num_rows($jcres); 
   $jclass= mysqli_fetch_array($jcres);

   $classresult = mysqli_query($db, "select * from classes where id=$jclass[classid]");
   $class= mysqli_fetch_array($classresult);

   $lecres = mysqli_query($db, "select * from teachers where id = '$class[lecid]'");
   $leccarray = mysqli_fetch_array($lecres);
?>

<div class="home">
    <?php include "includes/sidebar.php"?>
    <div class="home-content">
        <?php if($jcrows<=0){?>
        <div > <h1 class="text-center mt-5"> No class found </h1></div>
        <?php  } else {            
            ?>

        <div class="classes-title">
            <h2><?php echo $class["code"];?></h2>
            <h4><?php echo $leccarray["name"];?> | <?php echo $class["name"];?></h4>
        </div>
        <div class="class-description">
            <h3>Class Description</h3>
            <p><?php echo $class["description"];?></p>
        </div>
        <?php } ?>
    </div>
</div>