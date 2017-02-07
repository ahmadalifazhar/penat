<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pin.It</title>

<?php
include('connectDB.php');
?>

<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
<script type="text/javascript" src="js/map.js"></script>
<link href="css/contextmenu.css" type="text/css" rel="stylesheet" />

<script type="text/javascript">

<!-- set pin location -->
function pushpin()
{
	var i = null;
	var tid = new Array();
	var title = new Array();
	var descript = new Array();
	var latitude = new Array();
	var longitude = new Array();
	var pushpin = new Array();
	<?php
	
	$tempCount = 0;
	
	$sql = "SELECT * FROM test1aidy";
	
	$data = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_array($data))
	{
		$tid[$tempCount] = $row['tid'];
		$title[$tempCount] = $row['title'];
		$descript[$tempCount] = $row['descript'];
		$latitude[$tempCount] = $row['latitude'];
		$longitude[$tempCount] = $row['longitude'];
		
		?>
		i = <?php echo $tempCount; ?>;
		tid[i] = "<?php echo $tid[$tempCount]; ?>";
		title[i] = "<?php echo $title[$tempCount]; ?>";
		descript[i] = "<?php echo $descript[$tempCount]; ?>";
		latitude[i] = <?php echo $latitude[$tempCount]; ?>;
		longitude[i] = <?php echo $longitude[$tempCount]; ?>; 
		<?php
		$tempCount++;
	}
	?>

	Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() { 
	for(var x = 0; x < i+1 ; x++)
	{
	pushpin[x]= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions); 
	map.entities.push(pushpin[x]);
	var infoboxOption = {title: title[x], description: descript[x], pushpin: pushpin[x],};
	map.entities.push(new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(latitude[x],longitude[x]),infoboxOption)); 
	pushpin[x].setLocation(new Microsoft.Maps.Location(latitude[x],longitude[x]));
	}
	}});
}

</script>

</head>

<body onload="getMap();getCurrentLocation();pushpin();"  oncontextmenu = "return false">

Welcome To Pin.It
<div id="top" style="height:auto">
<input type="button" id="currentLoc" name="currentLoc" onclick="getCurrentLocationLatLon();" value="current location" />
<input type="button" id="pin" name="pin" onclick="" value="display pin" />
</div>
<div id='PinItMap'  style="position:relative; width:auto; height:500px;"></div>
<ul id="popupmenu" class="pmenu">
    <li><a href="#" onClick="pinPost();hidePopupMenu()">Pin It!</a></li>
    <li><a href="#" onClick="ZoomIn();hidePopupMenu()">Zoom In</a></li>
    <li><a href="#" onClick="ZoomOut();hidePopupMenu()">Zoom Out</a></li>
    <li><a href="#" onClick="javascript:alert('Map is centered on:  ' + map.getCenter());hidePopupMenu();">Point coordinates</a></li>
  </ul>
     
      <br>
      <b>Click the map to display the coordinate values at that point.</b><br>
      Latitude, Longitude:       
      <input id='textBox' type="text" style="width:250px;"/>
</body>
</html>