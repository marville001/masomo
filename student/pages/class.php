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

   $examres = mysqli_query($db, "select * from exam_category where classid = $_GET[classid]");
   $examrows = mysqli_num_rows($examres);

   $uexamres = mysqli_query($db, "select * from exam_upload where classid = $_GET[classid]");
   $uexamrows = mysqli_num_rows($uexamres);
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
        <div class="row p-3 bg-light">
            <div class="col-12 col-lg-8 mb-4">
                <h2>Multiple Questions Exams</h2>
                <table  class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Time</th>
                        <th scope="col">State</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($examrows<=0){?>
                    <?php  } else {
                            while($rows = mysqli_fetch_array($examres)){
                                $eres = mysqli_query($db, "select * from examsession where exam_id = '$rows[id]' and uname = '$suname'");
                                $erows = mysqli_num_rows($eres);          
                            ?> 
                            <tr>
                                <th scope="row"><?php echo $rows["id"]?></th>
                                <td><?php echo $rows["title"]?></td>
                                <td><?php echo $rows["time"]?></td>
                                <? if ($erows>0) {
                                    ?>
                                        <td>
                                            <a href="" class="btn btn-disabled">Exam done</a>
                                        </td>
                                    <?
                                } else {
                                    ?>
                                        <td> Not Started</td>
                                        <td>
                                            <a onclick="hello()" href="classes.php?classid=<?php echo $_GET["classid"]?>&examid=<?php echo $rows["id"]?>" class="btn btn-success text-white">Start</a>
                                        </td>
                                <? }?>
                            </tr>
                        <?php }}?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-lg-8 mb-4">
                <h2>Upload Exams</h2>
                <table  class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($uexamrows<=0){?>
                    <?php  } else {
                            while($rows = mysqli_fetch_array($uexamres)){        
                            ?> 
                            <tr>
                                <th scope="row"><?php echo $rows["id"]?></th>
                                <td><?php echo $rows["title"]?></td>
                                <td><?php echo $rows["description"]?></td>
                                <td> <a href="exam.php?classid=<?php echo $_GET['classid']?>&examid=<?php echo $rows["id"]?>">View</a></td>
                                
                            </tr>
                        <?php }}?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-sm-12 col-md-6 ">
                <div class="list-group">
                    <h4 href="#" class="list-group-item list-group-item-action bg-success text-white">
                        Assignments
                    </h4>
                    <?php if(-2<=0){?>                    
                    <div > <h4 class="text-center mt-2 mb-5 bg-white p-5"> No Assignment yet... </h4></div>
                    <?php  } else {?> 
                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                        <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
                    <?php }?>
                </div>
            </div>  
            <div class="col-12 col-sm-6 col-md-6 ">
                <div class="list-group">
                    <h4 href="#" class="list-group-item list-group-item-action bg-success text-white">
                        Revision material
                    </h4>
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
                                $res = mysqli_query($db,"select * from revisionmaterials where classid ='$_GET[classid]'") or die(mysqli_error($db));
                                if(mysqli_num_rows($res)>0){ 
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
                                }else {
                                    echo "<tr><td colspan=4><h4>No revision material yet..</h4></tr></td>";
                                }
                            ?>
                            
                        </tbody>
                    </table>     
                </div>
            </div>             
        </div>
    <?php  } ?>
</div>


        