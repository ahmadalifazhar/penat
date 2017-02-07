<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post a Job</title>

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
		var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);  
        geoLocationProvider.getCurrentPosition({ showAccuracyCircle: false });
		
		setTimeout(attachPushpinDragEndEvent,2000);
    }
      
      function attachPushpinDragEndEvent()
      {
        var pushpinOptions = {draggable:true}; 
        var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions); 
        var pushpindragend= Microsoft.Maps.Events.addHandler(pushpin, 'dragend', endDragDetails);  
        map.entities.push(pushpin); 
        //alert('stop dragging newly added pushpin to raise event');
      }
      
      endDragDetails = function (e) 
      {
		  var loc = e.entity.getLocation();
		  	  
        //alert("Event Info - start drag \n" + "Start Latitude/Longitude: " + e.entity.getLocation() ); 
		alert("lat : " + loc.latitude );
      }
	  
      </script>
<!-- -->

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
<body class="metrouicss" onload="getMap();" style="width:">
<form name="postJob" method="post" action="postJobProcess.php" >
Job Title:
<div class="input-control text" autofocus>
        <input type="text" name="jobTitle" id="jobTitle" required/>
        <button class="btn-clear"></button>
    </div>
    
Job Description :
<div class="input-control textarea">
        <textarea name="jobDescription" id="jobDescription"></textarea>
    </div>
    
    
Responsibilities :
<div class="input-control textarea">
        <textarea name="jobResponsibilities" id="jobResponsibilities"></textarea>
    </div> 
    
    
Requirements :
<div class="input-control textarea">
        <textarea name="jobRequirements" id="jobRequirements"></textarea>
    </div>
    
Salary Option:
<div class="input-control select">
        <select name="salary_type" id="salary_type">
        	<option value="N/A" selected="selected">N/A</option>
            <option value="Negotiable">Negotiable</option>
            <option value="Non-Negotiable">Non-Negotiable</option>
        </select>
    </div>
    
Job Category:
<div class="input-control select">
        <select name="jobCategory" id="jobCategory" required>
            <option selected disabled="disabled" value="">--Select Category--</option>
          <?php    
          $query_selectCat = "SELECT * FROM category GROUP BY jcat_name ASC ";
          $array_selectCat=mysql_query($query_selectCat) or die(mysql_error());
          while($rowCat=mysql_fetch_array($array_selectCat))
          { ?>
          <option value="<?php echo $rowCat['jcat_id']; ?>"><?php echo $rowCat['jcat_name']; ?></option>
          <?php
          }?>
        </select>
    </div>
    
Country:
<div class="input-control select">
        <select name="jobCountry" id="jobCountry" required>
            <option selected disabled="disabled" value="">--Select Country--</option>
          <?php    
          $query_selectCountry = "SELECT * FROM country GROUP BY country_name ASC ";
          $array_selectCountry=mysql_query($query_selectCountry) or die(mysql_error());
          while($rowCountry=mysql_fetch_array($array_selectCountry))
          { ?>
          <option value="<?php echo $rowCountry['country_code']; ?>"><?php echo $rowCountry['country_name']; ?></option>
          <?php
          }?>
        </select>
    </div>

Application Deadline:
<div class="input-control text datepicker" data-role="datepicker">
        <input type="text" name="jobDeadline" id="jobDealine"/>
        <button class="btn-date"></button>
    </div>
    
<div align="left">
<button type="button" id="useMyLocation" onclick="$('#myMap').hide(1000);" >Use Current Location</button><button type="button" id="onMapLocation" onclick="$('#myMap').show(1000);" >Pin Location on Map</button>
<div id='myMap' style="position:relative; width:100%; height:300px;display:none"></div>

</div>

<br />
<input type="hidden" name="jobLocation" id="jobLocation" />
<input type="hidden" name="jobLat" id="jobLat" />
<input type="hidden" name="jobLon" id="jobLon" />
<div align="right"><input type="reset"  value="Reset"/> <input type="submit" name="opchk" id="opchk" value="PostJob"></div>
</form>
</body>
</html>
