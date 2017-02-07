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
		prepMenu();

}});
}

//focus on current location
function getCurrentLocation()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme',
							 { callback: function() {
							   var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
							   geoLocationProvider.getCurrentPosition();
							   //setTimeout(getCenter,1000);
}});
}

//focus on current location + latitude and longitude for center of map
function getCurrentLocationLatLon()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme',
							 { callback: function() {
							   var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
							   geoLocationProvider.getCurrentPosition();
							   setTimeout(getCenter,500);
							   setTimeout(staticPin,500);
}});
}

//center of map latitude and longitude
function getCenter()
{
	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
	var latlon = map.getCenter();
	currentLat = latlon.latitude;
	currentLon = latlon.longitude;
	alert('Lat : ' + currentLat + ' Lon : ' + currentLon);
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
                  document.getElementById("textBox").value = loc.latitude + ", " + loc.longitude;
				  var pinX = loc.latitude;
				  var pinY = loc.longitude;
				  x=pinX;
				  y=pinY;

 				var menu = document.getElementById('popupmenu');
  				menu.style.display='block'; //Showing the menu
  				menu.style.left = e.originalEvent.clientX+"px" ; //Positioning the menu
  				menu.style.top = e.originalEvent.clientY+"px";
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
 
 /*xjadi lg (alif)
 function setMapType(type){
 
 if(type==a){
 map.mapTypeId(Microsoft.Maps.MapTypeId.aerial);
 }
 else if(type=r){
 mapTypeId: Microsoft.Maps.MapTypeId.road;
 }
 else{
 map.MapTypeId.auto;
 }
 }*/

