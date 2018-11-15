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
?>
