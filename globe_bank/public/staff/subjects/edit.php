<?php // Single page form processing

require_once('../../../private/initialize.php');

// Check to see if there is an id set in GET
// If not, redirect to index.php
if(!isset($_GET['id']))
{
    redirect_to(url_for('staff/subjects/index.php'));
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

    $subject = [];
    $subject["id"] = $id;
    $subject["menu_name"] = $_POST['menu_name'] ?? '';
    $subject["position"] = $_POST['position'] ?? '';
    $subject["visible"] = $_POST['visible'] ?? '';

    $result = update_subject($subject);
    redirect_to(url_for("staff/subjects/show.php?id=" . $id));

} else
{
    $subject = find_subject_by_id($id);
    $subject_set = find_all_subjects();
    $subject_count = mysqli_num_rows($subject_set);
    mysqli_free_result($subject_set);
}
?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<!--*********************Form Display****************************-->

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Subject</h1>

        <form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?= h($subject['menu_name']) ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php

                            for($i=1; $i <= $subject_count; $i++)
                            {
                                echo "<option value=\"{$i}\"";
                                if($subject["position"] == $i)
                                {
                                    echo "selected";
                                }
                                echo ">{$i}</option>";
                            }

                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php if($subject["visible"] == 1){echo " checked";} ?>/>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

