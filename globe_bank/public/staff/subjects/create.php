<?php
require_once('../../../private/initialize.php');


// This code below will make sure that create.php is only accessed via
// a post request or a form submission. And not by directly putting this
// URL in the browser (get request.)
if(is_post_request())
{
    // Handle form values sent by new.php

    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters<br />";
    echo "Menu name: " . $menu_name . "<br />";
    echo "Position: " . $position . "<br />";
    echo "Visible: " . $visible . "<br />";
}
else // If it is a get request, then redirect to new.php again (to the form)
{
    redirect_to(url_for('staff/subjects/new.php'));
}



?>
