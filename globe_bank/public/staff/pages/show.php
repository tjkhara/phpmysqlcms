<?php require_once('../../../private/initialize.php'); ?>
<?php
// Using default value '1'
// if $_GET['id'] is not set
$id = $_GET['id'] ?? '1';

// Whenever dynamic data is output to the page
// htmlspecialchars should be used
echo h($id);

?>
