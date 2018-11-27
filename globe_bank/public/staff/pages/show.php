<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Pages Show Page"; ?>
<?php include_once(SHARED_PATH . '/staff_header.php'); ?>

<?php
  $id = $_GET['id'] ?? '1';

  $page = find_page_by_id($id);
  $subject_id = $page["subject_id"];
  $subject_name = find_subject_name_by_id($subject_id);
?>

<div id="content">
  <a href="index.php">&laquo; Back to List</a>
  <div class="page show">
    <h1>Page: <?php echo h($page['menu_name']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Subject Name</dt>
        <?= h($subject_name); ?>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($page['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($page['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?php echo h($page['content']); ?></dd>
      </dl>
    </div>
  </div>
</div>

<?php

  include_once(SHARED_PATH . '/staff_footer.php');

?>

