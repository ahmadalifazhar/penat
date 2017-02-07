<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
//link to database----------------------
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

$rawtrades = mysql_query("SELECT t.* FROM trades t WHERE t.aid='".$chkid."'") or die(mysql_error());
?>

<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/modern/dialog.js" rel="stylesheet" type="text/css"/>

<title>Untitled Document</title>
</head>

<body class="metrouicss">
<br />




<table>
	<thead>
    	<tr>
        	<th width="15%">Image</th>
            <th width="50%" class="left">Details</th>
            <th width="15%" class="left">Type</th>
            <th width="10%" class="left">Price</th>
            <td width="10%" class="left">Time</td>
		</tr>
    </thead>
    <tbody> 
    <?php
    while($trades = mysql_fetch_array($rawtrades))
	{
		$price = number_format($trades['tprice'], 2, '.', '');
		?>
    	
        
<tr>
	<td rowspan="2">
		<a href="files/<?php echo $trades['tpic']; ?>" rel="lightbox">
			<img src="<?php echo 'files/' . $trades['tpic'] ?>" width="100%" height="100%">
		</a>
    </td>
	
	<td style="color:#333">
		<a href="productdetail.php?product=<?php echo $trades['tid']; ?>" onclick="window.open(this.href, 'child', 'scrollbars,width=800,height=600'); return false">
			<strong style="font-size:24px">
				<?php echo $trades['ttitle']; ?>
			</strong>
		</a>
	</td>
	
	<td>
		<?php echo $trades['ttype']; ?>
	</td>
	
	<td>
		RM <?php echo $price; ?>
	</td>
	
	<td style="font-size:9px; color:#F00" align="right">
		<?php echo $trades['tdate']; ?>
	</td>
</tr>
<tr>
	<td colspan="4" valign="top">
    <a href="productstatus.php?id=<?php echo $trades['tid']; ?>&status=<?php echo $trades['status']; ?>">
    <?php
	if($trades['status']=="1")
		echo "<button class='bg-color-red'>Hide</button>";
	else if($trades['status']=="2")
		echo "<button class='bg-color-green'>Post</button>";
	?>
    </a>
    <a class="button default">
    	update
    </a>
    <a class="button default">
    	delete
    </a>
    </td>
</tr>
    <?php
	}?>
    </tbody>
</table>

</body>
</html>