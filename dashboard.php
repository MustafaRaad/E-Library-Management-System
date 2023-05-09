<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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


          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-bars fa-5x"></i>
              <?php
              // $sid = $_SESSION['stdid'];
              // $sql1 = "SELECT id from tblissuedbookdetails where StudentID=:sid";
              // $query1 = $dbh->prepare($sql1);
              // $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
              // $query1->execute();
              // $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
              // $issuedbooks = $query1->rowCount();
              ?>

              <h3><?php // echo htmlentities($issuedbooks); ?> </h3>
              Book Issued
            </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-recycle fa-5x"></i>
              <?php
              // $rsts = 0;
              // $sql2 = "SELECT id from tblissuedbookdetails where StudentID=:sid and RetrunStatus=:rsts";
              // $query2 = $dbh->prepare($sql2);
              // $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
              // $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
              // $query2->execute();
              // $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
              // $returnedbooks = $query2->rowCount();
              ?>

              <h3>
                <?php // echo htmlentities($returnedbooks); ?>
              </h3>
              Books Not Returned Yet
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