
     
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
              //displayMessage += 'Directions Manager loaded';
          }
          //alert(displayMessage);
          directionsManager.resetDirections();
          directionsErrorEventObj = Microsoft.Maps.Events.addHandler(directionsManager, 'directionsError', function(arg) { alert(arg.message) });
          directionsUpdatedEventObj = Microsoft.Maps.Events.addHandler(directionsManager, 'directionsUpdated', function() { alert('Directions updated') });
      }
      
      function createDrivingRoute()
      {
        if (!directionsManager) { createDirectionsManager(); }
        directionsManager.resetDirections();
        // Set Route Mode to driving 
        directionsManager.setRequestOptions({ routeMode: Microsoft.Maps.Directions.RouteMode.driving });
		
        //var seattleWaypoint = new Microsoft.Maps.Directions.Waypoint({ address: 'Seattle, WA' });
		var startWayPoint = new Microsoft.Maps.Directions.Waypoint({ address: document.getElementById('txtStart').value });
        //directionsManager.addWaypoint(seattleWaypoint);
		directionsManager.addWaypoint(startWayPoint);
        //var tacomaWaypoint = new Microsoft.Maps.Directions.Waypoint({ address: 'Tacoma, WA', location: new Microsoft.Maps.Location(47.255134, -122.441650) });
		var EndWayPoint = new Microsoft.Maps.Directions.Waypoint({ address: document.getElementById('txtEnd').value });
        //directionsManager.addWaypoint(tacomaWaypoint);
		directionsManager.addWaypoint(EndWayPoint);
		
		
        // Set the element in which the itinerary will be rendered
        directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('directionsItinerary') });
        //alert('Calculating directions...');
        directionsManager.calculateDirections();
      }
	  
	    function clearDisplay()
      {
        if (!directionsManager) { createDirectionsManager(); }
        directionsManager.clearDisplay();
        //alert('Directions cleared (map/itinerary cleared, Waypoints preserved, request and render options preserved)');
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
	   
	  