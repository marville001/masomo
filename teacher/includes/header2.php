<?php  
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Masomo | Lec</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon" href="apple-icon.png" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link
      rel="stylesheet"
      href="vendors/bootstrap/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="vendors/font-awesome/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css" />
    <link rel="stylesheet" href="assets/css/style.css" />

    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800"
      rel="stylesheet"
      type="text/css"
    />
  </head>

  <body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
          <!-- <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#main-menu"
            aria-controls="main-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fa fa-bars"></i>
          </button> -->
          <a class="navbar-brand" href="./">Masomo </a>
          <a class="navbar-brand hidden" href="./">M</a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li>
              <a href="index.php">
                <i class="menu-icon fa fa-dashboard"></i>Dashboard
              </a>
            </li>
            <li class="menu-item-has-children active dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Exam</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="menu-icon fa fa-th"></i><a href="classes.php?classid=<?php echo $_GET['classid']; ?>">Add Exam</a></li>
                    <li><i class="menu-icon fa fa-th"></i><a href="exam_manage.php?classid=<?php echo $_GET['classid']; ?>">Manage Exam</a></li>
                </ul>
            </li>            
            <li>
              <a href="logout.php">
                <i class="menu-icon fa fa-power-off"></i>LogOut
              </a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </nav>
    </aside>

    <div id="right-panel" class="right-panel">
      <!-- Header-->
      <header id="header" class="header">
        <div class="header-menu">
          <div class="col-sm-7"></div>
          <div class="col-sm-5">
            <div class="user-area dropdown float-right">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <img
                  class="user-avatar rounded-circle"
                  src="images/admin.jpg"
                  alt="User Avatar"
                />
              </a>

              <div class="user-menu dropdown-menu">
                <a class="nav-link" href="logout.php"
                  ><i class="fa fa-power-off"></i> Logout</a
                >
              </div>
            </div>
          </div>
        </div>
      </header>