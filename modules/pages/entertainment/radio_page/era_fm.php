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

</head>




<body class="metrouicss">

  <table class="bordered" style="margin-top:10px;border:#FFF;border:hidden;">
        <tr>
        <td><img  width="135" height="135" src="modules/pages/entertainment/radio_page/images/era_logo2.jpg"/></td>
        <td align="right"><embed src="http://cdn.static.radioactive.sg/amp/public/20120413_1400/era/assets/swf/main.4.swf"></td>
        </tr>
       
    </table>
	 
<div id='PinItMap' style="position:relative;width:70%; height:580px;float:left;display:none;"></div>

<?php

$myString = $_POST[myLocation];

echo $myString;

$detail[pid] = "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
$detail[ptext] = "is listening Era Fm via Pin-IT Entertainment";
$detail[lat] =  $account[alat];
$detail[lon] =  $account[alon];
//$detail[ptext] = $_POST[msg]; //Retrieve textfield value from Design.hmtl
//$detail[lat] = $_POST[plat]; //Current account's Latitude
//$detail[lon] = $_POST[plon]; //Current account's Longtitude
$detail[locname] = ""; //Problems since IFRAME, use 0 instead of $_POST[locname]
//Your subsystem/module category ID, refer to http://www.pin-it.tk/new/?op=files..
// default must be XXYY (Example 1301)
// XX = Reference ID, only 11-17
// YY = sub-reference, its up to you
// Example are Below:
//ref format : [sys name]/[sys ver]/[sys devel month]/[class]/[ref no].[no ver: a-z]
//ref: pinit/01/04/00/xxx.x (Root System)
//ref: pinit/01/04/01/xxx.x (Account System)
//ref: pinit/01/04/02/xxx.x (Profile System)
//ref: pinit/01/04/03/xxx.x (Geo-map System)
//ref: pinit/01/04/04/xxx.x (Setting System)
//ref: pinit/01/04/05/xxx.x (Chat/MSG System)
//ref: pinit/01/04/06/xxx.x (Geo-map System)
//ref: pinit/01/04/07/xxx.x (- System) *Reserved*
//ref: pinit/01/04/08/xxx.x (- System) *Reserved*
//ref: pinit/01/04/09/xxx.x (- System) *Reserved*
//ref: pinit/01/04/10/xxx.x (- System) *Reserved*
//ref: pinit/01/04/11/xxx.x (Jobs SubSystem)
//ref: pinit/01/04/12/xxx.x (Entertainment SubSystem)
//ref: pinit/01/04/13/xxx.x (Transportation SubSystem)
//ref: pinit/01/04/14/xxx.x (Cloud SubSystem)
//ref: pinit/01/04/15/xxx.x (Education SubSystem)
//ref: pinit/01/04/16/xxx.x (Trades SubSystem)
//ref: pinit/01/04/17/xxx.x (Shopping Tracker SubSystem)
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