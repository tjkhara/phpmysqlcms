<?php require_once('../../../private/initialize.php'); ?>


<?php
$pages =
    [
        ['id'=>'1', 'position'=>'1', 'visible'=>'1', 'menu_name'=>'Page 1'],
        ['id'=>'2', 'position'=>'2', 'visible'=>'1', 'menu_name'=>'Page 2'],
        ['id'=>'3', 'position'=>'3', 'visible'=>'1', 'menu_name'=>'Page 3'],
        ['id'=>'4', 'position'=>'4', 'visible'=>'1', 'menu_name'=>'Page 4']
    ];
?>

<?php $page_title = 'Pages'; ?>
<?php include(PRIVATE_PATH . '/shared/staff_header.php'); ?>

<div id="content">
    <div class="pages listing">
        <h2>Pages</h2>


    <div class="actions">
        <a class="actions" href="">Create New Page</a>
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
    <?php foreach($pages as $page) { ?>
    <tr>
        <td> <?= $page['id']; ?> </td>
        <td> <?= $page['position']; ?> </td>
        <td> <?= $page['visible']; ?> </td>
        <td> <?= $page['menu_name']; ?> </td>
        <td> <a href="<?= url_for('staff/pages/show.php?id=' . $page['id']) ?>">View</a> </td>
        <td> <a href="">Edit</a> </td>
        <td> <a href="">Delete</a> </td>
    </tr>
    <?php } ?>
</table>

    </div>

</div>

<?php include_once(PRIVATE_PATH . '/shared/staff_footer.php') ?>

