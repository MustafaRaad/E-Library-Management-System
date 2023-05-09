<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect to login if user is not logged in
if (strlen($_SESSION['alogin']) == 1) {
  header('location:index.php');
  exit();
}

// Fetch all categories
$sql = "SELECT * FROM tblcategory";
$query = $dbh->prepare($sql);
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Online Library Management System | Categories</title>
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
          <h4 class="header-line">Categories</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- Categories List -->
          <div class="panel panel-default">
            <div class="panel-heading">
              Categories List
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($categories) > 0) {
                      foreach ($categories as $category) {
                        $categoryId = $category->id;
                        $categoryName = $category->CategoryName;
                    ?>
                        <tr>
                          <td><?php echo htmlentities($categoryId); ?></td>
                          <td><?php echo htmlentities($categoryName); ?></td>
                          <td>
                            <a href="view-category.php?categoryId=<?php echo htmlentities($categoryId); ?>">
                              <button class="btn btn-primary"><i class="fa fa-eye"></i> View Books</button>
                            </a>
                          </td>
                        </tr>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="3">No categories found</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- End Categories List -->
        </div>
      </div>
    </div>
  </div>
</body>

</html>