<?php 
    session_start();
    include 'includes/config.php';     
    if(isset($_SESSION['username'])){
        header('Location: index.php');
    }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h3>Student Login</h3>
			</div>
			<div class="content-error">
				<div class="row d-flex justify-content-center">
                    <div class="col col-sm-8 col-md-4 m-3">
                        <form action="" id="loginForm" method="post">
                            <div class="alert alert-danger" style="margin:10px 0px; display:none" id="allfieldrequired">
                                <strong>All fields are required </strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input required type="text" placeholder="username" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">

                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input required type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">

                            </div>

                            <button type="submit" name="slogsubmit" class="btn btn-success btn-block loginbtn">Login</button>
                            <a class="btn btn-default btn-block" href="register.php">Dont have an account?</a>

                        </form>
                    </div>
                </div>
			</div>

		</div>   
    </div>

<?php
    if(isset($_POST['slogsubmit'])){  
        $count = 0;          
        $password =md5($_POST["password"]);
        $res = mysqli_query($db, "select * from students where username ='$_POST[username]' && password ='$password' ") or die(mysqli_error($db));
        $count = mysqli_num_rows($res);
echo($count);
        if($count == 0){
            echo("<script>alert('Invalid Username or Password...')</script>");
        }else{
            $_SESSION['username'] = $_POST['username'];
            header("Location: index.php"); 
        }
    }
?>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery-price-slider.js"></script>
    <script src="js/jquery.meanmenu.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>


</body>

</html>