<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Pages Show Page"; ?>
<?php include_once(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a href="index.php">&laquo; Back to List</a>
    <div class="page show">
<?php
        $id = $_GET['id'] ?? '1';
        echo "Page ID: " . h($id);
?>
    </div>
</div>

<?php

include_once(SHARED_PATH . '/staff_footer.php');

?>

