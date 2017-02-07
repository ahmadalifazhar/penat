
      var map = null;
      <!-- display map -->
      function getMap()
      {
        map = new Microsoft.Maps.Map(
									 document.getElementById('PinItMap'), 
									 {
										 credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK',
										 showMapTypeSelector:false,
										 enableSearchLogo:false,
										 disableBirdseye:true
									 }
									 );
      }   
	  
	  <!-- get current location -->
	    function getCurrentLocation()
      {
        var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
		geoLocationProvider.getCurrentPosition(); 
		//displayAlert('Current location set, based on your browser support for geo location API');
      }
	  
	  <!-- add static pin -->
	  function addCustomPushpin()
      {
        var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26};  <!-- width:38, height:51  -->
        var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions);
        map.entities.push(pushpin);
      }
	  
	  <!-- go to current location -->
	  function getCenter()
      {
        var latlon = map.getCenter();
        alert('Lat/Long: ' + latlon.latitude +'/' + latlon.longitude);
      }
	  function getCenter2()
      {
        var latlon = map.getCenter();
        alert('Lat/Long: ' + latlon.latitude +'/' + latlon.longitude);
		setInfoBoxLocation(latlon.latitude,latlon.longitude);
		
      }
	  <!-- pin post -->
	  function pin()
      {
        var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map); 
		geoLocationProvider.getCurrentPosition();
		setTimeout(addCustomPushpin,500);
		setTimeout(getCenter2,500);
      }
	  
	  <!-- set pin location -->
	  function updatePushpinLocation()
      {
        var pushpin1= new Microsoft.Maps.Pushpin(map.getCenter(), null); 
        map.entities.push(pushpin1);
		map.entities.push(new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(2.270000,102.280295), {title: 'London', description: 'description here', pushpin: pushpin1})); 
        pushpin1.setLocation(new Microsoft.Maps.Location(2.270000,102.280295));
        //map.setView({zoom: 14, center: new Microsoft.Maps.Location(2.270000,102.280295)});
		
		//add-on
		var pushpin2= new Microsoft.Maps.Pushpin(map.getCenter(), null);
		map.entities.push(pushpin2);
		pushpin2.setLocation(new Microsoft.Maps.Location(2.265000,102.282295));
        //map.setView({zoom: 14, center: new Microsoft.Maps.Location(2.280000,102.280295)});
        //alert('pushpin location updated'); 
      }
	  
	  <!-- Pinfobox -->
	  function setInfoBoxLocation(x,y)
      {
        //map.entities.clear();         
        var infoboxOptions = {width :200, height :100, showCloseButton: true, zIndex: 0, offset:new Microsoft.Maps.Point(10,0), showPointer: true,
							  title:'Your Location',
							  description:'You are here you dawg!' }; 
							  
        var defaultInfobox = new Microsoft.Maps.Infobox(map.getCenter(), infoboxOptions );    
        map.entities.push(defaultInfobox); 
        //alert('Now Setting Location'); 
        defaultInfobox.setLocation(new Microsoft.Maps.Location(x,y));
      }