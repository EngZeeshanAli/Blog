<?php
require_once("DatabaseHelper.php");
require_once("Tables.php");
require_once("../utils/FileUploader.php");

class User
{


    private $id, $FirstName, $LastName, $email, $password, $age, $img, $about;

    /**
     * User constructor.
     * @param $FirstName
     * @param $LastName
     * @param $email
     * @param $password
     * @param $age
     * @param $img
     * @param $about
     */
    public function __construct($FirstName = "", $LastName = "", $email = "", $password = "", $age = "", $img = "", $about = "")
    {
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->email = $email;
        $this->password = $password;
        $this->age = $age;
        $this->img = $img;
        $this->about = $about;
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
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param mixed $FirstName
     */
    public function setFirstName($FirstName): void
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param mixed $LastName
     */
    public function setLastName($LastName): void
    {
        $this->LastName = $LastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param mixed $about
     */
    public function setAbout($about): void
    {
        $this->about = $about;
    }

    private function validate()
    {
        $messages = array();
        if ($this->FirstName === '') {
            array_push($messages, ["message" => "First Name Can't be empty."]);
        }
        if ($this->LastName === '') {
            array_push($messages, ["message" => "Last Name Can't be empty."]);
        }
        if ($this->email === '') {
            array_push($messages, ["message" => "Email Name Can't be empty."]);
        }
        if ($this->password === '') {
            array_push($messages, ["message" => "Password Can't be empty."]);
        }
        return $messages;
    }

    public function registerUser()
    {
        if (sizeof($this->validate()) > 0) {
            return json_encode($this->validate());
        }
        $img = "";
        $sql = "INSERT INTO users (id, first_name, last_name, email, password, age, pic, about_me) VALUES 
            (NULL,'$this->FirstName','$this->LastName','$this->email','$this->password','$this->age','$img','$this->about');";
        $table = new Tables();
        $db = new DatabaseHelper();
        $db->createTable($table->userTable());
        $result = $db->runSql($sql);
        if ($result) {
            if ($this->img != null) {
                $uploader = new FileUploader();
                $uploader->uploadImage($this->img, $this->email);
            }
            $message = array(["message" => "Account Created Successfully. SignIn Now."]);
            return json_encode($message);
        } else {
            $message = array(["message" => "Account already exist."]);
            return json_encode($message);
        }
    }

    function signInWithEmial($email, $password)
    {
        $sql = "SELECT * FROM users where `email`='$email' AND `password`='$password';";
        $db = new DatabaseHelper();
        $rows = $db->getData($sql);
        if ($rows != null) {
            $user = (object)$rows[0];
            return $user;
        } else {
            return null;
        }
    }

    function getUserWithId($userId)
    {
        $sql = "SELECT * FROM users where `id`='$userId'";
        $db = new DatabaseHelper();
        $rows = $db->getData($sql);
        if ($rows != null) {
            $user = (object)$rows[0];
            return $user;
        } else {
            return null;
        }
    }
}