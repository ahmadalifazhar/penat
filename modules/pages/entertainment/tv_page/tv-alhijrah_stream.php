<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pin-IT Entertainment</title>
<link href="../../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../../../metro/js/player/mediaelementplayer.css" />

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

</head>

<body class="metrouicss">

<embed allowfullscreen="true" allowscriptaccess="always" flashvars="src=http://202.73.9.10/demo/adobe/alhijrah_hqm/Manifest.f4m&amp;autoPlay=true" height="420" src="http://fpdownload.adobe.com/strobe/FlashMediaPlayback_101.swf" type="application/x-shockwave-flash" width="640">
	 
<?php

$myString = $_POST[myLocation];

echo $myString;

$detail[pid] = "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
$detail[ptext] = "is watching Tv Al-Hijrah Live Streaming via Pin-IT Entertainment";
$detail[lat] =  $account[alat];
$detail[lon] =  $account[alon];
$detail[locname] = ""; 
$detail[pcat] = 1200;
$detail[pdate] = date('Y-m-d G:i:s', time()); //Date of Post
$detail[ptype] = 0; //(0 = Post Status, 1=Status comment)
$detail[proot] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid
$detail[aid] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid 
if (mysql_query(gendata("posts", $detail, "INSERT")))
{
$web->msg("Your message has been posted");
}
else
$web->msg("Failed to posted");
?>   
  
</body>
</html>