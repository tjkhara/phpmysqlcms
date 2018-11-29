<?php

// Creates a url by appending the root to the script path sent in
// The root ends at public the script should be everything after that
  function url_for($script_path)
  {
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }

// URL encode the string sent in the argument
  function u($string = "")
  {
    return urlencode($string);
  }

// Raw URL encode the string sent in the argument
  function raw_u($string = "")
  {
    return rawurlencode($string);
  }

// Short function for htmlspecialchars function
  function h($string = "")
  {
    return htmlspecialchars($string);
  }

// When a 404 error happens
// We could instead of exit redirect to a custom 404 error page as well
  function error_404()
  {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
  }

// For 500 internal server error
  function error_500()
  {
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
  }

// Redirect function
  function redirect_to($location)
  {
    header("Location: " . $location);
    exit;
  }

// To check for form submission
// True if it is a post request
// False otherwise
  function is_post_request()
  {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

// To check if it is a get request
  function is_get_request()
  {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
  }

  function display_errors($errors = array())
  {
    $output = '';
    if (!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $error) {
        $output .= "<li>" . h($error) . "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

  function get_and_clear_session_message()
  {
    if(isset($_SESSION['message']) && $_SESSION['message'] != '')
    {
      $msg = $_SESSION['message'];
      unset($_SESSION['message']);
      return $msg;
    }
  }

  function  display_session_message()
  {
    $msg = get_and_clear_session_message();
    if(!is_blank($msg))
    {
      return '<div id="message">' . h($msg) . '</div>';
    }
  }