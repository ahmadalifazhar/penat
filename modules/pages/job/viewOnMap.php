<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Location On Map</title>
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
<style>
.footer {
    position: fixed;
    bottom: 0;
    width: 100%;
}
</style>
<?php 
if(!isset($_REQUEST['jid'])){
echo "Cannot Find Location, Please Contact Administrator";
echo "javascript:window.close()";
}else{



$offlineDB = 'config/dbconnect.php';

if (file_exists($offlineDB)) {
    include("config/dbconnect.php");
} else {

include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
}
$jid = $_REQUEST['jid'];

$jobByID_query = mysql_query("SELECT * FROM jobpost WHERE jid=$jid");
	  
	  while($jobByIDArray = mysql_fetch_array($jobByID_query)){
		  
		  $lat = $jobByIDArray['jlat'];
		  $lon = $jobByIDArray['jlon'];
		  $addr = $jobByIDArray['jCompanyAddress'];
		  $title = $jobByIDArray['jtitle'];
		  $mapAddr = $jobByIDArray['jaddress'];
		  
	

?>
<script type="text/javascript">

var lat=<?php echo $lat ?>;
var lon=<?php echo $lon ?>;



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
		
        var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), null); 
        map.entities.push(pushpin); 
		//var infoboxOptions = {title:title, description:address,showCloseButton: false}; 
 		//var defaultInfobox = new Microsoft.Maps.Infobox(map.getCenter(), infoboxOptions );    
 		//map.entities.push(defaultInfobox);
		
        pushpin.setLocation(new Microsoft.Maps.Location(lat,lon));
        map.setView({center: new Microsoft.Maps.Location(lat,lon)});
      }


</script>

</head>

<body onload="getMap()" class="metrouicss">


  <div id='PinItMap' style="position:relative;width:100%; height:450px;"></div>
  <h3>Job Title:   <?php echo$title ?></h3>
  <address>
  Company Address : <br />
    <?php echo $addr ?>
    </address>
  
  <blockquote class="footer">
  <h4 style="color:blue">This Job Was Posted At : <?php echo $mapAddr ?></h4>
  </blockquote>
</body>
<?php
  }
}
?>
</html>