<table width=100%>
<?PHP
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
?>
<tr>
<td><?php echo $value[name];?></td>
<td><?php echo $value[type];?></td>
<td><?php echo $value[size];?></td>
<td><?php echo $value[lastmod];?></td>
</tr>
<?php } ?>
</table>