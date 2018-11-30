<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php $page_title = "Subjects Show Page"; ?>
<?php include_once(SHARED_PATH . '/staff_header.php'); ?>

<?php
  $id = $_GET['id'] ?? '1';

  $subject = find_subject_by_id($id);

  $page_set = find_pages_by_subject_id($id);
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


<hr>

<div class="pages listing">
  <h2>Pages</h2>


  <div class="actions">
    <a class="actions" href="<?= url_for('/staff/pages/new.php?subject_id=' . h(u($subject["id"]))) ?>">Create New Page</a>
  </div>

  <table class="list">
    <tr>
      <th>ID</th>
      <th>Position</th>
      <th>Visible</th>
      <th>Name</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>
      <tr>
        <td> <?= h($page['id']); ?> </td>
        <td> <?= h($page['position']); ?> </td>
        <td> <?= $page['visible'] == '1' ? 'true' : 'false'; ?> </td>
        <td> <?= h($page['menu_name']); ?> </td>
        <td><a href="<?= url_for('staff/pages/show.php?id=' . h(u($page['id']))) ?>">View</a></td>
        <td><a href="<?= url_for('staff/pages/edit.php?id=' . h(u($page['id']))) ?>">Edit</a></td>
        <td><a href="<?= url_for('staff/pages/delete.php?id=' . h(u($page['id']))) ?>">Delete</a></td>
      </tr>
    <?php } ?>
  </table>
  <?php mysqli_free_result($page_set); ?>
</div>
</div>

<?php

  include_once(SHARED_PATH . '/staff_footer.php');

?>

