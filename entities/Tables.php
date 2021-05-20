<?php


class Tables
{
    public function userTable(): string
    {
        $userTable = "CREATE TABLE IF NOT EXISTS `users` (
          `id` int NOT NULL AUTO_INCREMENT,
          `first_name` varchar(45) NOT NULL,
          `last_name` varchar(45) NOT NULL,
          `email` varchar(45) NOT NULL,
          `password` varchar(64) NOT NULL,
          `age` int DEFAULT NULL,
          `pic` varchar(45) DEFAULT NULL,
          `about_me` tinytext,
          PRIMARY KEY (`id`),
          UNIQUE KEY `email_UNIQUE` (`email`)
        );";
        return $userTable;
    }

    public function postTable(): string
    {
        $postTable = " CREATE TABLE `posts` (
        `id` int NOT NULL AUTO_INCREMENT,
        `user_id` int NOT NULL,
        `title` varchar(45) NOT NULL,
        `media_link` varchar(512) default NULL,
        `description` text,
        PRIMARY KEY(`id`),
        KEY `fk_posts_1_idx` (`user_id`),
        CONSTRAINT `fk_posts_1` FOREIGN KEY(`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE)";
        return $postTable;
    }

    public function commentTable()
    {
        $commentTalbe = " CREATE TABLE `comments` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int NOT NULL,
              `post_id` int NOT NULL,
              `message` varchar(45) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `fk_comments_2` (`post_id`),
              KEY `fk_comments_1_idx` (`user_id`),
              CONSTRAINT `fk_comments_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
              CONSTRAINT `fk_comments_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            )";
        return $commentTalbe;
    }

}