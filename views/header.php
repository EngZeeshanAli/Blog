<?php
$login = "";
$logout = "";
session_start();
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('location:index.php');
}
if (isset($_SESSION["user_id"])) {
    $login = "d-none";
} else {
    $logout = "d-none";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Solution</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header class="p-3 mb-3 border-bottom bg-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img width="40" height="32" src="../images/assets/logo.svg"/>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 link-dark"><b>Home</b></a></li>
                <li><a href="" class="nav-link px-2 link-dark"><b>Contact</b></a></li>
            </ul>
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item <?php echo $login ?>" href="login.php">Login</a></li>
                    <li><a class="dropdown-item <?php echo $login ?>" href="registration.php">Register</a></li>
                    <li><a class="dropdown-item <?php echo $logout ?>" href="dashboard.php">DashBoard</a></li>
                    <li><a class="dropdown-item <?php echo $logout ?>" href="DoPost.php">New Post</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="post">
                            <input type="submit" name="logout" class="dropdown-item <?php echo $logout ?>" value="Sign out">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
</body>
</html>