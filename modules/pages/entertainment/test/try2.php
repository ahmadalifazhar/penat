<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../../../metro/js/player/mediaelementplayer.css" />

<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/assets/moment.js"></script>
<script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="metro/js/modern/dialog.js"></script>
<script type="text/javascript" src="metro/js/modern/accordion.js"></script>
<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="metro/js/modern/carousel.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="metro/js/modern/rating.js"></script>
<script type="text/javascript" src="metro/js/modern/slider.js"></script>
<script type="text/javascript" src="metro/js/modern/tile-slider.js"></script>
<script type="text/javascript" src="metro/js/modern/tile-drag.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
<script type="text/javascript" src="metro/js/tinybox/tinybox.js"></script>
<script type="text/javascript" src="metro/js/player/mediaelement-and-player.js"></script>
<script type="text/javascript" src="metro/js/player/audio-player.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="http://releases.flowplayer.org/js/flowplayer-3.2.12.min.js"></script>
<title>Untitled Document</title>
</head>

<?php

include "../../../config.php";
include "../../../accDB.php";
include "../../../functions.php";
include "../../../mailsys.php";
include "../../../account/accounts.sys.php";

//echo $chkid;
//echo "<br>";

$rawuser = mysql_query("SELECT a.* FROM accounts a WHERE a.aid = '".$chkid."'");
$saya = mysql_fetch_array($rawuser);

//echo $saya[afname];
//echo "<br>";

$location = $_GET['loc'];
$type = $_GET['type'];

//echo "<br>";
//echo $location."<br>";
//echo $type."<br>";
//echo $chkid."<br>";

?>

<style>
#embedcode {
    border:1px solid #ddd;
    margin:0 240px;
    width: 500px;
    height: 124px;
    overflow:hidden;
}
</style>

<body class="metrouicss">

<!--<form>

file name on ftp : <input value="<?=$location ?>" /></br>
file type : <input value="<?=$type ?>" /></br>
user id folder name : <input value="<?=$chkid ?>" /></br> */

</form> -->

<?php
		$baru = substr_replace($location ,"",-48); //buang unrelated last 48 character
		$baru_nd =  str_replace("_"," ",$baru); //replace underscore with space
		$baru_rd = substr($baru_nd, 0, 70); //just amik 36 character
?>

<?php   
	   $query_views = mysql_query("SELECT c.* FROM cloud c WHERE c.location = '$location'");
	   while($query_views_result = mysql_fetch_array($query_views))
	   $total_views = $query_views_result['views'];   
?>

<?php
$final = "http://www.pinit.uni.me/modules/pages/cloud/files/$chkid/$location";
//echo $final; 
?>

<a href="<?=$final ?>"    class="player"
    style="display:block;width:640x;height:390px;margin:10px auto;align:left;"
    id="player">
    </a>
<script>
// install flowplayer
$f("player", "http://releases.flowplayer.org/swf/flowplayer-3.2.16.swf");

// place embedding code to the textarea
document.getElementById("embedcode").innerHTML = $f().embed().getEmbedCode();
</script>
<table style="border-style:none">
       <tr>
       <td style="border-style:none">Title : <?=$baru_rd ?> ...</td>
       </tr>
        <tr>
       <td style="border-style:none"><?=$total_views; ?> views</td>
       </tr>
       <tr>
       <td style="border-style:none">Type : <?=$type ?></td>
       </tr>
       <tr>
       <td style="border-style:none"><i class="icon-share-3"></i><a href="#" onclick="window.open('process_nofi.php?title=<?php echo $baru_nd; ?>', 'StatusBar', 'toolbar=no,resizable=no,scrollbars=no,width=500,height=100,left=300,top=300');"> Share My Activity</a></td>
       </tr>
    </table> 

</body>
</html>