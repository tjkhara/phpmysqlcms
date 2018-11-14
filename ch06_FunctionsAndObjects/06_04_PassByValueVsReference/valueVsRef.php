<?php

$number = 2;

// Pass by value
/*function doubleNum($number)
{
    return 2 * $number;
}

echo doubleNum(2);
echo "<br>";
echo "\$number is " . $number;
echo "<br>";*/

// Pass by reference
function doubleIt(&$num)
{
    $num *= 2;
}

doubleIt($number);

echo $number;
echo "<br>";
echo "<hr>";
var_dump($number);