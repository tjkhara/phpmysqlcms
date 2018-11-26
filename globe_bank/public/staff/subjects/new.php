<?php

require_once('../../../private/initialize.php');


$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set) + 1;
mysqli_free_result($subject_set);

$subject = [];
$subject["position"] = $subject_count;

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
    // If it is a post request, send data to the database
    // Handle form values sent by new.php

    // Initialize variables
    $subject = [];
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';


    $result = insert_subject($subject);
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('staff/subjects/show.php?id=' . $new_id));
}
?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create Subject</h1>

        <form action="<?= url_for('/staff/subjects/new.php') ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?= h($menu_name) ?>" /></dd>
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
                    <input type="checkbox" name="visible" value="1" <?php if($visible == 1){echo " checked";} ?>/>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Subject" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

