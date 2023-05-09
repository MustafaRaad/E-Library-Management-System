<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $sql = "INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber) VALUES(:bookname,:category,:author,:isbn)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book Listed successfully";
            header('location:manage-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-books.php');
        }
    }

    // File upload handling
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        $uploadDir = 'uploaded_books/';  // Directory to store uploaded files
        $filename = $_FILES['file']['name'];
        $filepath = $uploadDir . $filename;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
            // Insert file information into the database
            $sql = "INSERT INTO  files(filename,filepath) VALUES(:filename,:filepath)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':filename', $filename, PDO::PARAM_STR);
            $query->bindParam(':filepath', $filepath, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $_SESSION['msg'] = "File uploaded successfully!";
                header('location:add-book.php');
            } else {
                $_SESSION['error'] = "Failed to upload file.";
                header('location:add-book.php');
            }
        } else {
            echo 'Failed to upload file.';
        }
    }

    // File download handling
    if (isset($_GET['file_id'])) {
        $fileId = $_GET['file_id'];

        // Retrieve file information from the database
        $stmt = $pdo->prepare("SELECT filename, filepath FROM files WHERE id = ?");
        $stmt->execute([$fileId]);
        $file = $stmt->fetch();

        if ($file) {
            $filename = $file['filename'];
            $filepath = $file['filepath'];

            // Output headers to initiate file download
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$filename\"");

            // Read the file and output its contents
            readfile($filepath);
            exit;
        } else {
            echo 'File not found.';
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
        <title>Online Library Management System | Add Book</title>
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
                        <h4 class="header-line">Add Book</h4>

                    </div>

                </div>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="panel-heading">
                                        Add Book Info
                                    </div>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="panel-body">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>Book Name<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="bookname" autocomplete="off" required />
                                        </div>

                                        <div class="form-group">
                                            <label> Category<span style="color:red;">*</span></label>
                                            <select class="form-control" name="category" required="required">
                                                <option value=""> Select Category</option>
                                                <?php
                                                $status = 1;
                                                $sql = "SELECT * from  tblcategory where Status=:status";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':status', $status, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label> Author<span style="color:red;">*</span></label>
                                            <select class="form-control" name="author" required="required">
                                                <option value=""> Select Author</option>
                                                <?php

                                                $sql = "SELECT * from  tblauthors ";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->AuthorName); ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>ISBN Number<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="isbn" required="required" autocomplete="off" />
                                            <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                                        </div>

                                        <div class="form-group">
                                        </div>
                                        <button type="submit" name="add" class="btn btn-info">Add </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="panel-heading">
                                        Add Book File
                                    </div>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="panel-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="file" name="file" required>
                                        <button type="submit">Upload</button>
                                    </form>

                                    <!-- <h2>Uploaded Files</h2>
                                    <ul>
                                        <?php
                                        // Display a list of uploaded files with download links
                                        $stmt = $pdo->query("SELECT id, filename FROM files");
                                        while ($row = $stmt->fetch()) {
                                            $fileId = $row['id'];
                                            $filename = $row['filename'];
                                            echo "<li><a href=\"?file_id=$fileId\">$filename</a></li>";
                                        }
                                        ?>
                                    </ul> -->
                                </div>
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