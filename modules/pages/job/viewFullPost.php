<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
<style>
html,
body {
   margin:0;
   padding:0;
   height:100%;
}
#container {
   min-height:100%;
   position:relative;
}
#header {
   padding:10px;
   background-color:#CCC
}
#body {
   padding:10px;
   /*padding-bottom:60px;   /* Height of the footer */
}
#footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;   /* Height of the footer */
}
#container {
   height:100%;
}
</style>
<?php 
if(!isset($_REQUEST['jid'])){
echo "No Job Id Found, Please Contact Administrator";
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
<title>View Full Post</title>
</head>
<body onload="getMap()" class="metrouicss">
<div id="container">
<!-- Start Header div -->
   <div id="header">
   <h3 align="center">Job Title:   <?php echo $title ?></h3>
   <h4 align="center"><em><?php echo $jobByIDArray['jCompanyName']; ?></em></h4>
   </div>
   <!-- End Header div -->
   <!-- Start body div -->
   <div id="body">
   
     <div class="body-text">
  <h3>Job Description :</h3>
 <?php echo $jobByIDArray['jdescription']; ?>
 <hr />
 <br />
 <h3>Job Responsibility :</h3>
	 <div class="body-text"><?php echo $jobByIDArray['jresponsibility']; ?>
     <hr />
 <br />
 <h3>Job Requirement :</h3>
  <?php echo $jobByIDArray['jrequirement']; ?>
  <hr />
  <br />
   <em>Category : <?php echo $jobByIDArray['jcategory']; ?> ,  
   Country : <?php echo $jobByIDArray['jcountry']; ?>,  
   State : <?php echo $jobByIDArray['jstate']; ?>
   Date Posted : <?php echo $jobByIDArray['TIMESTAMP']; ?></em>
   
   <hr />
     <br />
    <h3 style="color:#F00"><strong> Closing Date : <?php echo $jobByIDArray['jdeadline']; ?></strong></h3>
    <br /><br />
  <h3>Company Address :</h3>
    <?php echo $addr ?><br />
    Tel No : <?php echo $jobByIDArray['jCompanyTel']; ?><br />
    Email : <?php echo $jobByIDArray['jCompanyEmail']; ?><br />
	</div>
    
    <div id='PinItMap' style="position:relative;width:50%; height:200px; margin:auto" ></div>
     <blockquote >
  <h4 style="color:blue">This Job Was Posted at : <?php echo $mapAddr ?></h4>
  </blockquote>
   </div>
    <!-- End body div -->
</div>
</body>
<?php
  }
}
?>
</html>