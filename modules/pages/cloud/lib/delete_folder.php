<?php 
if ((isset ($_REQUEST[folder_id])) && (isset($_REQUEST[owner_id])))
{
	
	$db = new dbcon("localhost", "root", "", "blur");
	$db->setStatus(0);
	$q1 = "DELETE FROM folder WHERE folder_id = ".$_REQUEST[folder_id]." AND owner = '".$_REQUEST[owner_id]."'";
	$db->query($q1);
	$q2 = "DELETE FROM cloud WHERE folder_id = ".$_REQUEST[folder_id]." AND owner = '".$_REQUEST[owner_id]."'";
	$db->query($q2);
	echo "Folder had been deleted!";
}
?>