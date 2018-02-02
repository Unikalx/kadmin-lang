<?php
echo 'hello index!';

$arr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];


function myFunction($num)
{
    echo "<p>" . $num . "</p>";
}


array_map("myFunction", $arr);
//print_r(phpinfo());