<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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
</head>
<style>
div.ex
{
width:220px;
height:75px;
padding:10px;
border:2px solid gray;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
margin:0px 0px 3px 0px;
}


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

<body class="metrouicss">

<?php

include "../../../config.php";
include "../../../accDB.php";
include "../../../functions.php";
include "../../../mailsys.php";
include "../../../account/accounts.sys.php";

$query = $_POST['video'];

if ($query =="")
{
	echo "you forgot to enter search term";
	exit;
}

echo $id_movie;


$min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM cloud
            WHERE (`location` LIKE '%".$query."%') OR (`type` LIKE '%".$query."%')") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results))
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                //echo "<p><h3>".$results['location']."</h3>".$results['type']."</p>";
				{
				if (($results['type']=="flv") || ($results['type']=="mp4") || ($results['type']=="3gp"))
				{
					//echo $results['location'];
					
					$baru = substr_replace($results['location'] ,"",-48); //buang unrelated last 48 character
					$baru_nd =  str_replace("_"," ",$baru); //replace underscore with space
					$baru_rd = substr($baru_nd, 0, 36); //just amik 36 character
					
					//echo $baru_rd;
					//echo " ".$results['type'];
					//echo "<br>";
					?>
                     
                    <div class="ex"><H5><?=$baru_rd;?> ...<br/><a href="/modules/pages/entertainment/test/try2.php?loc=<?php echo $results['location']; ?>&type=<?php echo $results['type']; ?>" target="iframe_z2"><span class="fg-color-pink"><i class="icon-play-alt"></i> Play media</a></H5></div>
        
<?php
        

				}
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }

?>
</body>
</html>