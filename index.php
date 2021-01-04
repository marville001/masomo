<?php
  // include 'scripts/session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/caccount.css">
  </head>
  <body>
    <?php
      include 'includes/header.php'
    ?>
    <div class="container">
      <div class="home-header">
        <h3 class="text-center mt-5">Welcome to Masomo</h3>
        <p class="text-center mt-2">We make learning easier by connecting students with parents</p>
      
        <h3 class="text-center mt-5">Choose An Account</h3>
        <div class="acc-container">
            <div class="acc-content">
                <a href="student/signup.php" class="">Student Account</a>
            </div>
            <div class="acc-content">
                <a href="parent/signup.php" class="">Parent Account</a>
            </div>
            <div class="acc-content">
                <a href="teacher/signup.php" class="">Teacher Account</a>
            </div>
        </div>
        <p class="text-center" >Already have an account? <a href="login.php">Log in</a></p> 
      </div>
    </div>
  </body>
</html>
