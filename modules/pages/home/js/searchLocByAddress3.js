//function to search location (alif) 14/5/2013
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
	map.entities.clear(); 
        var topResult = result.results && result.results[0]; 
        if (topResult) { 
            var pushpin = new Microsoft.Maps.Pushpin(topResult.location, pushpinSearchLocation); 
            map.setView({ center: topResult.location, zoom: 10 }); 
            map.entities.push(pushpin);
			pushpin();
        } 
    } 
  } 
  function onGeocodeFailed(result) { 
    alert('Geocode failed'); 
  } 
