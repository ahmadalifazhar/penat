<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Map</title>
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>

<?php 
if(!isset($_GET['latXX'])){
echo "Cannot Find Location, Please Contact Administrator";
}else{

$lat = $_GET['latXX'];
$lon = $_GET['lonYY'];	
$addr = $_GET['addr'];
$title = $_GET['title'];
$mapAddr = $_GET['mapAddr'];
}

?>
<script type="text/javascript">

var lat=<?php echo $lat ?>;
var lon=<?php echo $lon ?>;
var address = '<?php echo $addr ?>';
var title = '<?php echo $title ?>';


var map = null;

//load map
 var map = null;
            
      function getMap()
      {
         map = new Microsoft.Maps.Map(document.getElementById('PinItMap'), {
															  
								credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK',
								zoom: 16, 
								});
		 
		 pushPin()
		 
		 
      }
	  
	  
	  
 function pushPin()
      {
		
       // var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), null); 
        //map.entities.push(pushpin); 
		var infoboxOptions = {title:title, description:address,showCloseButton: false}; 
 		var defaultInfobox = new Microsoft.Maps.Infobox(map.getCenter(), infoboxOptions );    
 		map.entities.push(defaultInfobox);
		
        defaultInfobox.setLocation(new Microsoft.Maps.Location(lat,lon));
        map.setView({center: new Microsoft.Maps.Location(lat,lon)});
      }


</script>

</head>

<body onload="getMap()" class="metrouicss">

	
  <div id='PinItMap' style="position:relative;width:100%; height:450px;"></div>
  <blockquote><h3 style="color:blue">Address By Map : <?php echo $mapAddr ?></h3></blockquote>
</body>
</html>