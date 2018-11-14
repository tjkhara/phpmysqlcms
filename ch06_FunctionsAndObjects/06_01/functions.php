<?php

$version = phpversion();

echo $version;

$name = 'DAVID';
echo "<br>";
//echo strtolower($name);

// Passing one function as an argument to another function
$name = ucfirst(strtolower('DAVID'));
echo $name;