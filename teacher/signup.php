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
                    Teacher SignUp
                </div>
                <div class="login-form">
                    <form action="" method="post">
                    <div class="form-group">
                            <label>Name</label>
                            <input required type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input required type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input required type="password" name="password" class="form-control" placeholder="Password">
                        </div>     
                        <div class="form-group">
                            <label>Confirm Passord</label>
                            <input required type="password" name="cpassword" class="form-control" placeholder="Email">
                        </div>                                                   
                        <button type="submit" name="teachersignup" class="btn btn-success btn-flat m-b-30 m-t-30">Create Account</button>
                        <a href="login.php" class="mt-2">Already have an account ?</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
if(isset($_POST['teachersignup'])){
    $tname= $_POST["tname"];
    $email= $_POST["email"];
    $password= $_POST["password"];
    $cpassword= $_POST["cpassword"]; 

    if($password == $cpassword){
        $checkquery="SELECT * FROM teachers WHERE email='$email'";
        $checkresult = mysqli_query($db, $checkquery);
        $checkrows = mysqli_num_rows($checkresult);
        
        if($checkrows > 0){  
        echo("<script>alert('User Already Registered....')</script>");                
        }else {
            $encryptedpassword = md5($password);

            $query = "INSERT INTO `teachers` (`email`, `password`,`name`) VALUES ('$email','$encryptedpassword','$tname')";
            mysqli_query($db, $query);
            $query2="SELECT * FROM teachers WHERE email='$email' AND password='$encryptedpassword' ";
            $result = mysqli_query($db, $query2);
            $rows = mysqli_num_rows($result);
            
            if($rows!=0){  
                $row = mysqli_fetch_assoc($result);
                session_start();            
                $_SESSION['lecid'] = $row['id'];
                header("Location: index.php");                 
            }
        }
    }else{
        echo("<script>alert('Passwords do not match')</script>");
    }
}
?>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
