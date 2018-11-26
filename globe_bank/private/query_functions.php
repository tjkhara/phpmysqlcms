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

function insert_page($page)
{
    global $db;

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . $page['subject_id'] . "',";
    $sql .= "'" . $page['menu_name'] . "',";
    $sql .= "'" . $page['position'] . "',";
    $sql .= "'" . $page['visible'] . "',";
    $sql .= "'" . $page['content'] . "'";
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

function update_page($page)
{
    global $db;

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . $page["subject_id"] . "', ";
    $sql .= "menu_name='" . $page["menu_name"] . "', ";
    $sql .= "position='" . $page["position"] . "', ";
    $sql .= "visible='" . $page["visible"] . "', ";
    $sql .= "content='" . $page["content"] . "'";
    $sql .= "WHERE id='" . $page["id"] . "' ";
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

function delete_page($id)
{
    global $db;

    $sql = "DELETE FROM pages ";
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

function find_subject_name_by_id($id)
{
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    $name = $subject["menu_name"];
    mysqli_free_result($result);

    return $name;


}

