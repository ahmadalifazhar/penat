// JavaScript Document

//public var
var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26};
var currentLat = null;
var currentLon = null;
var x = null;
var y = null;


         var map;
         
         function GetMap()
         {
            
            // Set the map options
            var mapOptions = {
				credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK',
								 showMapTypeSelector:false,
								 enableSearchLogo:false,
								 enableClickableLogo:false,
								 disableBirdseye:true,
								 mapTypeId: Microsoft.Maps.MapTypeId.road,
								 theme: new Microsoft.Maps.Themes.BingTheme()
		};


            // Initialize the map
            map = new Microsoft.Maps.Map(document.getElementById("PinItMap"), mapOptions);

            // Initialize the location provider
            var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);

            // Get the user's current location
            geoLocationProvider.getCurrentPosition({successCallback:displayCenter});
          

         }

         function displayCenter(args)
         {
            // Display the user location when the geo location request returns
            alert("The user's location is " + args.center);
         }
function ClickRoute(credentials)
         {

            map.getCredentials(MakeRouteRequest);
         }


         function MakeRouteRequest(credentials)
         {
            var routeRequest = "http://dev.virtualearth.net/REST/v1/Routes?wp.0=" + document.getElementById('txtStart').value + "&wp.1=" + document.getElementById('txtEnd').value + "&routePathOutput=Points&output=json&jsonp=RouteCallback&key=" + credentials;

            CallRestService(routeRequest);

         }


          function RouteCallback(result) {

                          
             if (result &&
                   result.resourceSets &&
                   result.resourceSets.length > 0 &&
                   result.resourceSets[0].resources &&
                   result.resourceSets[0].resources.length > 0) {
                   
                     // Set the map view
                     var bbox = result.resourceSets[0].resources[0].bbox;
                     var viewBoundaries = Microsoft.Maps.LocationRect.fromLocations(new Microsoft.Maps.Location(bbox[0], bbox[1]), new Microsoft.Maps.Location(bbox[2], bbox[3]));
                     map.setView({ bounds: viewBoundaries});


                     // Draw the route
                     var routeline = result.resourceSets[0].resources[0].routePath.line;
                     var routepoints = new Array();
                     
                     for (var i = 0; i < routeline.coordinates.length; i++) {

                         routepoints[i]=new Microsoft.Maps.Location(routeline.coordinates[i][0], routeline.coordinates[i][1]);
                     }

                     
                     // Draw the route on the map
                     var routeshape = new Microsoft.Maps.Polyline(routepoints, {strokeColor:new Microsoft.Maps.Color(200,0,0,200)});
                     map.entities.push(routeshape);
                     
                 }
         }


         function CallRestService(request) 
         {
            var script = document.createElement("script");
            script.setAttribute("type", "text/javascript");
            script.setAttribute("src", request);
            document.body.appendChild(script);
         }