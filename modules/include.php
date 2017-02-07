<?php

	
	if (file_exists("modules/pages/".$includefile."/index.php"))
	{
		if (file_exists("modules/pages/".$includefile."/header.php") && ($member == 0))
		{
			//$locale = "modules/pages/".$includefile;
			//include "modules/pages/".$includefile."/header.php";
		}
		include "modules/pages/".$includefile."/index.php";
	}
	else
		include "modules/pages/".$includefile.".php";
?>