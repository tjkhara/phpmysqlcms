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

function insert_subject($menu_name, $position, $visible)
{
    global $db;

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . $menu_name . "',";
    $sql .= "'" . $position . "',";
    $sql .= "'" . $visible . "'";
    $sql .= ")";
    $result = mysqli_query($db,$sql);
    // For INSERT statements result is true or false
    if($result)
    {
        // Success
        return true;
    }
    else // INSERT failed
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
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