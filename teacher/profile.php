<?php
    include 'includes/config.php';
    session_start();
    if(isset($_SESSION['teacher_id'])){
        $lecmail = $_SESSION['teacher_email'];
        $lecid= $_SESSION['teacher_id'];
        $lecname= $_SESSION['teacher_name'];
    }else{
        header('Location: login.php');
    }
?>

<?php
    $query="SELECT * FROM classes WHERE lecid = '$lecid' ";
    $result = mysqli_query($db, $query);
    $rows = mysqli_num_rows($result);
?>

<?php 
    if(isset($_GET['id'])){
        $passedId = $_GET['id'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include 'includes/header.php'
    ?>
    <div class="main-container" style="flex-direction:column">
        <div class="header-comp">
            <img  alt="Profile Picture" src="img/user_icon.jpg" srcset="">
            <div class="header-dets">
                <h2 ><?php echo $lecname?></h2>
                <button class="btn btn-outline-success btn-sm">Edit profile</button>
            </div>
            
        </div>
        <div id="accordion" class="profile-details">
            
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        About

                        </button>
                    </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                    </div>
                </div>            
            </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>