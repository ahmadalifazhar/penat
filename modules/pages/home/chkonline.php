<?php
	$detail[alastlogupdate]		= time();
	$wdetail[aid]			= $chkid;
	mysql_query(gendata("accounts", $detail, $wdetail));
?>