<?php
include_once('header.php');
require_once "../entities/User.php";
include_once('../utils/Message.php');
if (isset($_SESSION["user_id"])) {
    header('location:index.php');
}
if (isset($_POST['login'])) {
    $login = new User();
    $user = $login->signInWithEmial($_POST['email'], $_POST['password']);
    print_r($user);
    if ($user != null) {
        session_start();
        $_SESSION["user_id"] = $user->id;
        header("Location:dashboard.php");
    } else {
        $message = "Email or Password does not match.";
        $msg = new Message();
        $msg->showSingleMessages($message);
    }
}

?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-5 text-center">
                <div class="registration-left">
                    <img src="../images/assets/arrow-down.png"/>
                    <h3 class="demo-name">Login Here</h3>
                    <p class="slogin">Wecome Back we are glide to seen you again.</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="login-form">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control" placeholder="yourmail@mail.com"
                                   aria-describedby="emailHelp" required>

                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" pattern=".{8,}"
                                   name="password" placeholder="Password must be 8 charaters" required>
                        </div>

                        <div class="clearfix">
                            <button type="submit" name="login" class="btn-theme float-end">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
include 'footer.html' ?>




