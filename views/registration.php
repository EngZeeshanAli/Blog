<?php
include_once('header.php');
include_once('../entities/User.php');
include_once('../utils/Message.php');
if (isset($_SESSION["user_id"])) {
    header('location:login.php');
}

if (isset($_POST['createUser'])) {
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $img = $_FILES["img"]['tmp_name'];
    $about = $_POST["about"];
    $user = new User($fName, $lName, $email, $password, $age, $img, $about);
    $result = $user->registerUser($user);
    $msg = new Message();
    $msg->showMessages($result);
}

?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-5 text-center">
                <div class="registration-left">
                    <img src="../images/assets/arrow-down.png"/>
                    <h3 class="demo-name">Register Here</h3>
                    <p class="slogin">Fill the form and reach world.</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="registration-form">
                    <form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <div class="mb-2">
                            <input type="text" name="fName" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="lName" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control" placeholder="email"
                                   aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password" class="form-control" pattern=".{8,}"
                                   placeholder="Password must 8 characters" required>
                        </div>
                        <div class="mb-2">
                            <input type="number" name="age" class="form-control" placeholder="Age">
                        </div>
                        <div class="mb-2">
                            <input class="form-control" name="img" id="formFileSm" type="file"
                                   accept="image/x-png,image/jpg,image/jpeg">
                        </div>
                        <div class="mb-2">
                            <textarea class="form-control" name="about" id="about-me" rows="3"
                                      placeholder="Describe yourself here..."></textarea>
                        </div>
                        <div class="clearfix">
                            <button type="submit" name="createUser" class="btn-theme float-end">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include 'footer.html' ?>

