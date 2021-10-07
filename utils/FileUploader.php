<?php
require_once("../entities/DatabaseHelper.php");

class FileUploader
{
    //image addition
    public function uploadImage($image, $email)
    {
        try {
            $name = $email . ".jpg";
            $file_store = "../images/uploads/" . $name;
            if (!file_exists('../images/uploads/')) {
                mkdir('../images/uploads', 0777, true);
            }
            move_uploaded_file($image, $file_store);
            $query = "UPDATE `users` SET `pic` = '$name' WHERE `users`.`email` = '$email';";
            $herlper = new DatabaseHelper();
            $herlper->runSql($query);
        } catch (BadRequestExceptoin $e) {
            die($e->errorMessage());
        }
    }
}