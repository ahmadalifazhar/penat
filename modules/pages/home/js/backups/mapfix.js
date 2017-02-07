// JavaScript Document

//public var
var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26};
var currentLat = null;
var currentLon = null;
var x = null;
var y = null;

//load map
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
         geoLocationProvider.getCurrentPosition({showAccuracyCircle: false,successCallback:displayCenter});
		
		prepMenu();

}});
}


 function displayCenter(args)
         {
            // Display the user location when the geo location request returns
            //alert("The user's location is " + args.center);
			
			var loc = args.center;
			alert("pecah dua : latitude = "+loc.latitude+" longitude : "+loc.longitude);
			//document.getElementById("latid").value = loc.latitude;
			//document.getElementById("lonid").value = loc.longitude;
			
         }


//focus on current location
function getCurrentLocation()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme',
							 { callback: function() {
							   var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
							   geoLocationProvider.getCurrentPosition({showAccuracyCircle: false,successCallback:displayCenter});
							   //setTimeout(getCenter,5000);
							   setTimeout(staticPin,5000);
}});
}
//focus on current location
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



//center of map latitude and longitude
function getCenter()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
	var latlon = map.getCenter();
	currentLat = latlon.latitude;
	currentLon = latlon.longitude;
	//document.getElementById("latid").value = latlon.latitude;
	//document.getElementById("lonid").value = latlon.longitude;
	//alert('xLat : ' + currentLat + ' xLon : ' + currentLon);
}});
}

<!-- add static pin -->
function staticPin()
{
	var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions);
	map.entities.push(pushpin);
}


//function utk tunjuk location dlm textbox (alif)
 function displayEventInfo(e) {
              if (e.targetType == "map") {
                  var point = new Microsoft.Maps.Point(e.getX(), e.getY());
                  var loc = e.target.tryPixelToLocation(point);
                  document.getElementById("textBox").value = loc.latitude + ", " + loc.longitude;

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
				  
				  
				 // alert("pinX = "+pinX+" pinY = "+pinY+"\ntopLeftX = "+topLeftX+" topLeftY = "+topLeftY+"\nlat = "+lat+" long = "+long+"\ncursorX = "+cursorX+" cursorY= "+cursorY);
				  
 				var menu = document.getElementById('popupmenu');
  				menu.style.display='block'; //Showing the menu
  				menu.style.left = cursorX+"px";//pinX+topLeftX ;//  //Positioning the menu
  				menu.style.top = cursorY+"px";//pinY+topLeftY;//
				//alert("cursor x is = "+e.originalEvent.clientX+" cursor y is = "+e.originalEvent.clientY+"\nLatitude is = "+
				//loc.latitude+" Longitude is = "+loc.longitude);
				//alert("latitude is = "+pinX+"\nLongitude = "+pinY);			
	}
}

function pinPost(){

 var loc = new Microsoft.Maps.Location(x,y);

var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(),pushpinOptions); 
map.entities.push(pushpin); 
pushpin.setLocation(loc);
//alert("latitude is = "+x+"\nLongitude = "+y);
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
 
 //---------------------------------------------------------------------------------------------------------//saje2 test
 function cekInteger(int){
 var reInteger = /^\d+$/;

function isInteger (s)
{    
    return reInteger.test(s)
}

if(isInteger(int))
   alert("Integer");
else
  alert("Not an integer");
 }
