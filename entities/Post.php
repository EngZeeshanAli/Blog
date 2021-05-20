<?php
require_once("DatabaseHelper.php");
require_once("Tables.php");
include_once('../utils/Message.php');

class Post
{
    private $id, $user_id, $title, $media_link, $description;

    /**
     * Post constructor.
     * @param $user_id
     * @param $title
     * @param $media_link
     * @param $description
     */
    public function __construct($user_id = "", $title = "", $media_link = "", $description = "")
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->media_link = $media_link;
        $this->description = $description;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getMediaLink()
    {
        return $this->media_link;
    }

    /**
     * @param mixed $media_link
     */
    public function setMediaLink($media_link): void
    {
        $this->media_link = $media_link;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    private function validate()
    {
        $messages = array();
        if ($this->user_id === '') {
            array_push($messages, ["message" => "User Id required."]);
        }
        if ($this->title === '') {
            array_push($messages, ["message" => "Title Can't be empty."]);
        }
        return $messages;
    }

    public function doPsot()
    {
        if (sizeof($this->validate()) > 0) {
            return json_encode($this->validate());
        }
        $sql = "INSERT INTO posts (id, user_id, title, media_link, description) VALUES 
            (NULL,'$this->user_id','$this->title','$this->media_link','$this->description');";
        $table = new Tables();
        $db = new DatabaseHelper();
        $db->createTable($table->postTable());
        $result = $db->runSql($sql);
        if ($result) {
            $message = array(["message" => "Posted Successfully."]);
            return json_encode($message);
        } else {
            $message = array(["message" => "SomeThing Bad."]);
            return json_encode($message);
        }
    }

    public function getAllPosts()
    {
        $sql = "SELECT * FROM posts";
        $db = new DatabaseHelper();
        $rows = $db->getData($sql);
        if ($rows != null) {
            $posts = (object)$rows;
            return $posts;
        } else {
            return null;
        }
    }

    public function getAllUserPosts($userId)
    {
        $sql = "SELECT * FROM posts WHERE user_id='$userId'";
        $db = new DatabaseHelper();
        $rows = $db->getData($sql);
        if ($rows != null) {
            $posts = (object)$rows;
            return $posts;
        } else {
            return null;
        }
    }

    public function getPostBYId($postId)
    {
        $sql = "SELECT * FROM posts WHERE ID='$postId'";
        $db = new DatabaseHelper();
        $rows = $db->getData($sql);
        if ($rows != null) {
            $posts = (object)$rows[0];
            return $posts;
        } else {
            return null;
        }
    }

    public function deletePostById($postId)
    {
        $sql = "DELETE FROM posts WHERE id='$postId'";
        $db = new DatabaseHelper();
        $result = $db->runSql($sql);
        if ($result) {
            $message = array(["message" => "Deleted Successfully."]);
            return json_encode($message);
        } else {
            $message = array(["message" => "Something bad happend."]);
            return json_encode($message);
        }
    }

    public function updatePostById($postId)
    {
        $sql = "UPDATE `posts` SET `title` = '$this->title', `media_link` = '$this->media_link', `description` = '$this->description' WHERE `posts`.`id` = '$postId';";
        $db = new DatabaseHelper();
        $result = $db->runSql($sql);
        if ($result) {
            $message = array(["message" => "Updated Successfully."]);
            return json_encode($message);
        } else {
            $message = array(["message" => "Something bad happend."]);
            return json_encode($message);
        }
    }
}