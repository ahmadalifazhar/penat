<?php
echo "masuk2";
if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'trades')
{
	echo "masuk if1";
	$dir_dest = "files/"; // tukar kat sini mana nak letak
	echo "1";
	$handle = new upload($_FILES['file']);
	echo "2";
	$handle->Process($dir_dest);
	echo "lepas if2";
	if ($handle->processed)
	{
		// everything was fine !
		echo '<p class="result">';
		echo ' <b>File uploaded with success.</b><br />';
		echo ' File: ' . $handle->file_dst_name;
		echo ' (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
		echo '</p>';
	}
	else
	{
		echo '<p class="result">';
		echo ' <b>File not uploaded to the wanted location</b><br />';
		echo ' Error: ' . $handle->error . '';
		echo '</p>';
	}
	
	$handle-> Clean();
}

?>