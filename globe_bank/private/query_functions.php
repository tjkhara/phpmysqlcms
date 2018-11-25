<?php


// Find all subjects
function find_all_subjects()
{
    global $db; // Makes $db scope global
    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY position ASC";
    // To debug SQL query uncomment the below line
//    echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result); // Checks to see if the query ran without error
    return $result;
}

// Find a single subject
// Returns an associative array
function find_subject_by_id($id){
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject;
}


// Find all pages
function find_all_pages()
{
    global $db; // Makes $db scope global
    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY subject_id ASC, position ASC";
    // To debug SQL query uncomment the below line
//    echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result); // Checks to see if the query ran without error
    return $result;
}

?>