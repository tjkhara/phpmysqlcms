<?php

function find_all_subjects()
{
    global $db; // Makes $db scope global
    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    return $result;
}

?>