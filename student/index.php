<?php
    session_start();
    include 'includes/config.php';
    if(!isset($_SESSION['username']) ){
        header('Location: login.php');
    }
    $suname = $_SESSION['username'];

?>

<?php
   $jcres = mysqli_query($db, "select * from joinedclasses where suname = '$suname'");
   $jcrows = mysqli_num_rows($jcres);

   
   $stdres = mysqli_query($db, "select * from students where username = '$suname'");
   $starrat = mysqli_fetch_array($stdres);

?>

<?php include 'includes/header2.php';?>

<div class="row" style="margin-top: 0px; padding:0px; margin-bottom: 50px;">
    <div class="col-lg-12" style="min-height: 500px; background-color: white;padding-top:50px;">
    <h2 class="text-center">Welcome <?php echo $starrat["firstname"]?> <?php echo $starrat["lastname"]?> </h2>
    <?php if($jcrows==0){
    ?>
        <h4 class="text-center">No Class Joined Yet</h4>
        <div style="display:flex;justify-content:center">
            <button class="btn btn-success" data-toggle="modal" data-target="#joinClassModal">Join Class</button>
        </div>
    <?php
    }else{
    ?>
        <h4 class="text-center">Total Classes joined <span class="badge badge-primary"><?php echo $jcrows?></span></h4>
        <div style="display:flex;justify-content:center">
            <a href="classes.php" class="btn btn-success">View Classes</a>
        </div>
    <?php
    } ?>
    </div>
</div>

<?php
if(isset($_POST['joinClassSubmit'])){
    $res1 = mysqli_query($db, "select * from classes where joincode ='$_POST[classcode]'") or die(mysqli_error($db));
    $count1 = mysqli_num_rows($res1);
    if($count1<0){
        echo("<script>alert('Invalid Class Code....')</script>");header('Location: index.php');
    }else{    
        $row2= mysqli_fetch_array($res1);
        $res2 = mysqli_query($db, "select * from joinedclasses where classid ='$row2[id]' AND suname='$suname' ") or die(mysqli_error($db));
        $count2 = mysqli_num_rows($res2);
        if($count2>0){
            echo("<script>alert('You already have joined the class....')</script>");header('Location: index.php');
        }else{
            mysqli_query($db, "INSERT INTO joinedclasses (`classid`,`suname`) VALUES ('$row2[id]','$suname') ") or die(mysqli_error($db));
            echo("<script>alert('Class joined successfully....')</script>");
            header('Location: index.php');
        }
    }
    

}
?>



<?php
    include 'includes/modals.php';
    include 'includes/footer.php';
?>


        