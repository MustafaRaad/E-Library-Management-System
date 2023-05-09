<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect to login if user is not logged in
if (strlen($_SESSION['alogin']) == 1) {
  header('location:index.php');
  exit();
}

// Get the category ID from the URL parameter
if (isset($_GET['categoryId'])) {
  $categoryId = $_GET['categoryId'];

  // Fetch the category name
  $sql = "SELECT * FROM tblcategory WHERE id = :categoryId";
  $query = $dbh->prepare($sql);
  $query->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
  $query->execute();
  $category = $query->fetch(PDO::FETCH_OBJ);

  // Fetch the books of the category
  $sql = "SELECT * FROM tblbooks WHERE CatId = :categoryId";
  $query = $dbh->prepare($sql);
  $query->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
  $query->execute();
  $books = $query->fetchAll(PDO::FETCH_OBJ);
} else {
  // Redirect back to categories page if category ID is not provided
  header('location:categories.php');
  exit();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Online Library Management System | View Category</title>
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
          <h4 class="header-line">View Category: <?php echo htmlentities($category->CategoryName); ?></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- Books List -->
          <div class="panel panel-default">
            <div class="panel-heading">
              Books List
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Book Name</th>
                      <th>Author</th>
                      <th>ISBN</th>
                      <th>File</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($books) > 0) {
                      $count = 1;
                      foreach ($books as $book) {
                    ?>
                        <tr>
                          <td><?php echo htmlentities($count); ?></td>
                          <td><?php echo htmlentities($book->BookName); ?></td>
                          <td><?php echo htmlentities($book->Author); ?></td>
                          <td><?php echo htmlentities($book->ISBNNumber); ?></td>
                          <td>
                            <a class="btn btn-sm btn-primary" href="admin/<?php echo htmlentities($book->filepath); ?>" target="_blank">View File</a>
                          </td>
                        </tr>
                      <?php
                        $count++;
                      }
                    } else { ?>
                      <tr>
                        <td colspan="5">No books found in this category</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- End Books List -->
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
  <!-- JQUERY SCRIPTS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-YsjQqDkgcq5Yj3U3pZbht7LiXz08u9SG2f7j6nc7h+CFEMpIZxQYbr4Ex/TQys+9" crossorigin="anonymous"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>
</body>

</html>