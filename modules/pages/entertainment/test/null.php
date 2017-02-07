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






<a href=""    class="player"
    style="display:block;width:640x;height:390px;margin:10px auto;align:left;"
    id="player">
    </a>
<script>
// install flowplayer
$f("player", "http://releases.flowplayer.org/swf/flowplayer-3.2.16.swf");

// place embedding code to the textarea
document.getElementById("embedcode").innerHTML = $f().embed().getEmbedCode();
</script>


</body>
</html>