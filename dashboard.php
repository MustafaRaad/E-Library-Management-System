<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 1) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Admin Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" /> -->
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">DASHBOARD</h4>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-sm-12">

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="admin/assets/img/1.jpg" alt="" height="500px" />
                </div>
                <div class="carousel-item">
                  <img src="admin/assets/img/2.jpg" alt="" height="500px" />
                </div>
                <div class="carousel-item">
                  <img src="admin/assets/img/3.jpg" alt="" height="500px" />
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </button>
            </div>
          </div>
        </div>
        <div class="row p-5">
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="alert alert-success text-center">
              <i class="fa fa-book fa-5x"></i>
              <?php
              $sql = "SELECT id from tblbooks ";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listdbooks = $query->rowCount();
              ?>
              <h3><?php echo htmlentities($listdbooks); ?></h3>
              Books Listed
            </div>
          </div>
          <div class="col-md-6 col-sm-6 rscol-xs-6">
            <div class="alert alert-info text-center">
              <i class="fa fa-file-archive-o fa-5x"></i>
              <?php
              $sql3 = "SELECT id from tblcategory ";
              $query3 = $dbh->prepare($sql3);
              $query3->execute();
              $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
              $listdcats = $query3->rowCount();
              ?>

              <h3><?php echo htmlentities($listdcats); ?> </h3>
              Listed Categories
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  </body>

  </html>
<?php } ?>