<?php

$randint = 0;
echo $randint;

srand((double)microtime() * 1000000);
// our array
$connections = array(1, 2, 3, 4, 5);
echo $connections;

$random = rand(0, count($connections) - 1);
echo $random;

?>
