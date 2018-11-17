<?php // Single page form processing

require_once('../../../private/initialize.php');

// Check to see if there is an id set in GET
// If not, redirect to index.php
if(!isset($_GET['id']))
{
    redirect_to(url_for('staff/pages/index.php'));
}

// At this point we have an id
$id = $_GET['id'];

// There can be no white space on this page before the php tag


// Set default values for variables in form
$menu_name = "";
$position = "";
$visible = "";

//********* Form Processing **********************//
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
?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<!--*********************Form Display****************************-->

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?= $menu_name ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1">1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Page" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

