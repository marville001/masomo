<?php include "includes/config.php"?> 
<?php
    session_start();
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
    $suname = $_SESSION['username'];

    $jcres = mysqli_query($db, "select * from joinedclasses where classid=$_GET[classid] AND suname = '$suname'");
    $jcrows = mysqli_num_rows($jcres); 
   
?>

<?php include "includes/header2.php"?> 
<?php 
   if(isset($_GET['classid'])){?>   
        <div class="home">
            <?php include "includes/sidebar.php"?>
            <div class="home-content">
                <?php if($jcrows <=0 ): ?>
                    <div class="members-title">
                        <h3>No Class Found</h3>
                    </div>
                <?php else:?>
                    <?php
                        $jclass = mysqli_fetch_array($jcres);
                        $classresult = mysqli_query($db, "select * from classes where id=$jclass[classid]");
                        $class= mysqli_fetch_array($classresult);
                    ?>
                    <div class="members-title">
                        <h1><?php echo $class['code'] ?></h1>
                        <h5><?php echo $class['name'] ?></h5>
                    </div>
                    <div class="wrapper">
                        <h4>Assignments</h4>
                        <hr>
                        <?php
                            $revmres = mysqli_query($db, "select * from revisionmaterials where classid=$jclass[classid]");
                            $revmrows= mysqli_num_rows($revmres);
                            if($revmrows > 0){
                            $count = 0;
                            while($row = mysqli_fetch_array($revmres)){
                            $count +=1;
                        ?>

                        <div class="card card-body p-3 mb-3">
                            <p><?php echo $count ?></p>
                            <p><?php echo $row['description'] ?></p>
                            <div class="jumbotron p-2 mb-0">
                                <a href="/masomo/uploads/<?php echo $row['file'] ?>"><?php echo $row['file'] ?></a>
                            </div>
                        </div>
                        <?php } }else{ ?>
                            <div class="card card-body">
                                <h3>No revision material uploaded yet..</h3>
                            </div>
                        <?php } ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
   <?}else{
        header('Location: classes.php');
   }
?>