<?php
include_once "header.php";
require_once("../entities/Post.php");
if (!isset($_SESSION["user_id"])) {
    header('location:login.php');
}

if (isset($_POST['delete_post'])) {
    delete($_POST['delete_post']);
}
function getAllPosts()
{
    $post = new Post();
    $array = $post->getAllUserPosts($_SESSION["user_id"]);
    if ($array == null) {
        return array();
    }
    return $array;
}

function delete($postId)
{
    $post = new Post();
    $result = $post->deletePostById($postId);
    $msg = new Message();
    $msg->showMessages($result);
}

?>
    <main class="container">
        <h1 class="demo-name">you all posts</h1>
        <div class="card py-1 px-1">
            <table class="table  table-striped">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $index = 1;
                foreach (getAllPosts() as $obj) {
                    $post = (object)$obj;
                    echo "<tr>
                    <th scope='row'>" . $index . "</th>
                    <td>" .
                        $post->title
                        . "</td>
                        <td>
                         <form method='post'>
                         <a href='DoPost.php?post_id=" . $post->id . "'><button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button></a>
                        <a href='PostView.php?post_id=" . $post->id . "'><button type='button' class='btn btn-sm btn-outline-info'>View</button></a>
                        <button type='submit' name='delete_post' value='" . $post->id . "' class='btn btn-sm btn-outline-danger' data-bs-toggle='modal' data-bs-target='#delete'>Delete</button>
                        </form>
                        </td>
                    </tr>";
                    $index++;
                } ?>
                </tbody>
            </table>
        </div>

    </main>
<?php
include_once "footer.html";
?>