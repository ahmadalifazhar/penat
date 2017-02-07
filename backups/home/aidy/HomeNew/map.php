<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Load map with navigation bar module</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>

<!-- connect to database -->
<?php
include 'connectDB.php';
?>

<script type="text/javascript">
var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26};
var map = null;

    function getMap()       
    {
        Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() 
        {
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), 
            { 
                  credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK', 
                  theme: new Microsoft.Maps.Themes.BingTheme() 
            }); 
        }});
    }
	
	function cubapin()
	{
		var pushpin = new Array();
		
		//call from database
		<?php
		
		$sql = "SELECT * FROM dbo.test1aidy";
		$stmt = sqlsrv_query( $conn, $sql );
		if( $stmt === false)
		{
			die( print_r( sqlsrv_errors() , true) ); 
		}
		
		$tempCount=0;
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
		{
			$tid[$tempCount] = $row['tid'];
			$title[$tempCount] = $row['title'];
			$descript[$tempCount] = $row['descript'];
			$latitude[$tempCount] = $row['latitude'];
			$longitude[$tempCount] = $row['longitude'];
			$tempCount++;  
		}
		?>
		
		
		
		Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() 
		{
			<?php
			for($iLoop=0; $iLoop < $tempCount; $iLoop++)
			{ ?>
			var iLoop = <?php echo $iLoop; ?>
			
			pushpin[iLoop] = new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions); 
			map.entities.push(pushpin[iLoop]);
			map.entities.push(new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(<?php echo $latitude[$iLoop]; ?>,<?php echo $longitude[$iLoop]; ?>),
																	             {title: '<?php echo $title[$iLoop]; ?>', description: '<?php echo $descript[$iLoop]; ?>',
																				 pushpin: pushpin[iLoop]})); 
			pushpin[iLoop].setLocation(new Microsoft.Maps.Location(<?php echo $latitude[$iLoop]; ?>,<?php echo $longitude[$iLoop]; ?>));
		<?php } ?>

		}});
	}
		</script>
		</head>
		<body onload="getMap();cubapin();">
		<?php
        echo $out;
		echo $descript[0];
		?>
		<div id='myMap'></div>
        
		</body>
</html>