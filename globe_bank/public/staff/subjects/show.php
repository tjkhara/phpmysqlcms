<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Subjects Show Page"; ?>
<?php include_once(SHARED_PATH . '/staff_header.php'); ?>

<?php
  $id = $_GET['id'] ?? '1';

  $subject = find_subject_by_id($id);
?>


<div id="content">
  <a href="index.php">&laquo; Back to List</a>
  <div class="subjects show">

    <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($subject['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>
  </div>
</div>

<?php

  include_once(SHARED_PATH . '/staff_footer.php');

?>

