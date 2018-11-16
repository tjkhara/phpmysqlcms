<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Subjects Show Page"; ?>
<?php include_once(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a href="index.php">&laquo; Back to List</a>
    <div class="subjects show">
    <?php
        $id = $_GET['id'] ?? '1';
        echo "Subject ID: " . h($id);
    ?>
    </div>
</div>

<?php

include_once(SHARED_PATH . '/staff_footer.php');

?>

