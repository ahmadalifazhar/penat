      var map = null;
	  var tlat = null;
	  var tlon = null;
	  
	var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	var pushpinUserLocation = {icon:'xxxxxxximages/userLoc.png',width: 50, height: 50}; //image for current user location indicator
	var pushpinOptionsFC = new Array;
	pushpinOptionsFC[8] = {icon:'images/FC/1700.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	pushpinOptionsFC[9] = {icon:'images/FC/1701.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	pushpinOptionsFC[10] = {icon:'images/FC/1702.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	pushpinOptionsFC[11] = {icon:'images/FC/1703.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	pushpinOptionsFC[12] = {icon:'images/FC/1704.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	pushpinOptionsFC[13] = {icon:'images/FC/1705.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	pushpinOptionsFC[14] = {icon:'images/FC/1706.png',width: 19, height: 26}; // image for user push a pin or PinIt!
	pushpinOptionsFC[15] = {icon:'images/FC/1707.png',width: 19, height: 26}; // image for user push a pin or PinIt!
            
    function getMap()       
    {
        Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() 
        {
            map = new Microsoft.Maps.Map(document.getElementById('PinItMap'), 
            { 
                  credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK', 
                  theme: new Microsoft.Maps.Themes.BingTheme(),
				  showMapTypeSelector: false,
				  enableClickableLogo: false,
				  enableSearchLogo: false
				  
            }); 
			var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);
			geoLocationProvider.getCurrentPosition({showAccuracyCircle: true,successCallback:displayCenter});
        }});
		
		setTimeout(goCenter,2000);
		setTimeout(attachPushpinDragEndEvent,5000);
    }
    
	function goCenter()
	{
		var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);  
        geoLocationProvider.getCurrentPosition({ showAccuracyCircle: false, });
		setTimeout(getCenter,2000);
	}
	
	function getCenter()
	{
		var loc = map.getCenter();
		document.getElementById('latid').value = loc.latitude;
		document.getElementById('lonid').value = loc.longitude;
		for (x = 1; x <= 7; x++)
		{
			document.getElementById('latid' + x).value = loc.latitude;
			document.getElementById('lonid' + x).value = loc.longitude;
		}
		tlat = loc.latitude;
		tlon = loc.longitude;
		Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });
	}
	function displayCenter(args)
         {
            
			
			var loc = args.center;
			window.myLoc =  loc.latitude+","+loc.longitude;
			Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });
			
         }
		 
	function getCurrentLocation()
	{
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme',
								 { callback: function() {
	
								   var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
								   geoLocationProvider.getCurrentPosition({showAccuracyCircle: false,successCallback:displayCenter});
								   setTimeout(getCenter,5000);
	}});
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
		window.myLoc =  loc.latitude+","+loc.longitude;
		$('#txtStart').val(myLoc);
		
		document.getElementById('latid').value = loc.latitude;
		document.getElementById('lonid').value = loc.longitude;
		
		for (x = 1; x <= 7; x++)
		{
			document.getElementById('latid' + x).value = loc.latitude;
			document.getElementById('lonid' + x).value = loc.longitude;
		}
		tlat = loc.latitude;
		tlon = loc.longitude;
		Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });
	}
	 
	 
	 //search nama location by longitude dan latitude
	function searchModuleLoaded()
	{
		var searchManager = new Microsoft.Maps.Search.SearchManager(map);
		var reverseGeocodeRequest = {location:new Microsoft.Maps.Location(tlat,tlon), count:10, callback:reverseGeocodeCallback, errorCallback:errCallback};
		searchManager.reverseGeocode(reverseGeocodeRequest);
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
          }
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
	function reverseGeocodeCallback(result)
	{
		//document.getElementById("taddress").value = result.name;
		//document.getElementById('viewLocation').innerHTML = "Pin : "+result.name;
	}
	function errCallback(request)
	{
		//alert("An error occurred! GeocodeRequest Failed");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	 //origin function to search location (alif) 14/5/2013
	 //modified by Marhazli
var pushpinSearchLocation = {icon:'images/searchLocIcon1.png',width: 60, height: 60}; //image for search location location indicator


var searchManager = null;
function createSearchManager() 
  {
      map.addComponent('searchManager', new Microsoft.Maps.Search.SearchManager(map)); 
      searchManager = map.getComponent('searchManager'); 
  }
  function LoadSearchModule()
  {
    Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: geocodeRequest })
  }
  function geocodeRequest() 
  { 
    createSearchManager(); 
    var where = document.getElementById('locSearch').value; 
    //var userData = { name: 'Maps Test User', id: 'XYZ' }; 
    var request = 
    { 
        where: where, 
        count: 5, 
        bounds: map.getBounds(), 
        callback: onGeocodeSuccess, 
        errorCallback: onGeocodeFailed, 
        //userData: userData 
    }; 
    searchManager.geocode(request); 
  } 
  function onGeocodeSuccess(result) 
  { 
    if (result) { 
	//map.entities.clear(); 
		
        var topResult = result.results && result.results[0]; 
        if (topResult) { 
            var pushpin = new Microsoft.Maps.Pushpin(topResult.location, pushpinSearchLocation); 
            map.setView({ center: topResult.location, zoom: 10 }); 
            map.entities.push(pushpin);
			var loc = topResult.location;
			window.myLoc =  loc.latitude+","+loc.longitude;
			$('#txtStart').val(myLoc);
			document.getElementById('latid').value = loc.latitude;
			document.getElementById('lonid').value = loc.longitude;
			pushpin();
        } 
    } 
  } 
  function onGeocodeFailed(result) { 
    alert('Geocode failed'); 
  } 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 /*  Author: Valerio Battaglia (vabatta)
 *  Description: Function to create dialog box. You can have a dialog box open at once.
 *  Version: 1.0a
 *
 *  Params:
 *      title - Title of the dialog box (HTML format)
 *      content - Content of the dialog box (HTML format)
 *      draggable - Set draggable to dialog box, available: true, false (default: false)
 *      overlay - Set the overlay of the page, available: true, false (default: true)
 *      closeButton - Enable or disable the close button, available: true, false (default: false)
 *      buttonsAlign - Align of the buttons, available: left, center, right (default: center)
 *      buttons - Set buttons in the action bar (JSON format)
 *          name - Text of the button (JSON format)
 *              action - Function to bind to the button
 *      position - Set the initial position of the dialog box (JSON format)
 *          zone - Zone of the dialog box, available: left, center, right (default: center)
 *          offsetY - Top offset pixels
 *          offsetX - Left offset pixels
 *      
 *   Goal for next versions:
 *      Add style param to set custom css to the dialog box controls
 *      Add possibility to resize window
 */

(function($) {
    $.Dialog = function(params) {
        if(!$.DialogOpened) {
            $.DialogOpened = true;
        } else {
            return false;
        }

        params = $.extend({'position':{'zone':'center'},'overlay':true}, params);

        var buttonsHTML = '<div';

        // Buttons position
        if(params.buttonsAlign)
        {
            buttonsHTML += ' style=" float: ' + params.buttonsAlign + ';">';
        } else {
            buttonsHTML += '>';
        }

        $.each(params.buttons, function(name,obj) {
            // Generating the markup for the buttons

            buttonsHTML += '<button>' + name + '</button>';
            
            if(!obj.action) 
            {
                obj.action = function() {};
            }
        });

        buttonsHTML += '</div>';

        var markup = [
            // If overlay is true, set it

            '<div  class="metrouicss" id="dialogOverlay">',
            '<div id="dialogBox" class="dialog">',
            '<div class="header">',
            params.title,
            (params.closeButton)?('<div><button class="tool-button"><i class="icon-cancel-2"></i></button></div>'):(''),
            '</div>',
            '<div class="content">', params.content, '</div>',
            '<div class="action" id="dialogButtons">',
            buttonsHTML,
            '</div></div></div>'
        ].join('');

        $(markup).hide().appendTo('body').fadeIn();

        if(!params.overlay) {
            $('#dialogOverlay').css('background-color', 'rgba(255, 255, 255, 0)');
        }
        
        // Setting initial position
        if(params.position.zone == "left")
        {
            $('#dialogBox').css("top", Math.max(0, (($(window).height() - $('#dialogBox').outerHeight()) / 3) + 
                                                $(window).scrollTop()) + "px");
            $('#dialogBox').css("left", 0);
        } 
        else if(params.position.zone == "right")
        {
            $('#dialogBox').css("top", Math.max(0, (($(window).height() - $('#dialogBox').outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
            $('#dialogBox').css("left", Math.max(0, (($(window).width() - $('#dialogBox').outerWidth())) + 
                                                            $(window).scrollLeft()) + "px");
        } 
        else
        {
            $('#dialogBox').css("top", (params.position.offsetY)?(params.position.offsetY):(Math.max(0, (($(window).height() - $('#dialogBox').outerHeight()) / 3) + 
                                                                                                $(window).scrollTop()) + "px"));
            $('#dialogBox').css("left", (params.position.offsetX)?(params.position.offsetX):(Math.max(0, (($(window).width() - $('#dialogBox').outerWidth()) / 2) + 
                                                                                                $(window).scrollLeft()) + "px"));
        }

        if(params.draggable) {
            // Make draggable the window

            $('#dialogBox div.header').css('cursor', 'move').on("mousedown", function(e) {
                var $drag = $(this).addClass('active-handle').parent().addClass('draggable');

                var z_idx = $drag.css('z-index'),
                    drg_h = $drag.outerHeight(),
                    drg_w = $drag.outerWidth(),
                    pos_y = $drag.offset().top + drg_h - e.pageY,
                    pos_x = $drag.offset().left + drg_w - e.pageX;
                $drag.css('z-index', 999999).parents().on("mousemove", function(e) {
                    $('.draggable').offset({
                        top:e.pageY + pos_y - drg_h,
                        left:e.pageX + pos_x - drg_w
                    }).on("mouseup", function() {
                        $(this).removeClass('draggable').css('z-index', z_idx);
                    });
                });
                e.preventDefault(); // disable selection
            }).on("mouseup", function() {
                $(this).removeClass('active-handle').parent().removeClass('draggable');
            });
        }

        $('#dialogBox .header button').click(function() { 
            // Bind close button to hide dialog

            $.Dialog.hide();
            return false;
        });
		
		$('#closeDialog').click(function() { 
            // Bind close button to hide dialog

            $.Dialog.hide();
            return false;
        });

        var buttons = $('#dialogBox .action button'),
            i = 0;

        $.each(params.buttons,function(name,obj){
            buttons.eq(i++).click(function(){
                // Calling function and hide the dialog   

                obj.action();
                $.Dialog.hide();
                return false;
            });
        });
    }

    $.Dialog.hide = function(){
        $('#dialogOverlay').fadeOut(function(){
            $.DialogOpened = false;
            $(this).remove();
        });
    }
})(jQuery);