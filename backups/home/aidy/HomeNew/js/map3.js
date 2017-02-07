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
	
	




