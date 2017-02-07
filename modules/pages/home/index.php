<?php
if ((!$member) && (empty($_REQUEST[ajax])))
	include "modules/pages/home/nonmember.php";
else
	include "modules/pages/home/member.php";
?>