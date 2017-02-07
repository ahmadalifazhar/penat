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
<title>Notification</title>


</head>    

<body class="metrouicss">
<?php
	
	
	$title = $_GET['title'];
	
	include "../../../config.php";
	include "../../../accDB.php";
	include "../../../functions.php";
	include "../../../mailsys.php";
	include "../../../account/accounts.sys.php";
	
	$detail[pid] = "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
	//$detail[ptext] = "is watching via Pin-It Entertainment";
	$detail[ptext] = "is watching ".$title." via Pin-It Entertainment";
	$detail[lat] =  $account[alat];
	$detail[lon] =  $account[alon];
	$detail[locname] = ""; //Problems since IFRAME, use 0 instead of $_POST[locname]
	$detail[pcat] = 1200;
	$detail[pdate] = date('Y-m-d G:i:s', time()); //Date of Post
	$detail[ptype] = 0; //(0 = Post Status, 1=Status comment)
	$detail[proot] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid
	$detail[aid] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid 
	(mysql_query(gendata("posts", $detail, "INSERT")))
	
	
	
?>
<H1><strong>Notification</strong></H1>
<H4>Your activity has been added to newsfeed</H4>
</body>
</html>
