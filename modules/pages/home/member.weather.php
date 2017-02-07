<?php
ob_start();include "modules/pages/home/weather.php";$weatherpg = ob_get_clean();
$weather = array();
$weather = $account;
$weatherDB = array();
$weather["WEATHERS"] = $weartherpg;
$web->loadpage("modules/pages/home","member.weather.html", $weather);
?>