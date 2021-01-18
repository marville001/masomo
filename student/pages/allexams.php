<?php
    $jcres = mysqli_query($db, "select * from joinedclasses where classid=$_GET[classid] AND suname = '$suname'");
    $jcrows = mysqli_num_rows($jcres); 

    // Exams
    $examsres = mysqli_query($db, "select * from exams where classid = '$_GET[classid]'");
    $examsrows = mysqli_num_rows($examsres);
    
?>

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
        <div class="results-title">
            <h1><?php echo $class['code'] ?></h1>
            <h5><?php echo $class['name'] ?></h5>
        </div>
        <div class="wrapper">
            <h2 class="my-3">Exams</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($examsrows > 0){
                    while($examsarray = mysqli_fetch_array($examsres)){    
                    ?>
                    <tr>
                        <th scope="row"><?php echo $examsarray['id'] ?></th>
                        <td><?php echo $examsarray['name'] ?></td>
                        <td><?php echo $examsarray['type'] ?></td>
                        <td><?php echo $examsarray['date'] ?></td>
                        <td><a target="_blank" href="exams.php?classid=<?php echo $_GET['classid'];?>&examid=<?php echo $examsarray['id'] ?>">View</a></td>
                    </tr>
                    <?php }}else{?>
                        <tr><td colspan=4>No exam found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>
