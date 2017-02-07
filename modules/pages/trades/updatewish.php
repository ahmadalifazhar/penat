<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Product</title>

<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

$wid = $_GET['wish'];

$rawwish = mysql_query("SELECT w.* FROM wishlist w WHERE w.wid='".$wid."'") or die(mysql_error());
$wish = mysql_fetch_array($rawwish);
$price = number_format($wish['wprice'], 2, '.', '');
$wdescription = nl2br(htmlspecialchars(stripslashes($wish['wdescription'])));

$rawuser = mysql_query("SELECT afname, alname, auname FROM accounts WHERE aid='".$wish['aid']."'") or die(mysql_error());
$user = mysql_fetch_array($rawuser);
?>

<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/player/mediaelementplayer.css" rel="stylesheet" type="text/css"/>

<!-- lightbox -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/lightbox.js"></script>
<link href="css/lightbox.css" rel="stylesheet" />
<!-- -->

<!-- map -->
<script type="text/javascript" src="js/mapcontrol.ashx?v=7.0"></script>

<script type="text/javascript">
/*
      var map = null;
	  var lat = "<?php //echo $wish['tlat']; ?>";
	  var lon = "<?php //echo $wish['tlon']; ?>";
            
    function getMap()       
    {
        Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() 
        {
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), 
            { 
                  credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK', 
                  theme: new Microsoft.Maps.Themes.BingTheme(),
				  showMapTypeSelector: false,
				  enableClickableLogo: false,
				  enableSearchLogo: false
				  
            }); 
        }});
		
		setTimeout(gotoLocation,2000)
		setTimeout(attachPushpinDragEndEvent,3000);
    }
    
	function goCenter()
	{
		var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);  
        geoLocationProvider.getCurrentPosition({ showAccuracyCircle: false });
		setTimeout(getCenter,2000)
	}
	
	function gotoLocation()
	{
		map.setView({zoom: 16, center: new Microsoft.Maps.Location(lat,lon)});
	}
	
	function getCenter()
	{
		var loc = map.getCenter();
		//alert("lat : " + loc.latitude + " lon : " + loc.longitude);
		document.getElementById('tlat').value = loc.latitude;
		document.getElementById('tlon').value = loc.longitude;
	}
	
	function attachPushpinDragEndEvent()
	{
		var pushpinOptions = {draggable:true}; 
		var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions); 
		pushpin.setLocation(new Microsoft.Maps.Location(lat, lon)); 
		var pushpindragend= Microsoft.Maps.Events.addHandler(pushpin, 'dragend', endDragDetails);  
		map.entities.push(pushpin); 
		//alert('stop dragging newly added pushpin to raise event');
	}
      
	endDragDetails = function (e) 
	{
		var loc = e.entity.getLocation();
		
		document.getElementById('tlat').value = loc.latitude;
		document.getElementById('tlon').value = loc.longitude;
		
		//alert("Event Info - start drag \n" + "Start Latitude/Longitude: " + e.entity.getLocation() ); 
		//alert("lat : " + loc.latitude + " lon : " + loc.longitude);
	}
	
*/
</script>


</head>

<!--<body class="metrouicss"  onload="getMap();">-->
<body class="metrouicss">

<form method="post" enctype="multipart/form-data" action="index.php?go=updatewish" >
<input type="hidden" name="action" value="updatewish" />
<!--
<input type="hidden" name="tlat" id="tlat" value="<?php //echo $product['tlat']; ?>" />
<input type="hidden" name="tlon" id="tlon" value="<?php //echo $product['tlon']; ?>" />
-->
<input type="hidden" name="wid" id="wid" value="<?php echo $wid; ?>" />
<table class="striped">
	<tr>
        <td colspan="2" style="color:#F00"><h1 style="color:#333"><?php echo $wish['wtitle']; ?></h1>(<?php echo $wish['wdate']; ?>)</td>
    </tr>
    <tr>
    	<td>Title</td>
        <td><div class="input-control text"><input type="text" name="wtitle" value="<?php echo $wish['wtitle']; ?>" />
        	<button class="btn-clear" tabindex="-1" type="button" /></div>
        </td>
    </tr>
	<tr>
        <td width="20%">Price (RM)</td>
        <td><div class="input-control text"><input type="text" name="wprice" value="<?php echo $price; ?>" />
        	<button class="btn-clear" tabindex="-1" type="button" /></div>
        </td>
    </tr>
    <tr>
        <td>Category</td>
        <td>
        <div class="input-control select" style="width:50%">
		<select name="wtype">
        	<?php
			if($wish['wtype']=="Vehicles")
			{
				echo "<option selected='selected' value='Vehicles'>Vehicles</option>";
                echo "<option value='Properties'>Properties</option>";
                echo "<option value='Electronics'>Electronics</option>";
                echo "<option value='Personal Items'>Personal Items</option>";
                echo "<option value='Hobbies'>Hobbies</option>";
                echo "<option value='Services'>Services</option>";
                echo "<option value='Others'>Others</option>";
			}
			if($wish['wtype']=="Properties")
			{
				echo "<option value='Vehicles'>Vehicles</option>";
                echo "<option selected='selected' value='Properties'>Properties</option>";
                echo "<option value='Electronics'>Electronics</option>";
                echo "<option value='Personal Items'>Personal Items</option>";
                echo "<option value='Hobbies'>Hobbies</option>";
                echo "<option value='Services'>Services</option>";
                echo "<option value='Others'>Others</option>";
			}
			if($wish['wtype']=="Electronics")
			{
				echo "<option value='Vehicles'>Vehicles</option>";
                echo "<option value='Properties'>Properties</option>";
                echo "<option selected='selected' value='Electronics'>Electronics</option>";
                echo "<option value='Personal Items'>Personal Items</option>";
                echo "<option value='Hobbies'>Hobbies</option>";
                echo "<option value='Services'>Services</option>";
                echo "<option value='Others'>Others</option>";
			}
			if($wish['wtype']=="Personal Items")
			{
				echo "<option value='Vehicles'>Vehicles</option>";
                echo "<option value='Properties'>Properties</option>";
                echo "<option value='Electronics'>Electronics</option>";
                echo "<option selected='selected' value='Personal Items'>Personal Items</option>";
                echo "<option value='Hobbies'>Hobbies</option>";
                echo "<option value='Services'>Services</option>";
                echo "<option value='Others'>Others</option>";
			}
			if($wish['wtype']=="Hobbies")
			{
				echo "<option value='Vehicles'>Vehicles</option>";
                echo "<option value='Properties'>Properties</option>";
                echo "<option value='Electronics'>Electronics</option>";
                echo "<option value='Personal Items'>Personal Items</option>";
                echo "<option selected='selected' value='Hobbies'>Hobbies</option>";
                echo "<option value='Services'>Services</option>";
                echo "<option value='Others'>Others</option>";
			}
			if($wish['wtype']=="Services")
			{
				echo "<option value='Vehicles'>Vehicles</option>";
                echo "<option value='Properties'>Properties</option>";
                echo "<option value='Electronics'>Electronics</option>";
                echo "<option value='Personal Items'>Personal Items</option>";
                echo "<option value='Hobbies'>Hobbies</option>";
                echo "<option selected='selected' value='Services'>Services</option>";
                echo "<option value='Others'>Others</option>";
			}
			if($wish['wtype']=="Others")
			{
				echo "<option value='Vehicles'>Vehicles</option>";
                echo "<option value='Properties'>Properties</option>";
                echo "<option value='Electronics'>Electronics</option>";
                echo "<option value='Personal Items'>Personal Items</option>";
                echo "<option value='Hobbies'>Hobbies</option>";
                echo "<option value='Services'>Services</option>";
                echo "<option selected='selected' value='Others'>Others</option>";
			}
			?>
        </select></div></td>
    </tr>
    <!--
    <tr>
        <td valign="top">Quantity</td>
        <td><div class="input-control text"><input type="text" name="tquantity" value="<?php echo $product['tquantity']; ?>" />
        	<button class="btn-clear" tabindex="-1" type="button" /></div>
        </td>
    </tr>
    -->
    <tr>
        <td valign="top">Description</td>
        <td><div class="input-control textarea"><textarea name="wdescription"><?php echo $wish['wdescription']; ?></textarea></div></td>
    </tr>
    <tr>
    	<td rowspan="2" valign="top">Image</td>
        <td>
        <input type="file" name="file" id="file">
        </td>
    </tr>
    <tr>
    	<td><a href="wish/<?php echo $wish['wpic']; ?>" rel="lightbox">
        <img src="<?php echo 'wish/' . $wish['wpic'] ?>" width="50%" height="50%" />
        </a></td>
    </tr>
    <!--
    <tr>
        <td valign="top">Location</td>
        <td><div id='myMap' style="position:relative; width:100%; height:300px;"></div></td>
    </tr>
    -->
    <tr>
    	<td colspan="2"><a class="button default" href="mywishlist.php">Back</a><input type="submit" value="Update" /></td>
    </tr>
</table>
</form>
</body>
</html>