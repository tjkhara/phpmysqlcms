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

function find_page_by_id($id){
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $page;
}

function insert_subject($subject)
{
    global $db;

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . $subject['menu_name'] . "',";
    $sql .= "'" . $subject['position'] . "',";
    $sql .= "'" . $subject['visible'] . "'";
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

function update_subject($subject)
{
    global $db;

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . $subject["menu_name"] . "', ";
    $sql .= "position='" . $subject["position"] . "', ";
    $sql .= "visible='" . $subject["visible"] . "'";
    $sql .= "WHERE id='" . $subject["id"] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For update statements the result is true of false
    if($result)
    {
        return true;

    } else
    {
        // Update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_subject($id)
{
    global $db;

    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    // For delete statements the result is either true or false
    if($result)
    {
        return true;
    }
    else
    {
        // Delete failed
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