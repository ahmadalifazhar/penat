
      var map = null;
	  //pin.it pushpin
	  var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26};
      <!-- display map -->
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
		}});
      }   
	  
	  <!-- get current location -->
	    function getCurrentLocation()
      {
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
        var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
		geoLocationProvider.getCurrentPosition(); 
		}});
		//displayAlert('Current location set, based on your browser support for geo location API');
      }
	  
	  <!-- add static pin -->
	  function addCustomPushpin()
      {
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
        var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions);
        map.entities.push(pushpin);
		}});
      }
	  
	  <!-- go to current location -->
	  function getCenter()
      {
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
        var latlon = map.getCenter();
        alert('Lat/Long: ' + latlon.latitude +'/' + latlon.longitude);
		}});
      }
	  <!-- getCenter for pin -->
	  function getCenter2()
      {
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
        var latlon = map.getCenter();
        alert('Lat/Long: ' + latlon.latitude +'/' + latlon.longitude);
		setInfoBoxLocation(latlon.latitude,latlon.longitude);
		}});
      }
	  <!-- pin post -->
	  function pin()
      {
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
        var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
		geoLocationProvider.getCurrentPosition();
		setTimeout(addCustomPushpin,500);
		setTimeout(getCenter2,500);
		}});
      }
	  
	  <!-- set pin location -->
	  function updatePushpinLocation()
      {
		  var desc1 = "this is a very long description that i've made just to see how long can the infobox support the text. in hoping so that it can support a very long string text, i have babble around like a maniac. please do not read this thank you for your kindness.";
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
        var pushpin1= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions); 
        map.entities.push(pushpin1);
		map.entities.push(new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(2.270050,102.280295), {title: 'London', description: ''+desc1+'', pushpin: pushpin1})); 
        pushpin1.setLocation(new Microsoft.Maps.Location(2.270000,102.280295));
        //map.setView({zoom: 14, center: new Microsoft.Maps.Location(2.270000,102.280295)});
		
		//add-on
		var pushpin2= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions);
		map.entities.push(pushpin2);
		pushpin2.setLocation(new Microsoft.Maps.Location(2.265000,102.282295));
        //map.setView({zoom: 14, center: new Microsoft.Maps.Location(2.280000,102.280295)});
        //alert('pushpin location updated'); 
		}});
      }
	  
	  <!-- Pinfobox -->
	  function setInfoBoxLocation(x,y)
      {
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
        //map.entities.clear();         
        var infoboxOptions = {width :200, height :100, showCloseButton: true, zIndex: 0, offset:new Microsoft.Maps.Point(10,0), showPointer: true,
							  title:'Your Location',
							  description:'You are here you dawg!' }; 
							  
        var defaultInfobox = new Microsoft.Maps.Infobox(map.getCenter(), infoboxOptions );    
        map.entities.push(defaultInfobox); 
        //alert('Now Setting Location'); 
        defaultInfobox.setLocation(new Microsoft.Maps.Location(x,y));
		}});
      }