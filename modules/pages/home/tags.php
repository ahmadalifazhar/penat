<?php
	$inputs = array();
	$tagid = "msgpinit";
	if (!empty($_REQUEST[tagid]))
		$tagid = $_REQUEST[tagid];
	$_REQUEST[val] = str_replace("@", "", $_REQUEST[val]);
		
	$inputs["NAMES"] .= "<table width=100%>";
	$sql = mysql_query("SELECT * FROM accounts WHERE auname LIKE '%".$_REQUEST[val]."%' OR afname LIKE '%".$_REQUEST[val]."%' OR alname LIKE '%".$_REQUEST[val]."%'");
	while ($tagrow = mysql_fetch_array($sql))
	{
		if (file_exists("./images/uploaded_images/resized/".$tagrow[apic].".jpg"))
			$mypic = "./images/uploaded_images/resized/".$tagrow[apic].".jpg";
		else
			$mypic = "./images/nopic.jpg";
		$inputs["NAMES"] .= "<TR>";
		$inputs["NAMES"] .= "<td width=20% align=center><img width=24 height=25 src=\"".$mypic."\"></td>";
		$inputs["NAMES"] .= "<td width=80% align=left><a href=# style=\"color:white;\" onclick=document.getElementById(\"".$tagid."\").value+=\"@".$tagrow[auname]."\";window.close();closeJS();>".$tagrow[afname]." ".$tagrow[alname]."</a></td>";
		$inputs["NAMES"] .= "</tr>";
	}
	$inputs["NAMES"] .= "</table>";
	$inputs["VALUE"] = $_REQUEST[val];
	$web->loadpage("modules/pages/home", "tags.html", $inputs);
?>