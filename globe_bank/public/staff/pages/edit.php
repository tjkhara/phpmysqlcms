<?php // Single page form processing (no white page before php tag)

require_once('../../../private/initialize.php');

// Check to see if there is an id set in GET
// If not, redirect to index.php
if(!isset($_GET['id']))
{
    redirect_to(url_for('staff/pages/index.php'));
}

// At this point we have an id
$id = $_GET['id'];

if(is_post_request())
{
    $page = [];
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = update_page($page);
    redirect_to(url_for('staff/pages/show.php?id=' . $id));
}
else
{
    $page = find_page_by_id($id);
    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);
}

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<!--*********************Form Display****************************-->

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="page edit">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id">
                        <?php
                        $subject_set = find_all_subjects();
                        while($subject = mysqli_fetch_assoc($subject_set))
                        {
                            echo "<option value=\"" . h($subject['id']) . "\"";
                            if($page["subject_id"] == $subject['id'])
                            {
                                echo "selected";
                            }
                            echo ">" . h($subject['menu_name']) . "</option>";
                        }
                        mysqli_free_result($subject_set);


                        ?>
                    </select>
                </dd>
            </dl>

            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?= $page['menu_name'] ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1" <?php if($page['position'] == '1'){echo " selected";} ?>>1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php if($page['visible'] == 1){echo " checked";} ?> />
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><input type="text" name="content" value="<?= $page['content'] ?>" /></dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Page" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

