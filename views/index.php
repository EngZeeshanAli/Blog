<?php
include "header.php";
require_once("../entities/DatabaseHelper.php");
require_once("../entities/User.php");
require_once("../entities/Post.php");



function getAllPosts()
{
    $post = new Post();
    $array = $post->getAllPosts();
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
        <section class="py-5 text-center container header">
            <div class="row py-lg-5 d-flex justify-content-center">
                <div class="col-lg-6 col-md-8 content">
                    <h1 class="demo-name">Blog Solution</h1>
                    <p class="slogin">“Don’t try to plan everything out to the very last detail. I’m a big believer in
                        just getting it out there: create a minimal viable product or website, launch it, and get
                        feedback.”</p>
                </div>
            </div>
        </section>

        <div class="album py-5">
            <div class="container">
                <div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>
                    <?php
                    foreach (getAllPosts() as $obj) {
                        echo "<div class='col pointer' onclick=''>
                                <div class='card shadow-sm'>";
                        $post = (object)$obj;
                        $link = "";
                        if ($post->media_link != "") {
                            $link = getThumnailUrl($post->media_link);
                        }
                        if ($link != "") {
                            echo "<iframe  class='bd-placeholder-img card-img-top' width='100%' height='225'
                                    src='" . $link . "' scrolling='no'>
                                    </iframe>";
                        } else {
                            echo "<img src = '../images/assets/placeholder.jpg' width='100%' height='225'>";
                        }

                        echo "
                        <div class='card-body'>
                            <a href='PostView.php?post_id=" . $post->id . "' class='text-decoration-none'>
                                <h5 class='card-title text-danger'>" . $post->title . "</h5>
                                <p class='card-text text-max'>" . $post->description . "</p>
                            </a>        
                              </div>
                            </div>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php
include "footer.html" ?>