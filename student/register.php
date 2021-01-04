<?php 
    include 'includes/config.php';

    session_start();           
    if(isset($_SESSION['username'])){
        header('Location: index.php');
    }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Masomo | Student Registration</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
       <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center custom-login">
				<h3>Register Now</h3>

			</div>
			<div class="content-error">
				<div class="row d-flex justify-content-center">
                    <div class="col col-sm-8 col-md-4 m-3">
                        <form action="" id="loginForm" method="post">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>FirstName</label>
                                    <input required type="text" name="firstname" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>LastName</label>
                                    <input required type="text" name="lastname" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Username</label>
                                    <input required type="text" name="username" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                <label>Password</label>
                                <input required type="password" name="password" class="form-control">
                            </div>
                                <div class="form-group col-lg-12">
                                    <label>Email</label>
                                    <input required type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Contact</label>
                                    <input required type="text" name="contact" class="form-control">
                                </div>
                              </div>
                            <div class="text-center">
                                <button type="submit" name="sregsubmit" class="btn btn-success loginbtn">Register</button>
                                <a class="btn btn-default btn-block" href="login.php">Already have an account?</a>
                            </div>
                            
                        </form>
                    </div>
                </div>
			</div>

		</div>   
    </div>

<?php
    if(isset($_POST['sregsubmit'])){
        $count = 0;
        $res = mysqli_query($db, "select * from students where username ='$_POST[username]'") or die(mysqli_error($db));
        $count = mysqli_num_rows($res);

        if($count>0){
            echo("<script>alert('Username Already Registered....')</script>");
        }else{
            $password = md5($_POST[password]);
            $username = $_POST["username"];
            mysqli_query($db, "INSERT INTO students  (`firstname`, `lastname`, `username`,`password`, `email`, `contact`) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[username]','$password','$_POST[email]','$_POST[contact]') ") or die(mysqli_error($db));
            
            echo("<script>alert('Student Registered Successfully....')</script>");
            session_start();           
            $_SESSION['username'] = $username;
            header("Location: index.php");                 
            
        }
    }
?>


    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>