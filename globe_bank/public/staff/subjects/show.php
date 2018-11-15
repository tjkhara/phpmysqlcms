<?php require_once('../../../private/initialize.php'); ?>
<?php
// Using default value '1'
// if $_GET['id'] is not set
$id = $_GET['id'] ?? '1';

echo $id;

?>

<a href="show.php?name=<?php echo u('John Doe'); ?>">Link</a><br/>
