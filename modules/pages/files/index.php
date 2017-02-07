<?php
	if ((strlen($_REQUEST[fc]) >= 1) && (strlen($_REQUEST[fvv]) >= 1) && (strlen($_REQUEST[fid]) >= 1))
	{
		$q = mysql_query("SELECT * FROM fileslog WHERE fid='".$_REQUEST[fid]."' AND fvvv='".$_REQUEST[fvv]."' AND fc='".$_REQUEST[fc]."' LIMIT 0,1");
		$row = mysql_fetch_array($q);
		if ($_REQUEST[code] == 1)
			header('Content-Type:text/plain');
		else if ($_REQUEST[download] == 1)
		{
			header("Content-type: application/force-download");
			header('Content-Disposition: attachment; filename="'.basename($row[fname]).'"');
			header("Content-Length: ".$row[fsize]);
		}
		else
			header('Content-Type:text/html');
		ob_start();
		echo base64_decode($row[fsrc]);
		$posts = ob_get_clean();
		die($posts);
		//die($row[fby]);
	}
?>
<html>
<head>
<meta http-equiv="refresh" content="120;?op=files" />
<title>File Directory Status and Logs</title>
</head><body>
<h1>File Directory Status and Logs</h1>
<form method=post action="?op=files">
 Search File or file Type or Modifer Name: 
 <input type="text" name="searchname" id="textfield" />
 <input type="submit" name="opchk" value="SEARCH" id="opchk" />
</form>
<form method=post action="?op=files">
<table width=100% border=1>
<tr bgcolor="<?php echo $value[bgcolor];?>">
<td>Filename</td>
<td>Type</td>
<td>Size</td>
<td>Last Modified Date</td>
<td>Last Modified by</td>
<td>Status</td>
<td>Modifier</td>
<td>Ref / Version</td>
</tr>
<pre>

ref format : [sys name]/[sys ver]/[sys devel month]/[class]/[ref no].[no ver: a-z]
ref: pinit/01/04/00/xxx.x (Root System)
ref: pinit/01/04/01/xxx.x (Account System)
ref: pinit/01/04/02/xxx.x (Profile System)
ref: pinit/01/04/03/xxx.x (Geo-map System)
ref: pinit/01/04/04/xxx.x (Setting System)
ref: pinit/01/04/05/xxx.x (Chat/MSG System)
ref: pinit/01/04/06/xxx.x (Geo-map System)
ref: pinit/01/04/07/xxx.x (- System) *Reserved*
ref: pinit/01/04/08/xxx.x (- System) *Reserved*
ref: pinit/01/04/09/xxx.x (- System) *Reserved*
ref: pinit/01/04/10/xxx.x (- System) *Reserved*
ref: pinit/01/04/11/xxx.x (Jobs SubSystem)
ref: pinit/01/04/12/xxx.x (Entertainment SubSystem)
ref: pinit/01/04/13/xxx.x (Transportation SubSystem)
ref: pinit/01/04/14/xxx.x (Cloud SubSystem)
ref: pinit/01/04/15/xxx.x (Education SubSystem)
ref: pinit/01/04/16/xxx.x (Trades SubSystem)
ref: pinit/01/04/17/xxx.x (Shopping Tracker SubSystem)

ref: pinit/01/04/xx/xxx.x (System/Subsystem Source Codes)
ref: pinit/01/05/xx/xxx.x (System/Subsystem Documentations)

<?PHP

//die("X");
$q = mysql_query("SELECT * FROM files");
$fileDB = array();
while ($r = mysql_fetch_array($q))
{
	if ((isset($_POST["f".$r[fid]])) && ($_POST["f".$r[fid]] >= 1))
	{
		if (($_POST["f".$r[fid]] != $r[status]) || ($_POST["mod_by_".$r[fid]] != $r[modname]) || ($_POST["fc".$r[fid]] != $r[fc]) || ($_POST["fvv".$r[fid]] != $r[fvv]) || ($_POST["fver".$r[fid]] != $r[fver]) || ($_POST["overview".$r[fid]] != $r[overview]))
		{
			//echo $r[fid].":".$r[name].":".$_POST["f".$r[fid]].":".$r[status];
			//echo "<BR>";
			$detailf[modname]	= $_POST["mod_by_".$r[fid]];
			$detailf[status]	= $_POST["f".$r[fid]];
			$detailf[size]		= filesize($r[name]);
			$detailf[lastmod]	= filemtime($r[name]);
			$detailf[fc]		= $_POST["fc".$r[fid]];
			$detailf[fvv]		= $_POST["fvv".$r[fid]];
			$detailf[fver]		= $_POST["fver".$r[fid]];
			$detailf[overview]	= $_POST["overview".$r[fid]];
			$where[fid]			= $r[fid];
			if (mysql_query(gendata("files", $detailf, $where)))
			{
				if ($detailf[fvv] != $r[fvv])
				{
					$src = file_get_contents($r[name]);
					$detaill[fsrc]		= base64_encode($src);
					$detaill[fname]		= $r[name];
					$detaill[fc]		= $detailf[fc];
					$detaill[fvvv]		= $detailf[fvv];
					$detaill[fver]		= $detailf[fver];
					$detaill[fdate]		= time();
					$detaill[fby]		= $detailf[modname];
					$detaill[fsize]		= filesize($r[name]);
					if (mysql_query(gendata("fileslog", $detaill, "INSERT")))
						echo " * UPDATED SRC FVV: ".$r[name]."\r\n";
					else
						echo " * FAIL TO BE UPDATED SRC FVV: ".$r[name];
				}
				$r[status]		= $detailf[status];
				$r[modname]		= $detailf[modname];
				$r[fc]			= $detailf[fc];
				$r[fvv]			= $detailf[fvv];
				$r[fver]		= $detailf[fver];
				$r[lastmod]		= $detailf[lastmod];
				$r[size]		= $detailf[size];
				$r[overview]	= $detailf[overview];
				echo " * UPDATED: ".$r[name]."\r\n";
			}
			else
			{
				echo " * Failed to update ".$r[name]."\r\n";
			}
		}
	}
	$r[logfile] = array();
	$fileDB[$r[name]] = $r;
}

$q = mysql_query("SELECT * FROM fileslog");
$filelDB = array();
while ($r = mysql_fetch_array($q))
{
	if ((isset($fileDB[$r[fname]])) && (strlen($fileDB[$r[fname]][name]) >= 1))
	{
		array_push($fileDB[$r[fname]][logfile], $r);
	}
}
function getFileList($dir, $recurse=false) {
	
	$retval = array();
	if(substr($dir, -1) != "/") $dir .= "/";
	$d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
	while(false !== ($entry = $d->read())) {
		if($entry[0] == ".") continue; if(is_dir("$dir$entry")) { $retval[] = array( "name" => "$dir$entry/", "type" => filetype("$dir$entry"), "size" => 0, "lastmod" => filemtime("$dir$entry") ); if($recurse && is_readable("$dir$entry/")) { $retval = array_merge($retval, getFileList("$dir$entry/", true)); } } elseif(is_readable("$dir$entry")) { $retval[] = array( "name" => "$dir$entry", "type" => mime_content_type("$dir$entry"), "size" => filesize("$dir$entry"), "lastmod" => filemtime("$dir$entry") ); } } $d->close(); return $retval; }
		
		$dirlist = getFileList("./", true);
		//echo "<pre>",print_r($dirlist),"</pre>";
		
	foreach ($dirlist as $value)
	{
		if ((isset($fileDB[$value[name]])) && (strlen($fileDB[$value[name]][name]) >= 1))
		{
			
			$fileDB[$value[name]][statuseditcheckbox]		= "";
			$fileDB[$value[name]][statusfreecheckbox]		= "";
			$fileDB[$value[name]][statuscompletecheckbox]	= "";
			$fileDB[$value[name]][statusbugcheckbox]	= "";
			$fileDB[$value[name]][statusidlecheckbox]	= "";
			$size1 = (int)($fileDB[$value[name]][size]);
			$size2 = (int)($value[size]);
			$mode1 = (int)($fileDB[$value[name]][lastmod]);
			$mode2 = (int)($value[lastmod]);
			//if (($mode1 != $mode2) && ($value[type] != "dir"))
			if ((($size1 != $size2) || ($mode1 != $mode2)) && ($value[type] != "dir"))
			{
				$whatupdate = "";
				if ($mode1 != $mode2)
					$whatupdate .= "(Different last mod date)";
				if ($size1 != $size2)
					$whatupdate .= "(Different file size)";
				echo ' * File on server update detected, please update the FC & FVV version to avoid conflicts : <a href="?op=files&searchname='.$value[name].'">'.$value[name].'</a><BR>';
			}
			$fileDB[$value[name]][size]			= $value[size];
			$fileDB[$value[name]][lastmod]		= $value[lastmod];
			$fileDB[$value[name]][type]			= $value[type];
			if (($fileDB[$value[name]][status] == 1) || ($fileDB[$value[name]][status] == 0))
			{
				$fileDB[$value[name]][statuschk]				= "FREE EDIT";
				$fileDB[$value[name]][bgcolor] 					= "";
				$fileDB[$value[name]][statusfreecheckbox]		= "checked=checked";
			}
			else if ($fileDB[$value[name]][status] == 2)
			{
				//echo $fileDB[$value[name]][name]; 
				//echo $value[name]; 
				$fileDB[$value[name]][statuschk]				= "UNDER EDITED";
				$fileDB[$value[name]][bgcolor] 					= "red";
				$fileDB[$value[name]][statuseditcheckbox]		= "checked=checked";
			}
			else if ($fileDB[$value[name]][status] == 3)
			{
				$fileDB[$value[name]][statuschk]				= "CODING COMPLETED";
				$fileDB[$value[name]][bgcolor] 					= "green";
				$fileDB[$value[name]][statuscompletecheckbox]	= "checked=checked";
			}
			else if ($fileDB[$value[name]][status] == 4)
			{
				$fileDB[$value[name]][statuschk]				= "BUGGY";
				$fileDB[$value[name]][bgcolor] 					= "orange";
				$fileDB[$value[name]][statusbugcheckbox]		= "checked=checked";
			}
			else if ($fileDB[$value[name]][status] == 5)
			{
				$fileDB[$value[name]][statuschk]				= "HOLD/IDLE";
				$fileDB[$value[name]][bgcolor] 					= "gray";
				$fileDB[$value[name]][statusidlecheckbox]		= "checked=checked";
			}
		}
		else
		{
			$detail[name]		= $value[name];
			$detail[type]		= $value[type];
			$detail[size]		= $value[size];
			$detail[lastmod]	= $value[lastmod];
			$detail[status]		= 1;
			$detail[owner]		= "N/A";
			$detail[modname]	= "N/A";
			if (mysql_query(gendata("files", $detail, "INSERT")))
			{
				//$value[bgcolor] = "yellow";
				//$value[statuschk] = "NEW...";
				echo '<BR>New File detected: <a href="?op=files&searchname='.$value[name].'">'.$value[name].'</a>\r\n';
			}
			else
			{
				//$value[bgcolor] = "red";
				//$value[statuschk] = "FAILED TO INSERTED";
			}
		}
	}
	?>

* PRESS [ENTER] BUTTON - PRESS [SAVE] IF YOU ARE DONE
* IF YOU ARE EDITING, MAKE SURE THE FILE IS MARKED AS "UNDER EDITING"
* IF YOU ARE DONE EDITING, MAKE SURE THE FILE IS MARKED AS "FREE EDIT"
</pre>
<?php
	$totalFiles = 0;
	$totalFiles1 = 0;
	$totalFiles2 = 0;
	$totalFiles3 = 0;
	$totalFiles4 = 0;
	$totalFiles5 = 0;
	$fileDisplayDB = array();
	if (($opchk == "SEARCH") || (strlen($_REQUEST["searchname"]) >= 1))
		$q = mysql_query("SELECT * FROM files WHERE name LIKE '%".$_REQUEST[searchname]."%' OR modname LIKE '%".$_REQUEST[searchname]."%'");
	else if (strlen($_REQUEST[relate]) >= 1)
		$q = mysql_query("SELECT * FROM files WHERE fc = '".$_REQUEST[relate]."'");
	else
		$q = mysql_query("SELECT * FROM files");
	while ($r = mysql_fetch_array($q))
	{
		if ((isset($fileDB[$r[name]])) && (strlen($fileDB[$r[name]][name]) >= 1) && ((strpos($fileDB[$r[name]][type],"image/") === false) && (strpos($fileDB[$r[name]][type],"dir") === false)))
		{
			$fileDisplayDB[$r[name]] = $fileDB[$r[name]];
			$totalFiles++;
		}
	}

	$filecat = 5;		//Total of file status
	$filecatN = 0;
	while ($filecatN < $filecat)
	{
		foreach ($fileDisplayDB as $value)
		{
			if (($filecatN == 0) && ($value[status] == 2))
			{
				$totalFiles2++;
				include "modules/pages/files/list.php";
			}
			if (($filecatN == 1) && ($value[status] == 4))
			{
				$totalFiles4++;
				include "modules/pages/files/list.php";
			}
			if (($filecatN == 2) && ($value[status] == 5))
			{
				$totalFiles5++;
				include "modules/pages/files/list.php";
			}
			if (($filecatN == 3) && ($value[status] == 3))
			{
				$totalFiles3++;
				include "modules/pages/files/list.php";
			}
			if (($filecatN == 4) && (($value[status] == 0) || ($value[status] == 1)))
			{
				$totalFiles1++;
				include "modules/pages/files/list.php";
			}
		}
		$filecatN++;
	}
?>
</table>
<h2>Statistics</h2>
<table width=100%>
<tr>
<td>Total Files</td><td><?php echo $totalFiles;?> files</td>
</tr>
<tr>
<td>Total COMPLETED Files</td><td><?php echo round($totalFiles3/$totalFiles*100);?>% files <?php echo $totalFiles3;?> files</td>
</tr>
<tr>
<td>Total UNDER EDITING Files</td><td><?php echo round($totalFiles2/$totalFiles*100);?>% files <?php echo $totalFiles2;?> files</td>
</tr>
<tr>
<td>Total HOLD/IDLE Files</td><td><?php echo round($totalFiles5/$totalFiles*100);?>% files <?php echo $totalFiles5;?> files</td>
</tr>
<tr>
<td>Total BUGGY Files</td><td><?php echo round($totalFiles4/$totalFiles*100);?>% files <?php echo $totalFiles4;?> files</td>
</tr>
<tr>
<td>Total FREE EDITING Files</td><td><?php echo round($totalFiles1/$totalFiles*100);?>% files <?php echo $totalFiles1;?> files</td>
</tr>
</table>
<input type=submit name=opchk value="SAVE" />
</form>
</body>
<script>
<?php
	$msg = 'Total Files : '.$totalFiles.' files\r\n'.
	'Total COMPLETED Files : '.round($totalFiles3/$totalFiles*100).'% files ('.$totalFiles3.' files)\r\n'.
	'Total UNDER EDITING Files : '.round($totalFiles2/$totalFiles*100).'% files ('.$totalFiles2.' files)\r\n'.
	'Total HOLD/IDLE Files : '.round($totalFiles5/$totalFiles*100).'% files ('.$totalFiles5.' files)\r\n'.
	'Total BUGGY Files : '.round($totalFiles4/$totalFiles*100).'% files ('.$totalFiles4.' files)\r\n'.
	'Total FREE EDITING Files : '.round($totalFiles1/$totalFiles*100).'% files ('.$totalFiles1.' files)';
	?>
	alert('<?php echo $msg;?>');
</script>
</html>