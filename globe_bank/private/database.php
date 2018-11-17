<?php
// This has all the functions related to the database

require_once('db_credentials.php');


// Do all the things to connect to the database
function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect(); // Check to see if connection went well, otherwise handle error gracefully
    return $connection;
}

function db_disconnect($connection)
{
    if(isset($connection))
    {
        mysqli_close($connection);
    }

}

function confirm_db_connect()
{
    // Test if connection succeeded
    if(mysqli_connect_errno())
    {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set)
{
    // Test if query succeeded
    if(!$result_set)
    {
        exit("Database query failed.");
    }
}


?>