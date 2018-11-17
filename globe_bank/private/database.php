<?php
// This has all the functions related to the database

require_once('db_credentials.php');


// Do all the things to connect to the database
function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

function db_disconnect($connection)
{
    if(isset($connection))
    {
        mysqli_close($connection);
    }

}


?>