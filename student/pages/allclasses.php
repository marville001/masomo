<?php
   $suname = $_SESSION['username'];
   $jcres = mysqli_query($db, "select * from joinedclasses where suname = '$suname'");
   $jcrows = mysqli_num_rows($jcres); 
?>

<?php include 'includes/header2.php'; ?>
<div class="row" style="margin: 0px; padding:0px; margin-bottom: 50px;">   
    <div class="col col-12">
        <div style="background-color:white;padding:5px 20px;display:flex;justify-content:space-between;padding-right:50px;">
            <div>
                <h3>All Classes</h3>
                <h5><?php echo $jcrows ?> joined <?php if($jcrows=1){echo "class";}else {
                    echo "Classes";
                }?></h5>
            </div>
            <div>
                <button class="btn btn-success" data-toggle="modal" data-target="#joinClassModal">Join Class</button>
            </div>
        </div>
    </div>
    <?php $classesarray=array();
        while($rows = mysqli_fetch_array($jcres)){
            $classesresult = mysqli_query($db, "select * from classes where id = '$rows[classid]'");
            $classarray = mysqli_fetch_array($classesresult);
            array_push($classesarray,$classarray);
        }
        
    ?>
    <div class="col">
        <div class="row">
        <?php 
        foreach($classesarray as $ca){
            $lecres = mysqli_query($db, "select * from teachers where id = '$ca[lecid]'");
            $leccarray = mysqli_fetch_array($lecres);
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card m-3">
                    <div class="card-header bg-success p-4">
                        <h4 class="card-title text-white"><?php echo $ca["name"]?></h4>
                    </div>
                    <div class="card-body" style="min-height:70px">
                        <h5 class="card-subtitle text-muted mt-2 mb-2">Lecturer: <?php echo $leccarray["name"]?></h5>
                        <p class="card-text"><?php echo $ca["description"]?></p>
                    </div>
                    <div class="card-footer p-0" style="display:flex;height:50px;align-items:center">
                        <a href="classes.php?classid=<?php echo $ca["id"]?>" style="display:block;width:80%;height:100%;color:#000;text-align:center;">View class</a>
                        <img style="width:20px;margin-left:auto;margin-right:10px;cursor:pointer;" src="img/menu.png" alt="Menu" />
                    </div>
                </div>           
            </div>
        <?php }?>
            
        </div>
    </div>        
</div>

<?php
if(isset($_POST['joinClassSubmit'])){
    $res1 = mysqli_query($db, "select * from classes where joincode ='$_POST[classcode]'") or die(mysqli_error($db));
    $count1 = mysqli_num_rows($res1);
    if($count1<=0){
        echo("<script>alert('Invalid Class Code....')</script>");header('Location: classes.php');
    }else{    
        $row2= mysqli_fetch_array($res1);
        $res2 = mysqli_query($db, "select * from joinedclasses where classid ='$row2[id]' AND suname='$suname' ") or die(mysqli_error($db));
        $count2 = mysqli_num_rows($res2);
        if($count2>0){
            echo("<script>alert('You already have joined the class....')</script>");header('Location: classes.php');
        }else{
            mysqli_query($db, "INSERT INTO joinedclasses (`classid`,`suname`) VALUES ('$row2[id]','$suname') ") or die(mysqli_error($db));
            echo("<script>alert('Class joined successfully....')</script>");
            header('Location: classes.php');
        }
    }
    

}
?>

<?php
    include 'includes/modals.php';
    include 'includes/footer.php';
    
?>