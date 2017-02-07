<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Driving Route</title>
  <script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>

<?php 
if(!isset($_GET['latXX'])){
echo "Cannot Find Location, Please Contact Administrator";
}else{

$lat = $_GET['latXX'];
$lon = $_GET['lonYY'];	
$latlon = $lat.",".$lon;
}

?>
<script type="text/javascript">

var latlon = "<?php echo $latlon ?>";

//load map
 var map = null;
            
      function getMap()
      {
         map = new Microsoft.Maps.Map(document.getElementById('PinItMap'), {
															  
								credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK',
								zoom: 10, 
								});
		 
		  // Initialize the location provider
        var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);

         // Get the user's current location
        geoLocationProvider.getCurrentPosition({showAccuracyCircle: false,successCallback:displayCenter}); 
      }
	  
	  function displayCenter(args)
         {
            
			
			var loc = args.center;
			//alert("pecah dua : latitude = "+loc.latitude+" longitude : "+loc.longitude);
			
			latUserLocation = loc.latitude;
			lonUserLocation = loc.longitude;
			//alert(latUserLocation+","+lonUserLocation);
			
			//set the global variable of current user location to use at create driving route function 
			//when user click from my location at create route dialog
			window.myLoc =  latUserLocation+","+lonUserLocation;
			document.getElementById("myLocation").value = myLoc;
			createDirections();
			
         }
	  
	  var directionsManager;
      var directionsErrorEventObj;
      var directionsUpdatedEventObj; 
      
          function createDirectionsManager()
      {
          var displayMessage;
          if (!directionsManager) 
          {
              directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
              //displayMessage = 'Directions Module loaded\n';
             // displayMessage += 'Directions Manager loaded';
          }
          //alert(displayMessage);
          directionsManager.resetDirections();
          directionsErrorEventObj = Microsoft.Maps.Events.addHandler(directionsManager, 'directionsError', function(arg) { alert(arg.message) });
          directionsUpdatedEventObj = Microsoft.Maps.Events.addHandler(directionsManager, 'directionsUpdated', function() { /*alert('Directions updated')*/ });
      }
      
      function createDrivingRoute()
      {
        if (!directionsManager) { createDirectionsManager(); }
        directionsManager.resetDirections();
        // Set Route Mode to driving 
        directionsManager.setRequestOptions({ routeMode: Microsoft.Maps.Directions.RouteMode.driving });
        var seattleWaypoint = new Microsoft.Maps.Directions.Waypoint({ address: myLoc });
        directionsManager.addWaypoint(seattleWaypoint);
        var tacomaWaypoint = new Microsoft.Maps.Directions.Waypoint({ address: latlon });
        directionsManager.addWaypoint(tacomaWaypoint);
        // Set the element in which the itinerary will be rendered
        directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('directionsItinerary') });
        //alert('Calculating directions...');
        directionsManager.calculateDirections();
      }

      function createDirections() {
        if (!directionsManager)
        {
          Microsoft.Maps.loadModule('Microsoft.Maps.Directions', { callback: createDrivingRoute });
        }
        else
        {
          createDrivingRoute();
        }
       }



</script>

</head>

<body onload="getMap();">

<input type="hidden" id="jobLocation" value="<?php echo $latlon; ?>"  />
<input type="hidden" id="myLocation"  />
	
  <div id='PinItMap' style="position:relative;width:70%; height:580px;float:left"></div>
  <div id="directionsItinerary" style="width:30%;height:580px;float:right; overflow-y:scroll"></div>
</body>
</html>