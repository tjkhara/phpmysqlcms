<?php

// Creates a url by appending the root to the script path sent in
// The root ends at public the script should be everything after that
function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
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
?>
