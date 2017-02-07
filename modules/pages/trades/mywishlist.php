<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

if($_REQUEST["s"] == "success")
{
	echo "<script> alert('Your wish has been posted');</script>";
	//header('Location: index.php?op=trades');
}
if($_REQUEST["s"] == "success2")
{
	echo "<script> alert('Your wish has been posted');</script>";
	//header('Location: index.php?op=trades');
}

if($_REQUEST["s"] == "update")
{
	echo "<script> alert('Your product has been updated');</script>";
	header('Location: index.php?op=trades');
}

//link to database----------------------
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

$rawtrades = mysql_query("SELECT t.* FROM wishlist t WHERE t.aid='".$chkid."'") or die(mysql_error());
?>
<script type="text/javascript">
function makesure() {
  if (confirm('Are you sure to delete this item?')) {
    return true;
  }
  else {
    return false;
  }
 }
</script>
<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/modern/dialog.js" rel="stylesheet" type="text/css"/>

<!-- fancyapps -->
<script type="text/javascript" src="../../../metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../../../metro/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="../../../metro/js/fancyapps/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="../../../metro/js/fancyapps/source/jquery.fancybox.css" type="text/css" media="screen" />

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
<!-- -->


<title>Untitled Document</title>
</head>

<body class="metrouicss">
<br />
<a class="button default" href="newwish.php">
Wish New Product
</a>
<hr />

<table>
	<thead>
    	<tr>
        	<th width="15%">Image</th>
            <th width="42%" class="left">Details</th>
            <!--<th width="8%" class="left">Quantity</th>-->
            <th width="13%" class="left">Type</th>
            <th width="12%" class="left">Price</th>
            <td width="10%" class="left">Time</td>
		</tr>
    </thead>
    <tbody> 
    <?php
    while($trades = mysql_fetch_array($rawtrades))
	{
		if($trades['status']=="1" or $trades['status']=="2"){
		$price = number_format($trades['wprice'], 2, '.', '');
		?>
    	
        
<tr>
	<td rowspan="2">
    <div style="width:100px; height:100px; overflow:hidden">
		<a class="fancybox" rel="group" href="wish/<?php echo $trades['wpic']; ?>">
			<img style="max-width:100px ; height:auto" src="<?php echo 'wish/' . $trades['wpic'] ?>">
		</a>
    </div>
    </td>
	
	<td style="color:#333">
		<a href="wishdetail.php?wish=<?php echo $trades['wid']; ?>" onclick="window.open(this.href, 'child', 'scrollbars,width=800,height=600'); return false">
			<strong style="font-size:24px">
				<?php echo $trades['wtitle']; ?>
			</strong>
		</a>
	</td>
	<!--
    <td>
    	<?php echo $trades['tquantity']; ?>
    </td>
    -->
	<td>
		<?php echo $trades['wtype']; ?>
	</td>
	
	<td>
		RM <?php echo $price; ?>
	</td>
	
	<td style="font-size:9px; color:#F00" align="right">
		<?php echo $trades['wdate']; ?>
	</td>
</tr>
<tr>
	<td colspan="5" valign="top">
    <a href="wishstatus.php?id=<?php echo $trades['wid']; ?>&status=<?php echo $trades['status']; ?>">
    <?php
	if($trades['status']=="1")
		echo "<button class='bg-color-red'>Hide</button>";
	else if($trades['status']=="2")
		echo "<button class='bg-color-green'>Post</button>";
	?>
    </a>
    <a class="button default" href="updatewish.php?wish=<?php echo $trades['wid']; ?>">
    	update
    </a>
    <a class="button default" onclick="return makesure();" href="deletewish.php?id=<?php echo $trades['wid']; ?>">
    	delete
    </a>
    </td>
</tr>


    <?php
	}}?>
    </tbody>
</table>

</body>
</html>