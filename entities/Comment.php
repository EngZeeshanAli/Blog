<?php
require_once("DatabaseHelper.php");
require_once("Tables.php");

class Comment
{
    private $id, $user_id, $post_id, $message;

    /**
     * Comment constructor.
     * @param $user_id
     * @param $post_id
     * @param $message
     */
    public function __construct($user_id = "", $post_id = "", $message = "")
    {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id): void
    {
        $this->post_id = $post_id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function doComment()
    {
        $sql = "INSERT INTO comments (id, user_id, post_id, message) VALUES 
            (NULL,'$this->user_id','$this->post_id','$this->message');";
        $table = new Tables();
        $db = new DatabaseHelper();
        $db->createTable($table->commentTable());
        $result = $db->runSql($sql);
        if ($result) {
            $message = array(["message" => "Posted"]);
            return json_encode($message);
        } else {
            $message = array(["message" => "Can't post. somthing bad"]);
            return json_encode($message);
        }
    }

    public function getAllComments($postId)
    {
        $sql = "SELECT * FROM comments WHERE post_id='$postId'";
        $db = new DatabaseHelper();
        $rows = $db->getData($sql);
        if ($rows != null) {
            $posts = (object)$rows;
            return $posts;
        } else {
            return null;
        }
    }

}