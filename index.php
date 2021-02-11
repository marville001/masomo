<?php
  // include 'scripts/session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="teacher/css/bootstrap.min.css">
    <style>
    .acc-container{
      display:flex;
      justify-content: center;
    }
    .acc-content{
      margin:10px;

    }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="home-header">
        <h3 class="text-center mt-5">Welcome to Masomo</h3>
        <p class="text-center mt-2">We make learning easier by connecting students with parents</p>
      
        <h3 class="text-center mt-5">Choose An Account</h3>
        <div class="acc-container">
            <div class="acc-content">
                <a class="btn btn-outline-success" href="student/login.php" class="">Student Account</a>
            </div>
            <div class="acc-content">
                <a class="btn btn-success" href="teacher/login.php" class="">Teacher Account</a>
            </div>
            <div class="acc-content">
                <a class="btn btn-outline-success" href="parent/login.php" class="">Parent Account</a>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
