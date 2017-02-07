<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<script type="text/JavaScript" src="js/tinybox/tinybox.js"></script> 

<title>Product Detail</title>

<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

$tid = $_GET['product'];

$rawproduct = mysql_query("SELECT * FROM trades WHERE tid='".$tid."'") or die(mysql_error());
$product = mysql_fetch_array($rawproduct);
$price = number_format($product['tprice'], 2, '.', '');
$tdescription = nl2br(htmlspecialchars(stripslashes($product['tdescription'])));

$rawuser = mysql_query("SELECT afname, alname, auname FROM accounts WHERE aid='".$product['aid']."'") or die(mysql_error());
$user = mysql_fetch_array($rawuser);
?>

<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/player/mediaelementplayer.css" rel="stylesheet" type="text/css"/>

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

<script type="text/javascript" src="js/mapcontrol.ashx?v=7.0"></script>

<script type="text/javascript">
      var map = null;
            
    function getMap()       
    {
        Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() 
        {
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), 
            { 
                  credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK', 
                  theme: new Microsoft.Maps.Themes.BingTheme(),
				  showMapTypeSelector: false,
				  enableClickableLogo: false,
				  enableSearchLogo: false
				  
            }); 
        }});
		setTimeout(setView,1500);
		setTimeout(PushpinLocation,1500);
    } 
	
	function PushpinLocation()
	{
		var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), null); 
		map.entities.push(pushpin); 
		pushpin.setLocation(new Microsoft.Maps.Location(<?php echo $product['tlat']; ?>, <?php echo $product['tlon']; ?>));
	}
	
	function setView()
	{
		map.setView({zoom: 14, center: new Microsoft.Maps.Location(<?php echo $product['tlat']; ?>, <?php echo $product['tlon']; ?>)});
	}
</script>
<!-- -->


</head>

<body class="metrouicss"  onload="getMap();">

<table class="striped">
	<tr>
        <td colspan="3" style="color:#F00"><h1 style="color:#333"><?php echo $product['ttitle']; ?></h1>(<?php echo $product['tdate']; ?>)</td>
    </tr>
    <tr>
    	<td colspan="4"><a href="savedads.php?aid=<?php echo $chkid; ?>&tid=<?php echo $product['tid']; ?>"><button class="standart default">Save Ads</button></a></td>
    </tr>
	<tr>
        <td width="20%">Price</td>
        <td><h4>RM <?php echo $price; ?></h4></td>
    </tr>
    <tr>
        <td>Owner</td>
        <td><a href="#" onClick="openTab=false;TINY.box.show
                                 ({iframe:'pinit.php?profile=<?php echo $product['aid']; ?>',boxid:'frameless',width:400,height:250,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function()
                                 {openTab = true;loadLog();closeJS()}})" title="Profile"><?php echo $user['afname']." ".$user['alname']." (".$user['auname'].")"; ?></a></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><?php echo $product['ttype']; ?></td>
    </tr>
    <tr>
        <td valign="top">Quantity</td>
        <td><?php echo $product['tquantity']; ?></td>
    </tr>
    <tr>
        <td valign="top">Description</td>
        <td><?php echo $tdescription; ?></td>
    </tr>
    <tr>
    	<td valign="top">Image</td>
        <td>
        <div style="width:400px; height:400px; overflow:hidden">
        <a class="fancybox" rel="group" href="files/<?php echo $product['tpic']; ?>">
        <img style="max-width:400px ; height:auto" src="<?php echo 'files/' . $product['tpic'] ?>"/>
        </a>
        </td>
    </tr>
    <tr>
        <td valign="top">Location</td>
        <td><div id='myMap' style="position:relative; width:100%; height:300px;"></div></td>
    </tr>
</table>

</body>
</html>