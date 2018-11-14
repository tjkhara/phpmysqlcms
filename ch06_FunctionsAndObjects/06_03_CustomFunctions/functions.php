<?php

function convertToMinutes($seconds)
{
    $minutes = floor($seconds / 60);
    $seconds = $seconds % 60;

    echo "Minutes: " . $minutes;
    echo "<br>";
    echo "Seconds: " . $seconds;
    echo "<br>";
}

convertToMinutes(61);