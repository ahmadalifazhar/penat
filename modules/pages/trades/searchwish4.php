<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
//include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------
?>

<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../../metro/js/assets/jquery-1.9.0.min.js"></script>

<!-- lightbox 
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/lightbox.js"></script>
<link href="css/lightbox.css" rel="stylesheet" />
<!-- -->



<title>Untitled Document</title>

<?php
echo "searchwish4";
$ptype = $_POST['ptype'];
if($ptype=="all")
{
	$rawwish = mysql_query("SELECT w.* FROM wishlist w WHERE w.status=1 ORDER BY w.wdate DESC") or die(mysql_error());
}
else
{
	$rawwish = mysql_query("SELECT w.* FROM wishlist w WHERE w.status=1 AND w.wtype='$ptype' ORDER BY w.wdate DESC") or die(mysql_error());
}
//$rawwish = mysql_query("SELECT w.* FROM wishlist w WHERE w.status=1 
//					                                 AND w.wtype='$ptype'
//													 AND w.wtitle LIKE '%$searchP%' ORDER BY t.tdate DESC") or die(mysql_error());
?>
</head>

<body class="metrouicss">

<table>
	<thead>
    	<tr>
        	<th width="15%">Image</th>
            <th width="47%" class="left">Details</th>
            <th width="15%" class="left">Type</th>
            <th width="13%" class="left">Price</th>
            <td width="10%" class="left">Time</td>
		</tr>
    </thead>
    <tbody> 
    <?php
    while($wish = mysql_fetch_array($rawwish))
	{
		$rawuser = mysql_query("SELECT auname FROM accounts WHERE aid = '".$wish['aid']."'") or die(mysql_error());
		$user = mysql_fetch_array($rawuser);
		$price = number_format($wish['wprice'], 2, '.', '');
		?>
    	
        
<tr>
	<td rowspan="2">
		<a href="wish/<?php echo $wish['wpic']; ?>" rel="lightbox">
			<img src="<?php echo 'wish/' . $wish['wpic'] ?>" width="100%" height="100%">
		</a>
    </td>
	
	<td style="color:#333">
		<a href="wishdetail.php?wish=<?php echo $wish['wid']; ?>" onclick="window.open(this.href, 'child', 'scrollbars,width=800,height=600'); return false">
			<strong style="font-size:24px">
				<?php echo $wish['wtitle']; ?>
			</strong>
		</a>
		(<a href="pinit.php?profile=<?php echo $wish['aid']; ?>" onclick="window.open(this.href, 'child', 'scrollbars,width=400,height=250'); return false"><?php echo $user['auname']; ?></a>)
	</td>
	
	<td>
		<?php echo $wish['wtype']; ?>
	</td>
	
	<td>
		RM <?php echo $price; ?>
	</td>
	
	<td style="font-size:9px; color:#F00" align="right">
		<?php echo $wish['wdate']; ?>
	</td>
</tr>
<tr>
	<td colspan="4"></td>
</tr>
    <?php
	}?>
    </tbody>
</table>

</body>
</html>