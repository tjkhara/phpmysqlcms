<?php

// Find all subjects
  function find_all_subjects($options=[])
  {
    global $db; // Makes $db scope global

    $visible = $options["visible"] ?? false;

    $sql = "SELECT * FROM subjects ";
    if($visible)
    {
      $sql .= "WHERE visible=true ";
    }
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
  function find_subject_by_id($id, $options=[])
  {
    global $db;

    $visible = $options["visible"] ?? false;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if($visible)
    {
      $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject;
  }

  function find_page_by_id($id, $options=[])
  {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if($visible)
    {
      $sql .= " AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $page;
  }

  function validate_subject($subject)
  {

    $errors = [];

    // menu_name
    if (is_blank($subject['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif (!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $position_int = (int)$subject['position'];
    if ($position_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if ($position_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string)$subject['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }

  function validate_page($page) {
    $errors = [];

    // subject_id
    if(is_blank($page['subject_id'])) {
      $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if(is_blank($page['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    $current_id = $page['id'] ?? '0';
    if(!has_unique_page_menu_name($page['menu_name'], $current_id))
    {
      $errors[] = "Menu name must be unique.";
    }


    // position
    // Make sure we are working with an integer
    $position_int = (int) $page['position'];
    if($position_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($position_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($page['content'])) {
      $errors[] = "Content cannot be blank.";
    }

    return $errors;
  }

  function insert_subject($subject)
  {
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements result is true or false
    if ($result) {
      // Success
      return true;
    } else // INSERT failed
    {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_page($page)
  {
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $page['subject_id']) . "',";
    $sql .= "'" . db_escape($db, $page['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $page['position']) . "',";
    $sql .= "'" . db_escape($db, $page['visible']) . "',";
    $sql .= "'" . db_escape($db, $page['content']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements result is true or false
    if ($result) {
      // Success
      return true;
    } else // INSERT failed
    {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_subject($subject)
  {
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . db_escape($db, $subject["menu_name"]) . "', ";
    $sql .= "position='" . db_escape($db, $subject["position"]) . "', ";
    $sql .= "visible='" . db_escape($db, $subject["visible"]) . "'";
    $sql .= "WHERE id='" . db_escape($db, $subject["id"]) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For update statements the result is true of false
    if ($result) {
      return true;

    } else {
      // Update failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_page($page)
  {
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . db_escape($db, $page["subject_id"]) . "', ";
    $sql .= "menu_name='" . db_escape($db, $page["menu_name"]) . "', ";
    $sql .= "position='" . db_escape($db, $page["position"]) . "', ";
    $sql .= "visible='" . db_escape($db, $page["visible"]) . "', ";
    $sql .= "content='" . db_escape($db, $page["content"]) . "'";
    $sql .= "WHERE id='" . db_escape($db, $page["id"]) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For update statements the result is true of false
    if ($result) {
      return true;

    } else {
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    // For delete statements the result is either true or false
    if ($result) {
      return true;
    } else {
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    // For delete statements the result is either true or false
    if ($result) {
      return true;
    } else {
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    $name = $subject["menu_name"];
    mysqli_free_result($result);

    return $name;


  }

  // Returns a result set
  function find_pages_by_subject_id($subject_id, $options=[])
  {
    global $db;

    $visible = $options["visible"] ?? false;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    if($visible)
    {
      $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }
