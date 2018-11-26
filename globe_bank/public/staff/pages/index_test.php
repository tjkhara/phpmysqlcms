<?php require_once('../../../private/initialize.php'); ?>

<?php
// Get results from database
$page_set = find_all_pages();

?>

<?php $page_title = 'Pages'; ?>
<?php include(PRIVATE_PATH . '/shared/staff_header.php'); ?>

<?php

$id = 1;
$page = find_page_by_id($id);
$subject_id = $page["subject_id"];
echo $subject_id;
echo find_subject_name_by_id($subject_id);
var_dump($page);

$test = find_subject_name_by_id(1);
echo $test;

?>


<?php include_once(PRIVATE_PATH . '/shared/staff_footer.php') ?>

