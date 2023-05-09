<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
        <img src="assets/img/logo.png" width="50px" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="dashboard.php">DASHBOARD </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add-category.php">Add Category</a>
                    <a class="dropdown-item" href="manage-categories.php">Manage Categories</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Authors
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add-author.php">Add Author</a>
                    <a class="dropdown-item" href="manage-authors.php">Manage Authors</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Books
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add-book.php">Add Book</a>
                    <a class="dropdown-item" href="manage-books.php">Manage Books</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Issue Books
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="issue-book.php">Issue New Book</a>
                    <a class="dropdown-item" href="manage-issued-books.php">Manage Issued Books</a>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="reg-students.php">Reg Students </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="change-password.php">Change Password </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0">LOG OUT</a>
        </form>
    </div>
</nav>