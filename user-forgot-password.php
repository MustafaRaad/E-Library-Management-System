<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['change'])) {
  //code for captach verification
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $newpassword = md5($_POST['newpassword']);
  $sql = "SELECT EmailId FROM tblstudents WHERE EmailId=:email and MobileNumber=:mobile";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    $con = "update tblstudents set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
    $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    echo "<script>alert('Your Password succesfully changed');</script>";
  } else {
    echo "<script>alert('Email id or Mobile no is invalid');</script>";
  }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Online Library Management System | Password Recovery </title>
  <!-- BOOTSTRAP CORE STYLE  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- FONT AWESOME STYLE  -->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLE  -->
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- GOOGLE FONT -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

</head>

<body>
  <!------MENU SECTION START-->
  <?php include('includes/header.php'); ?>
  <!-- MENU SECTION END-->
  <div class="content-wrapper">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">User Password Recovery</h4>
        </div>
      </div>

      <!--LOGIN PANEL START-->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <div class="panel panel-info">
            <div class="panel-body">
              <form role="form" name="chngpwd" method="post" onSubmit="return valid();">

                <div class="form-group">
                  <label>Enter Reg Email id</label>
                  <input class="form-control" type="email" name="email" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Enter Reg Mobile No</label>
                  <input class="form-control" type="text" name="mobile" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control" type="password" name="newpassword" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>ConfirmPassword</label>
                  <input class="form-control" type="password" name="confirmpassword" required autocomplete="off" />
                </div>

                <button type="submit" name="change" class="btn btn-info">Chnage Password</button> | <a href="index.php">Login</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!---LOGIN PABNEL END-->


    </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>


</body>

</html>