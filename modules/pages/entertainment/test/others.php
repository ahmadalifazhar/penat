<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link href="../../../../metro/css/modern.css" rel="stylesheet">
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
<script type="text/javascript" src="../../../../metro/js/modern/accordion.js"></script>
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

<body class="metrouicss">
<style>
div.ex
{
width:218px;
height:90px;
padding:10px;
border:2px solid gray;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
margin:0px 3px 3px 0px;
float:left;
}

/* For the "inset" look only */

body {
    position: absolute;

    overflow-y: scroll;
    overflow-x: hidden;
}

/* Let's get this party started */
::-webkit-scrollbar {
    width: 8px;
}
 
/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 10px;
    border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background:#8b008b ;
    -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
	background: rgba(255,0,0,0.4); 
}
</style>

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

//echo "---------------------------------------------------------------";

$friend_list = mysql_query("SELECT a.* FROM friends a WHERE a.aid = '".$chkid."'");
while($friend_id = mysql_fetch_array($friend_list))
{
	//echo "<br>";
	//echo $friend_id['faid'];
	
	
	$rawuser = mysql_query("SELECT a.* FROM accounts a WHERE a.aid = '".$friend_id['faid']."'");
	$saya = mysql_fetch_array($rawuser);
	
	//echo $saya[afname]."<br>";
	
			$zz = 0;
			$list_down_own_media = mysql_query("SELECT c.* FROM cloud c WHERE c.owner = '".$friend_id['faid']."'");
			while($listed_own_media = mysql_fetch_array($list_down_own_media))
			{
				if(($listed_own_media['type']=="3gp") || ($listed_own_media['type']=="flv") || ($listed_own_media['type']=="mp4"))
				{	
					$zz++;
					//echo $listed_own_media['location'];
					//echo $listed_own_media['type']."<br>";	
				}

			}
			if ($zz == 0)
			{
			//echo " 0 Video files in playlist<br>";
			}
			else
			{
				//echo $zz . "Video files in playlist<br>";
			}
			
			//echo "---------------------------------------------------------------";
			
			?>
                   <!-- <ul class="listview" style="margin-left:5px;">
						<li class="bg-color-teal">
                            <div class="icon" style="margin-top:-1px;">
                                <i class="icon-play"></i>
                            </div>

                            <div class="data">
                                <h4><span class="fg-color-white"><H3><span class="fg-color-white"><?=$saya[afname] ?></span></H3></span></h4>
                                <div>
                                   <p><span class="fg-color-white"><?=$zz ?> video files in playlist</span></p>
                                </div>
                                <p><a href="/modules/pages/entertainment/test/others_playlist.php?faid=<?php echo $friend_id['faid']; ?>" target="_blank"><span class="fg-color-white">go to playlist</span></a></p>
                            </div>
                        </li>
                     </ul> -->
                     
                     <div class="ex">
                    <H3><span class="fg-color-blue"><?=$saya[afname] ?></span></H3>
                     <H6><span class="fg-color-blue"><?=$zz ?> video files in playlist</span><br/><a href="/modules/pages/entertainment/test/others_playlist.php?faid=<?php echo $friend_id['faid']; ?>" target="_blank"><span class="fg-color-blue">go to playlist</span></a></H6>
                    <H6></H6>
                     </div>
			<?php
			
			
}
?>
   
   


</body>
</html>