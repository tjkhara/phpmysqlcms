<?php

$input = "<p>Hi, there! <script>alert('Gotcha!');</script>. <a href='http://www.lynda.com/PHP-training-tutorials/282-0.html'>Expand your PHP skills</a>.";

// All tags stripped out
//echo strip_tags($input);

// Optional argument
// HTML is preserved
echo strip_tags($input,'<p><a>');