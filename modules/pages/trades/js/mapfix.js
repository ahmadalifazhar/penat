// JavaScript Document

//public var
var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var pushpinUserLocation = {icon:'xxxxxxximages/userLoc.png',width: 50, height: 50}; //image for current user location indicator
var pushpinSearchLocation = {icon:'images/searchLocIcon.png',width: 50, height: 50}; //image for search location location indicator

var pushpinOptionsFC = new Array;
pushpinOptionsFC[0] = {icon:'images/FC/1300.png',width: 19, height: 26}; // image for user push a pin or PinIt!
pushpinOptionsFC[1] = {icon:'images/FC/1301.png',width: 19, height: 26}; // image for user push a pin or PinIt!
pushpinOptionsFC[2] = {icon:'images/FC/1302.png',width: 19, height: 26}; // image for user push a pin or PinIt!
pushpinOptionsFC[3] = {icon:'images/FC/1303.png',width: 19, height: 26}; // image for user push a pin or PinIt!
pushpinOptionsFC[4] = {icon:'images/FC/1304.png',width: 19, height: 26}; // image for user push a pin or PinIt!
pushpinOptionsFC[5] = {icon:'images/FC/1305.png',width: 19, height: 26}; // image for user push a pin or PinIt!
pushpinOptionsFC[6] = {icon:'images/FC/1306.png',width: 19, height: 26}; // image for user push a pin or PinIt!
pushpinOptionsFC[7] = {icon:'images/FC/1307.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var pushpinOptionsFC11 = {icon:'images/FC/11.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var pushpinOptionsFC12 = {icon:'images/FC/12.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var pushpinOptionsFC14 = {icon:'images/FC/14.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var pushpinOptionsFC15 = {icon:'images/FC/15.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var pushpinOptionsFC16 = {icon:'images/FC/16.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var pushpinOptionsFC17 = {icon:'images/FC/17.png',width: 19, height: 26}; // image for user push a pin or PinIt!
var currentLat = null;
var currentLon = null;
var x = null;
var y = null;
var latUserLocation = null;
var lonUserLocation =null;

var map = null;

//load map with unset lat n lon
function getMap()
{
Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() {
map = new Microsoft.Maps.Map(
							 document.getElementById('PinItMap'), 
							 {
								 credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK',
								 showMapTypeSelector:false,
								 enableSearchLogo:false,
								 enableClickableLogo:false,
								 disableBirdseye:true,
								 mapTypeId: Microsoft.Maps.MapTypeId.road,
								 theme: new Microsoft.Maps.Themes.BingTheme()
							 }
							 );

		Microsoft.Maps.Events.addHandler(map, 'rightclick', showPopupMenu);
		Microsoft.Maps.Events.addHandler(map, 'click', hidePopupMenu);	
		
		 // Initialize the location provider
        var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);

         // Get the user's current location
        geoLocationProvider.getCurrentPosition({showAccuracyCircle: true,successCallback:displayCenter});
		
		prepMenu();

}});
}

// Display the user location when the geo location request returns, pin a new pin indicator telling where the user at (alif) 15/5/2013 4.43a.m
//function static pin() removed and the implementation is placed in displayCenter(args) 15/5/2013 4.43a.m
//update 3/6/2013 pin a new pin indicator telling where the user at is was removed bcause cannot right click on png, so got problem.
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
			
			Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });
			//pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinUserLocation); 
			//map.entities.push(pushpin);
			//pushpin.setLocation(loc);
			document.getElementById("latid").value = loc.latitude;
			document.getElementById("lonid").value = loc.longitude;
			
         }


//focus on current location.  geoLocationProvider.getCurrentPosition()>>Current user location set, based on your browser support for geo location API... ref: http://www.bingmapsportal.com/isdk/ajaxv7#GetUserLocation1
function getCurrentLocation()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme',
							 { callback: function() {

							   var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
							   geoLocationProvider.getCurrentPosition({showAccuracyCircle: false,successCallback:displayCenter});
							   setTimeout(getCenter,5000);
							   //setTimeout(staticPin,5000);
}});
}
/*focus on current location
function getCurrentLocationload()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme',
							 { callback: function() {
							   var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
							   geoLocationProvider.getCurrentPosition({showAccuracyCircle: false,successCallback:displayCenter});
							   setTimeout(getCenter,5000);
}});
}

//focus on current location + latitude and longitude for center of map
function getCurrentLocationLatLon()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme',
							 { callback: function() {
							   var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
							   geoLocationProvider.getCurrentPosition({successCallback:displayCenter});
							   setTimeout(getCenter,8000);
							   setTimeout(staticPin,8000);
}});
}
*/


//center of map latitude and longitude, getCenter()>>Returns the location of the center of the current map view.bukan based on user current location yg didetect oleh GPS!!
function getCenter()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
	var latlon = map.getCenter();//Returns the location of the center of the current map view
	currentLat = latlon.latitude;
	currentLon = latlon.longitude;
	
	
	//document.getElementById("latid").value = latlon.latitude;
	//document.getElementById("lonid").value = latlon.longitude;
	//alert('xLat : ' + currentLat + ' xLon : ' + currentLon);
}});

}




//function utk tunjuk location dlm textbox (alif)
 function displayEventInfo(e) {
              if (e.targetType == "map") {
                  var point = new Microsoft.Maps.Point(e.getX(), e.getY());
                  var loc = e.target.tryPixelToLocation(point);
                 // document.getElementById("textBox").value = loc.latitude + ", " + loc.longitude;

              }
          }
	  
	  //function utk papar popupmenu (alif)
	function showPopupMenu(e){
    if (e.targetType == "map") {

                  var point = new Microsoft.Maps.Point(e.getX(), e.getY());
                  var loc = e.target.tryPixelToLocation(point);
				  var pinX = loc.latitude;
				  var pinY = loc.longitude;
				  x=pinX;
				  y=pinY;

				  var topLeftX = map.getPageX();
				  var topLeftY = map.getPageY();
				  var cursorX = e.originalEvent.clientX - topLeftX;
				  var cursorY = e.originalEvent.clientY - topLeftY;
				  
				  
				  
				//alert("pinX = "+pinX+" pinY = "+pinY+"\ntopLeftX = "+topLeftX+" topLeftY = "+topLeftY+"\nlat = "+lat+" long = "+long+"\ncursorX = "+cursorX+" cursorY= "+cursorY);
				  
 				var menu = document.getElementById('popupmenu');
  				menu.style.display='block'; //Showing the menu
  				menu.style.left = cursorX+"px";//pinX+topLeftX ;//  //Positioning the menu
  				menu.style.top = cursorY+"px";//pinY+topLeftY;//
				//alert("cursor x is = "+e.originalEvent.clientX+" cursor y is = "+e.originalEvent.clientY+"\nLatitude is = "+
				//loc.latitude+" Longitude is = "+loc.longitude);
				
				document.getElementById("latidUserDefine").value = loc.latitude;
				document.getElementById("lonidUserDefine").value = loc.longitude;	
				//alert("latitude issssss = "+pinX+"\nLongitude = "+pinY);		
	}
}

function pinPost(){

 var loc = new Microsoft.Maps.Location(x,y);

var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(),pushpinOptions); 
map.entities.push(pushpin); 
pushpin.setLocation(loc);
alert("latitude is = "+x+"\nLongitude = "+y);
}


//function utk tutup context menu (alif)
function hidePopupMenu()
{
  var menu = document.getElementById('popupmenu').style.display='none';
}
//additional function context menu utk IE (alif)
function prepMenu()
  {

    navRoot = document.getElementById("popupmenu");
    var items = navRoot.getElementsByTagName('li');
    for (i=0; i<items.length; i++)
    {
      node = items[i];
      if (node.nodeName=="LI")
      {
      node.onmouseover = function()
      {
        this.className+=" over"; //Show the submenu
      }
      node.onmouseout=function()
      {
        if (this.className.indexOf('pmenu') > 0)
        {
        this.className="pmenu";
        }
        else {
        this.className = "";
        }
      }
      }
    }
  }

//function untuk zoom in (alif)
 function ZoomIn()
 {
  var zoomLevel = map.getZoom() + 1;
  map.setView({ zoom: zoomLevel });
 }
//function untuk zoom out (alif)
 function ZoomOut()
 {
  var zoomLevel = map.getZoom() - 1;
  map.setView({ zoom: zoomLevel });
 }
 
//(alif)
 function setMapType(type){
 
 if(type=='aerial'){
	 map.setView({mapTypeId : Microsoft.Maps.MapTypeId.aerial});
 }
 else if(type=='road'){
	 map.setView({mapTypeId : Microsoft.Maps.MapTypeId.road});
 }
 else if(type=='birdseye'){
	  map.setView({mapTypeId : Microsoft.Maps.MapTypeId.birdseye});
 }
 else{
 map.MapTypeId.auto;
 }
 }
 
 
 //---------------------------------------------------------------------------------------------------------//test section here, atas dont touch


//search nama location by longitude dan latitude(alif) OLD
function searchModuleLoaded()
      {
		 
         var searchManager = new Microsoft.Maps.Search.SearchManager(map);

         var reverseGeocodeRequest = {location:new Microsoft.Maps.Location(latUserLocation,lonUserLocation), count:10, callback:reverseGeocodeCallback, errorCallback:errCallback};
         searchManager.reverseGeocode(reverseGeocodeRequest);
      }
     
      function reverseGeocodeCallback(result, userData)
      {
        
         document.getElementById("locnameid").value = result.name;
         document.getElementById("locnameidUserDefine").value = result.name;
      }


      function errCallback(request)
      {

         //alert("An error occurred! GeocodeRequest Failed");
      }


/*-------------------------------------------------------- alif 11/5/2013--*/

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
		var startWayPoint = new Microsoft.Maps.Directions.Waypoint({ address: document.getElementById('txtStart').value });
		directionsManager.addWaypoint(startWayPoint);
		var EndWayPoint = new Microsoft.Maps.Directions.Waypoint({ address: document.getElementById('txtEnd').value });
		directionsManager.addWaypoint(EndWayPoint);
		
        // Set the element in which the itinerary will be rendered
        directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('directionsItinerary') });
        directionsManager.calculateDirections();
      }
	  
	    function clearDisplay()
      {
        if (!directionsManager) { createDirectionsManager(); }
        directionsManager.clearDisplay();
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
  
  //(aidy)
 function gotoLocation(lat,lon)
{
	// Set the map center
	 map.setView({zoom: 16, center: new Microsoft.Maps.Location(lat,lon)});

}



