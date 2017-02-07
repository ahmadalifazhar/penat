<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Set Shopping Mall</title>

<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="metro/js/player/mediaelementplayer.css" />
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/assets/moment.js"></script>
<script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="metro/js/modern/carousel.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
<script type="text/javascript" src="metro/js/tinybox/tinybox.js"></script>
<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
<script type="text/javascript" src="js/mapfix.js?remcache=__CACHE__"></script>
<script type="text/javascript" src="js/mapfix.js"></script>

<!-- map -->
<script type="text/javascript" src="js/mapcontrol.ashx?v=7.0"></script>

<script type="text/javascript">
      var map = null;
	  var latUserLocation = null;
var lonUserLocation =null;
            
    function getMap()       
    {
        Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() 
        {
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), 
            { 
                  credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK', 
                  theme: new Microsoft.Maps.Themes.BingTheme(),
				  showMapTypeSelector: false,
				  enableClickableLogo: false,
				  enableSearchLogo: false
				  
            }); 
        }});

    }
      
	  
	  function getCurrentLocation(){
		
		var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);  
        geoLocationProvider.getCurrentPosition({ showAccuracyCircle: false,successCallback:displayCenter });
	  }
	  
	   function getDragLocation(){
		
		var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);  
        geoLocationProvider.getCurrentPosition({ showAccuracyCircle: false,successCallback:attachPushpinDragEndEvent });
	  }
	  
	  
	   function displayCenter(args)
         {
			var loc = args.center;
			
			latUserLocation = loc.latitude;
			lonUserLocation = loc.longitude;
			
			document.getElementById('lat').value = loc.latitude;
			document.getElementById('lon').value = loc.longitude;
			Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });

		 }
		 
      function attachPushpinDragEndEvent()
      {	
        var pushpinOptions = {draggable:true}; 
        var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions); 
        var pushpindragend= Microsoft.Maps.Events.addHandler(pushpin, 'dragend', endDragDetails);  
        map.entities.push(pushpin); 
      }
      
      endDragDetails = function (e) 
      {
		  var loc = e.entity.getLocation();
		  
		document.getElementById('lat').value = loc.latitude;
		document.getElementById('lon').value = loc.longitude;
		latUserLocation = loc.latitude;
		lonUserLocation = loc.longitude;
		Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });
      }
	
function searchModuleLoaded()
      {
		 
         var searchManager = new Microsoft.Maps.Search.SearchManager(map);

         var reverseGeocodeRequest = {location:new Microsoft.Maps.Location(latUserLocation,lonUserLocation), count:10, callback:reverseGeocodeCallback, errorCallback:errCallback};
         searchManager.reverseGeocode(reverseGeocodeRequest);
      }
	  
     
      function reverseGeocodeCallback(result, userData)
      {
         document.getElementById("address").value = result.name;
		 document.getElementById('viewLocation').innerHTML = "Shopping Mall Will Be Pinned At : "+result.name;
      }


      function errCallback(request)
      {
 
      }
	  
      </script>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

function isNumberKey(evt)
{
if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode==46)|| (event.keyCode==8) || (event.keyCode==9)|| (event.keyCode==17) || (event.keyCode==86)))
event.returnValue=false;
}
</script>

<?php 
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
?>

</head>
<body class="metrouicss" onload="getMap();getCurrentLocation();">
<div style="padding:10px">
<form name="post" method="post" action="?op=shopping" >
				<p class="normal"><strong>Shopping Title :</strong>
					<div class="input-control text" autofocus>
						<input type="text" placeholder="Enter Shopping Title" name="Title" id="shoppingTitle" maxlength="100" onKeyDown="limitText(this.form.shoppingTitle,this.form.countdown,500);" onKeyUp="limitText(this.form.shoppingTitle,this.form.countdown,500);" required />
						<button class="btn-clear"></button>
						<font size="2" style="float:right"> <input readonly type="text" name="countdown" size="1" value="100" disabled="disabled"> characters left.</font>
				</div></p>
				<br />
				<p class="normal"><strong>Description :</strong>
					<div class="input-control textarea">
							<textarea name="Description" placeholder="Enter Description to be Post" id="Description" onKeyDown="limitText(this.form.Description,this.form.countdown1,2000);" onKeyUp="limitText(this.form.Description,this.form.countdown1,2000);" required></textarea>
							<font size="2" style="float:right"> <input readonly type="text" name="countdown1" size="1" value="2000" disabled="disabled"> characters left.</font>
						</div></p>
				<br />
				<p class="normal"><strong>Company Address:</strong>
						<div class="input-control textarea">
							<textarea placeholder="Enter Company Address" name="Address" id="companyAddress" onKeyDown="limitText(this.form.companyAddress,this.form.countdown4,500);" onKeyUp="limitText(this.form.companyAddress,this.form.countdown4,500);"></textarea>
							<font size="2" style="float:right"> <input readonly type="text" name="countdown4" size="1" value="500" disabled="disabled"> characters left.</font>
						</div></p>
						</br>
				<p class="normal"><strong>Company Name :</strong>
						<div class="input-control text" autofocus>
							<input type="text" placeholder="Enter Company Name" name="name" id="name" maxlength="200" onKeyDown="limitText(this.form.name,this.form.countdown3,500);" onKeyUp="limitText(this.form.name,this.form.countdown3,500);" required/>
							<button class="btn-clear"></button>
							<font size="2" style="float:right"> <input readonly type="text" name="countdown3" size="1" value="200" disabled="disabled"> characters left.</font>
						</div></p>
						</br>
				<p class="normal"><strong>Contact Number :</strong>
						<div class="input-control text" autofocus>
							<input type="text" placeholder="Enter Company Contact Number" name="contactno" id="contactno" maxlength="20" onKeyDown="limitText(this.form.contactno,this.form.countdown5,500);" onKeyUp="limitText(this.form.contactno,this.form.countdown5,500);" required/>
							<button class="btn-clear"></button>
							<font size="2" style="float:right"> <input readonly type="text" name="countdown5" size="1" value="20" disabled="disabled"> characters left.</font>
						</div></p>
						</br>
				<p class="normal"><strong>E-mail :</strong>
						<div class="input-control text" autofocus>
							<input type="text" placeholder="Enter Email Address" name="email" id="email" maxlength="500" onKeyDown="limitText(this.form.email,this.form.countdown5,500);" onKeyUp="limitText(this.form.email,this.form.countdown5,500);" required/>
							<button class="btn-clear"></button>
							<font size="2" style="float:right"> <input readonly type="text" name="countdown5" size="1" value="500" disabled="disabled"> characters left.</font>
						</div></p>
						</br>
				<p class="normal"><strong>Country:</strong>
					<div class="input-control select">
						<select name="Country" id="Country" required>
							<option selected disabled="disabled" value=""><strong>-- Select Country --</strong></option>
							__COUNTRYLIST__
						</select>
					</div></p>
					<br />
				<p class="normal"><strong>Date of Promotion Start:&nbsp;&nbsp;</strong>
						<input type="date" name="Startdate" id="Startdate" min="__DATENOW__" required/>
					
				<span class="tab"><strong>Date of Promotion End:&nbsp;&nbsp;</strong>
						<input type="date" name="Deadline" id="Deadline" min="__DATENOW__" required/></span></p>	
				<br />
				<br/>
				<p><p class="normal"><strong> Your current location/address:</strong></p></p>
                  <p style="color:blue"> <strong>__ALOCNAME__</strong><strong></strong><strong></strong><br/>
                  </p>
				<br /><br/>
				<input type="hidden" name="address" id="address" />
				<input type="hidden" name="lat" id="lat" value="__ALAT__" />
				<input type="hidden" name="lon" id="lon" value="__ALON__"/>
				<div align="right"><input type="reset"  value="Reset" style="font-weight:bold"/> <input type="submit" name="opchk" id="opchk" value="Post" style="font-weight:bold"></div>
				</form>
</div>
</body>
</html>