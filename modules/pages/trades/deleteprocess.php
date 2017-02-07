<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>
</head>

<body onload="myFunction();">

<?php
$tid = $_GET['id'];
?>

<script type="text/javascript">
function myFunction()
{
	var x;
	var r=confirm("Are you sure to delete this item?");
	if (r==true)
	{
		window.location = 'deleteprocess2.php?id=<?php echo $tid; ?>';
	}
	else
	{
		window.location = 'myproduct.php';
	}
}
</script>

</body>
</html>