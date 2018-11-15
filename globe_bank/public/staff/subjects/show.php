<?php
// Using default value '1'
// if $_GET['id'] is not set
$id = $_GET['id'] ?? '1';

echo $id;

?>