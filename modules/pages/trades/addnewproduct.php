<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- style -->
<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../metro/js/player/mediaelementplayer.css" rel="stylesheet" type="text/css"/>
<!-- -->

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

<title>Untitled Document</title>
</head>

<body class="metrouicss" onload="getMap();">
<div style="width:97%">
<form id="form1" name="form1" method="post" action="../../../index.php?op=trades$go=upload"  enctype="multipart/form-data">
<table>
	<tr>
    	<td width="15%">Category</td>
        <td>
        <div class="input-control select" style="width:50%">
			<select>
            	<option selected="selected" disabled="disabled" value="unchecked">Select item category</option>
            	<option value="Vehicles">Vehicles</option>
                <option value="Properties">Properties</option>
                <option value="Electronics">Electronics</option>
                <option value="Personal Items">Personal Items</option>
                <option value="Hobbies">Hobbies</option>
                <option value="Services">Services</option>
                <option value="Others">Others</option>
            </select>
        </div>
        </td>
    </tr>
    <tr>
    	<td>Title</td>
        <td>
        <div class="input-control text">
			<input type="text" placeholder="Enter item title"/>
			<button class="btn-clear" tabindex="-1" type="button" />
		</div>
        </td>
    </tr>
    <tr>
    	<td>Description</td>
        <td>
    	<div class="input-control textarea">
			<textarea placeholder="Item description"></textarea>
		</div>
    	</td>
    </tr>
    <tr>
    	<td>Location</td>
        <td><div id='myMap' style="position:relative; width:100%; height:300px;"></div></td>
    </tr>
    <tr>
    	<td>Picture</td>
        <td><label for="file">Filename:</label>
			<input type="file" name="file" id="file">
            <input type="hidden" name="action" value="trades" />
        </td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit"  /></td>
    </tr>
</table>
</form>


</div>
</body>
</html>