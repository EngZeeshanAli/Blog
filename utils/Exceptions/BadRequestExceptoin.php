<?php


class BadRequestExceptoin extends Exception
{
    public function errorMessage()
    {
        $errorMessage = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b> Bad Request';
        return $errorMessage;
    }
}