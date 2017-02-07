<?php
if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'create_folder')
{
	$folder_name = $_POST[folder_name];
	if (isset($folder_name))
	{
		$col[name]		= $folder_name;
		$col[date]		= date('Y-m-d G:i:s', time());
		$col[type]		= 1;
		$col[owner]		= $userunq; //change 
		
		if (mysql_query(gendata("folder", $col, "INSERT")))
		{
			$web->msg("File recorded into database.");
		}
		else
		{
			$web->msg("Database error.");
		}
		echo '<p>';
		echo '  <b>Congratulations!</b><br />';
		echo '  Your '.$folder_name.' folder has been created successfully!';
		echo '</p>';
	
	}
	else
	{
		echo '<p>';
		echo '  <b>Opss!</b><br />';
		echo '  Your '.$folder_name.' album cannot be created. Please try again!';
		echo '</p>';
		
	}
	
}
else if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'create_album')
{
	$album_name = $_POST[album_name];
	if (isset($album_name))
	{
		$col[name]		= $album_name;
		$col[date]		= date('Y-m-d G:i:s', time());
		$col[type]		= 2;
		$col[owner]		= $userunq; //change 
		
		if (mysql_query(gendata("folder", $col, "INSERT")))
		{
			$web->msg("File recorded into database.");
		}
		else
		{
			$web->msg("Database error.");
		}
		echo '<p>';
		echo '  <b>Congratulations!</b><br />';
		echo '  Your '.$album_name.' folder has been created successfully!';
		echo '</p>';
	
	}
	else
	{
		echo '<p>';
		echo '  <b>Opss!</b><br />';
		echo '  Your '.$album_name.' album cannot be created. Please try again!';
		echo '</p>';
		
	}
	
}