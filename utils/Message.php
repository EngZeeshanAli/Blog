<?php


class Message
{
    function showMessages($messages)
    {
        $userMessage = "";
        $messageArr = json_decode($messages);
        for ($i = 0; $i < sizeof($messageArr); $i++) {
            $userMessage .= $messageArr[$i]->message . " ";
        }
        echo "<div id='alert' class='container alert alert-secondary' role='alert'>";
        echo $userMessage . "<i class='fa fa-close close' onclick='closeAlert()'></i>";
        echo "</div>";
    }

    function showSingleMessages($message)
    {
        echo "<div id='alert' class='container alert alert-secondary' role='alert'>";
        echo $message . "<i class='fa fa-close close' onclick='closeAlert()'></i>";
        echo "</div>";
    }
}