<?php
   $joinedclassres = mysqli_query($db, "select * from joinedclasses where suname = '$suname'");
   $joinedclassrows = mysqli_num_rows($joinedclassres); 

  

?>

<div class="sidebar">
    <div class="menu">
        <div class="menu-content">
            <div id="humb-btn" class="humb">
                <img src="img/hum.png" alt="Menu">
                <h2>Classes</h2>
                
            </div>
            <div id="classes" class="my-classes">
                <?php 
                    while($row = mysqli_fetch_array($joinedclassres)){
                        $classresult = mysqli_query($db, "select * from classes where id=$row[classid]");
                        $jclass= mysqli_fetch_array($classresult);
                        ?>
                        <h6><a href="classes.php?classid=<?php echo $jclass['id']?>"><?php echo $jclass['name'] ?></a></h6>
                        <?php
                    }
                ?>            
            </div>
            <div class="menus">
                <!-- <h2><a href="assignments.php?classid=<?php echo $_GET['classid']?>">Assignments</a></h2> -->
                <h2><a href="exams.php?classid=<?php echo $_GET['classid']?>">Exams</a></h2>
                <h2><a href="revmaterials.php?classid=<?php echo $_GET['classid']?>">Revision Materials</a></h2>
                <h2><a href="members.php?classid=<?php echo $_GET['classid']?>">Members</a></h2>
                <h6><button class="btn btn-primary" data-toggle="modal" data-target="#modalInviteParent">Connect to Parent</button></h6>
            </div>
        </div>
    </div>

</div>

<script>
    hum = document.getElementById("humb-btn");
    classes = document.getElementById("classes");
    hum.addEventListener('click',()=>{
        classes.classList.toggle('show');
    })
</script>