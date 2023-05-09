<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
        <img src="assets/img/logo.png" width="50px" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if ($_SESSION['login']) {
        ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="dashboard.php">DASHBOARD </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="my-profile.php">My Profile</a>
                        <a class="dropdown-item" href="change-password.php">Change Password</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="add-book.php">Add Book</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="manage-books.php">Manage Books</a>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="adminlogin.php">Admin Login</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="signup.php">User Signup</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">User Login</a>
                </li>
            </ul>

            <?php if ($_SESSION['login']) {
            ?>
                <form class="form-inline my-2 my-lg-0">
                    <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0">LOG OUT</a>
                </form>
            <?php } ?>
    </div>
</nav>

<?php } ?>