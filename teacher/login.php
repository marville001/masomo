<?php 
    include 'includes/config.php';
?>


<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lecturer Login</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo" style="color:white;">
                    Teacher Login
                </div>
                <div class="login-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input required type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input required type="password" name="password" class="form-control" placeholder="Password">
                        </div>                                
                        <button type="submit" name="alogsubmit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <a href="signup.php" class="mt-2">Dont have an account ?</a>
                        <div class="alert alert-danger" style="margin-top:10px; display:none" id="failure">
                            <strong>No match!</strong>Invalid username or password. 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
if(isset($_POST['alogsubmit'])){  
    $count = 0;
    $email = mysqli_real_escape_string($db,$_POST['email']);         
    $password = mysqli_real_escape_string($db,$_POST['password']);         
    $epass =md5($password); 
    $res = mysqli_query($db, "select * from teachers where email ='$email' && password ='$epass' ") or die(mysqli_error($db));
    $count = mysqli_num_rows($res);

    if($count == 0){
        ?>
            <script type="text/javascript">
                document.getElementById('failure').style.display="block";
            </script>
        <?php
    }else{
        session_start();
        $row = mysqli_fetch_assoc($res);
        $_SESSION['lecid'] =  $row['id'];
        header("Location: index.php");

    }
}
?>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
