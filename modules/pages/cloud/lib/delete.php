<?php 
if (isset ($_REQUEST[id_to_delete]))
{
	$db = new dbcon("localhost", "root", "", "blur");
	$db->setStatus(0);
	$q = "DELETE FROM cloud WHERE cloud_id = ".$_REQUEST[id_to_delete]."";
	$db->query($q);
	
}













?>