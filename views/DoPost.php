<?php
include('header.php');
require_once('../entities/Post.php');
include_once('../utils/Message.php');
$oldPost = '';
$enalbe = "d-none";
$dialbe = "";
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location:login.php');
}

if (isset($_POST["update_post"])) {
    $post = new Post($_SESSION["user_id"], $_POST['title'], $_POST['media_line'], $_POST['description']);
    $result = $post->updatePostById($_POST["update_post"]);
    $msg = new Message();
    $msg->showMessages($result);
}
if (isset($_GET['post_id'])) {
    $post = new Post();
    $oldPost = $post->getPostBYId($_GET['post_id']);
    if ($oldPost == null) {
        $message = "Post Does't Exist";
        $msg = new Message();
        $msg->showSingleMessages($message);
        $enalbe = "d-none";
        $dialbe = "";
    } else {
        $enalbe = "";
        $dialbe = "d-none";
    }
}

if (isset($_POST["submit_post"])) {
    $post = new Post($_SESSION["user_id"], $_POST['title'], $_POST['media_line'], $_POST['description']);
    $result = $post->doPsot();
    $msg = new Message();
    $msg->showMessages($result);
}

?>
<main>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="card bg-white mb-3  py-3">
                <div class="mb-3">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Create a Past</h5>
                    </div>
                </div>
                <div class="card bg-light mt-2">
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                            <div class="mb-2">
                                <input type="text" class="form-control" name="title"
                                       placeholder="Whats's you mind?" aria-describedby="emailHelp"
                                       value="<?php if (isset($oldPost->title)) echo $oldPost->title ?>" required>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="media_line"
                                       placeholder="Media Link"
                                       value="<?php if (isset($oldPost->media_link)) echo $oldPost->media_link ?>">
                            </div>
                            <div class="mb-2">
                                    <textarea class="form-control" rows="7" name="description"
                                              placeholder="Describe detials ..."><?php if (isset($oldPost->description)) echo $oldPost->description ?></textarea>
                            </div>
                            <button type="submit" name="submit_post" class="btn-theme w-100 <?php echo $dialbe ?>">
                                POST
                            </button>
                            <button type="submit" name="update_post"
                                    value="<?php if (isset($_GET['post_id'])) echo $_GET['post_id']; ?>"
                                    class="btn-theme w-100 <?php echo $enalbe ?>">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include('footer.html');
?>
