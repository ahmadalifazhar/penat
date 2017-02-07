<?php
	$inputs = array();
	$inputs = $_POST;
	$inputs["TOTALNUMUSER"] = count($accDB);
	$web->loadpage("modules/pages/home", "login.html", $inputs);
?>