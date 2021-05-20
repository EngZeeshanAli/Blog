<?php
include_once "header.php";
require_once('../entities/Post.php');
include_once('../utils/Message.php');
require_once "../entities/User.php";
require_once "../entities/Comment.php";

$oldPost = "";
$user = "";
$login = "";
$comment = "";
if (!isset($_SESSION["user_id"])) {
    $login = "d-none";
}
$userImage = "placeholder.j";
if (isset($_GET['post_id'])) {
    $post = new Post();
    $oldPost = $post->getPostBYId($_GET['post_id']);
    if ($oldPost == null) {
        $message = "Post Does't Exist";
        $msg = new Message();
        $msg->showSingleMessages($message);
    }
    $getUser = new User();
    $user = $getUser->getUserWithId($oldPost->user_id);
}
if (isset($_POST["createComment"])) {
    $comment = new Comment($_SESSION["user_id"], $_GET['post_id'], $_POST['comment']);
    $result = $comment->doComment();
    $msg = new Message();
    $msg->showMessages($result);
}
function getAllComments()
{
    $post = new Comment();
    $array = $post->getAllComments($_GET['post_id']);
    return $array;
}

function getThumnailUrl($link)
{
    if (strpos($link, "facebook")) {
        return "https://www.facebook.com/plugins/video.php?&href=" . $link;
    }
    if (strpos($link, "youtube")) {
        $id = explode("v=", $link);
        return "https://www.youtube.com/embed/" . $id[1];
    }
}

?>
    <main>
        <div class="container">
            <div class="card p-3">
                <div class="card bg-light p-3">
                    <h3><?php echo $oldPost->title ?></h3>
                </div>
                <?php
                if (isset($oldPost->media_link)) {
                    echo "<iframe  class='bd-placeholder-img card-img-top' width='50%' height='400'
                                    src='" . getThumnailUrl($oldPost->media_link) . "' scrolling='no'>
                                    </iframe>";
                }
                ?>
                <p class="p-5"><?php echo $oldPost->description ?></p>
                <div class="d-flex justify-content-end">
                    <?php

                    if (isset($user->pic)) {
                        echo "<img src='../images/uploads/" . $user->pic . "' class='img - thumbnail'  width='50' height='50'>";
                    } else {
                        echo "<img src=' ../images/assets/placeholder.jpg' class='img - thumbnail' width='40' height='40'>";
                    }
                    ?>
                    <div class="ms-3">
                        <span>Posted By:</span><br>
                        <span class="text-info"><?php echo $user->first_name . " " . $user->last_name ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!--comments -->
            <form class="mt-4 mb-4 <?php echo $login ?>" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <div class="mb-2">
                    <div class="mb-2">
                            <textarea class="form-control" name="comment" id="about-me" rows="3"
                                      placeholder="comment" required></textarea>
                        <button type="submit" name="createComment" class="btn btn-primary w-100 mt-2">comment</button>
                    </div>
                </div>
            </form>
            <?php
            foreach (getAllComments() as $obj) {
                $cmt = (object)$obj;
                $getUser = new User();
                $cmt_user = $getUser->getUserWithId($cmt->user_id);
                echo "<div class=' mt-4 d-flex'>
                    <div class='flex-shrink-0'>";
                if (isset($cmt_user->pic)) {
                    echo "<img src='../images/uploads/" . $cmt_user->pic . "' class='mr-3' height='64' width='64'>";
                } else {
                    echo "<img src=' ../images/assets/placeholder.jpg' class='mr-3' height='64' width='64'>";
                }
                echo "</div>
                    <div class='flex-grow-1 ms-3'>
                        <h5 class='mt-0'>" . $cmt_user->first_name . " " . $cmt_user->last_name . "</h5>"
                    . $cmt->message .
                    "</div>
                     </div>";
            }
            ?>

        </div>
    </main>
<?php
include_once "footer.html";
?>