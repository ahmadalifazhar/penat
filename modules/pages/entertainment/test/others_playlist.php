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
<script type="text/javascript" src="../../../../metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../../../../metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../../../../metro/js/assets/moment.js"></script>
<script type="text/javascript" src="../../../../metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/dialog.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/accordion.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/carousel.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/rating.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/slider.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/tile-slider.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/tile-drag.js"></script>
<script type="text/javascript" src="../../../../metro/js/modern/calendar.js"></script>
<script type="text/javascript" src="../../../../metro/js/tinybox/tinybox.js"></script>
<script type="text/javascript" src="metro/js/player/mediaelement-and-player.js"></script>
<script type="text/javascript" src="metro/js/player/audio-player.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="http://releases.flowplayer.org/js/flowplayer-3.2.12.min.js"></script>
<title>Untitled Document</title>
</head>

<?php
session_start();
$_SESSION["friend_id"] = "888";
?>

<?php

include "../../../config.php";
include "../../../accDB.php";
include "../../../functions.php";
include "../../../mailsys.php";
include "../../../account/accounts.sys.php";

?>


<body class="metrouicss">

<?php

$friend_id = $_GET['faid'];

//echo $friend_id;
//echo "blank page";
$rawuser = mysql_query("SELECT a.* FROM accounts a WHERE a.aid = '".$friend_id."'");
$saya = mysql_fetch_array($rawuser);

?>

<?php
session_start();
$_SESSION["friend_id"] = $friend_id;
$_SESSION["friends_name"] = $saya[afname];

//echo $_SESSION["friends_name"];
?>


<div class="page">
        <div class="page-header">
            <div class="page-header-content">
            <h1> Welcome to <span class="fg-color-pink"><?=$saya[afname]; ?>'s </span>playlist.</h1>
            </div>
        </div>
 
        <div class="page-region">
            <div class="page-region-content">
                <!-- page region content -->
                		
                         <div class="page-control" data-role="page-control">
                            <!-- Responsive controls -->
                            <span class="menu-pull"></span> 
                            <div class="menu-pull-bar"></div>
                            <!-- Tabs -->
                            <ul>
                                <li class="active"><a href="#frame1">Videos Playback</a></li>
                            </ul>
                            
                            <div class="frames">
                                <div class="frame active" id="frame1">
                               
                                <iframe frameborder="0" width="640" name="iframe_a" height="550" src="null.php"></iframe>
                                <iframe style="margin-top:10px;" frameborder="0" width="250" src="null2.php" height="390" align="top"></iframe> 
                               
                              
                                </div>
                            </div>
                        </div>
                        
                <!-- page region content -->
            </div>
        </div>
    </div>
   
    
    
</body>
</html>