<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $uploadDir = 'uploaded_books/';  // Directory to store uploaded files
        $filename = $_FILES['file']['name'];
        $filepath = $uploadDir . $filename;

        $bookid = intval($_GET['bookid']);
        // if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {
            $sql = "update  tblbooks set BookName=:bookname,CatId=:category,Author=:author,ISBNNumber=:isbn,filename=:filename,filepath=:filepath where id=:bookid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
            $query->bindParam(':filename', $filename, PDO::PARAM_STR);
            $query->bindParam(':filepath', $filepath, PDO::PARAM_STR);
            $query->bindParam(':category', $category, PDO::PARAM_STR);
            $query->bindParam(':author', $author, PDO::PARAM_STR);
            $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
            $query->execute();
            $_SESSION['msg'] = "Book info updated successfully";
            header('location:manage-books.php');
        // } else {
        //     $_SESSION['error'] = "Error uploading the file.";
        //     header('location: manage-books.php');
        //     exit;
        // }
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Edit Book</title>
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
                        <h4 class="header-line">Edit Book</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Book Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $bookid = intval($_GET['bookid']);
                                $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblbooks.Author,tblbooks.filename,tblbooks.filepath,tblbooks.ISBNNumber,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId where tblbooks.id=:bookid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {               ?>

                                        <div class="form-group">
                                            <label>Book Name<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName); ?>" required />
                                        </div>

                                        <div class="form-group">
                                            <label> Category<span style="color:red;">*</span></label>
                                            <select class="form-control" name="category" required="required">
                                                <option value="<?php echo htmlentities($result->cid); ?>"> <?php echo htmlentities($catname = $result->CategoryName); ?></option>
                                                <?php
                                                $status = 1;
                                                $sql1 = "SELECT * from  tblcategory where Status=:status";
                                                $query1 = $dbh->prepare($sql1);
                                                $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                                $query1->execute();
                                                $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                                if ($query1->rowCount() > 0) {
                                                    foreach ($resultss as $row) {
                                                        if ($catname == $row->CategoryName) {
                                                            continue;
                                                        } else {
                                                ?>
                                                            <option value="<?php echo htmlentities($row->id); ?>"><?php echo htmlentities($row->CategoryName); ?></option>
                                                <?php }
                                                    }
                                                } ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label> Author<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->Author); ?>" required="required" />
                                        </div>

                                        <div class="form-group">
                                            <label>ISBN Number<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber); ?>" required="required" />
                                            <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Book File<span style="color:red;">*</span></label>
                                            <input class="form-control" type="file" name="file" value="<?php echo htmlentities($result->filepath); ?>" required="required" />
                                        </div> -->

                                <?php }
                                } ?>
                                <button type="submit" name="update" class="btn btn-info">Update </button>

                            </form>
                        </div>
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