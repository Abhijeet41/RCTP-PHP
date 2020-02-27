<?php

class DbConnect
{
    private $con;

    function __construct()
    {

    }

    //this method will connect to database
    function connect()
    {
        //including constants.php file to get database constant
        include_once dirname(__FILE__) . '/Constants.php';

        //connect to my sql database
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        //checking if any error occured while connection
        if(mysqli_connect_errno())
        {
            echo "failed to connect to MySQl: ". mysqli_connect_errno;
        } 
        return $this->con;
    }


}