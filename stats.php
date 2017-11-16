<?php

$str   = @file_get_contents('/proc/uptime');
$num   = floatval($str);
$secs  = fmod($num, 60); $num = (int)($num / 60);
$mins  = $num % 60;      $num = (int)($num / 60);
$hours = $num % 24;      $num = (int)($num / 24);
$days  = $num;

echo "web app is running since : " . $days . " days " . $hours . " hours " . $mins . " mins " . $secs . " secs <br />" ;

echo "FAILED MESSAGE LOG : <br />";

$data = file_get_contents("logs.txt");
echo '<pre>' . var_export($data, true) . '</pre>';

?>