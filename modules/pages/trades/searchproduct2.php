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

<!-- fancyapps -->
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

<?php
$searchP = $_POST['partialProductName'];
$rawtrades = mysql_query("SELECT t.* FROM trades t WHERE t.status=1 AND t.ttitle LIKE '%$searchP%' ORDER BY t.tdate DESC") or die(mysql_error());
?>
</head>

<body class="metrouicss">

<table>
	<thead>
    	<tr>
        	<th width="15%">Image</th>
            <th width="42%" class="left">Details</th>
            <th width="8%" class="left">Quantity</th>
            <th width="13%" class="left">Type</th>
            <th width="12%" class="left">Price</th>
            <td width="10%" class="left">Time</td>
		</tr>
    </thead>
    <tbody> 
    <?php
    while($trades = mysql_fetch_array($rawtrades))
	{
		$rawuser = mysql_query("SELECT auname FROM accounts WHERE aid = '".$trades['aid']."'") or die(mysql_error());
		$user = mysql_fetch_array($rawuser);
		$price = number_format($trades['tprice'], 2, '.', '');
		?>
    	
        
<tr>
	<td rowspan="2">
    <div style="width:100px; height:100px; overflow:hidden">
		<a class="fancybox" rel="group" href="files/<?php echo $trades['tpic']; ?>">
			<img style="max-width:100px ; height:auto" src="files/<?php echo $trades['tpic']; ?>">
		</a>
    </div>
    </td>
	
	<td style="color:#333">
		<a href="productdetail.php?product=<?php echo $trades['tid']; ?>" onclick="window.open(this.href, 'child', 'scrollbars,width=800,height=600'); return false">
			<strong style="font-size:24px">
				<?php echo $trades['ttitle']; ?>
			</strong>
		</a>
		(<a href="pinit.php?profile=<?php echo $trades['aid']; ?>" onclick="window.open(this.href, 'child', 'scrollbars,width=400,height=250'); return false"><?php echo $user['auname']; ?></a>)
	</td>
	<td align="center">
    	<?php echo $trades['tquantity']; ?>
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
	<td colspan="5"></td>
</tr>
    <?php
	}?>
    </tbody>
</table>
</body>
</html>