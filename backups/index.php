<?php
	//include "conf/config.php";
	//include "conf/accDB.php";
	include "conf/simple_html_dom.php";
	include "conf/functions.php";
	$web = new PinIt();
	
	if (strlen($_REQUEST["op"]) >= 1)
	{
		$op = strtolower($op);
		$file1 = "./".$op.".php";
		$file2 = "./".$op.".html";
		$file3 = "./modules/".$op."/index.html";
		$file4 = "./modules/".$op."/index.php";
		$file5 = "./".$op."/index.html";
		$file6 = "./".$op."/index.php";
		if (file_exists($file2))
			$web->loadpage($file2);
		else if (file_exists($file3))
			$web->loadpage($file3);
		else if (file_exists($file4))
			include $file4;
		else if (file_exists($file5))
			$web->loadpage($file5);
		else if (file_exists($file6))
			include $file6;
		else if (file_exists($file1))
			include $file1;
		else
		{
			die("TEST");
		}
	}
	else
	{
		$web->loadpage("./home/index.html");
	}
?>