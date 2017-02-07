<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


<!-- connect to database -->
<?php
include 'connectDB.php';
?>

<script type="text/javascript">

//global variable
var pushpinOptions = {icon:'images/pin3.png',width: 19, height: 26};
var map = null;

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

<body> 
<?php
/*
echo $out."<br />";
echo $tempCount;

for($i = 0; $i < $tempCount; $i++)
{
	echo "<br />";
	echo "tid : ".$tid[$i]."<br />";
	echo "title : ".$title[$i]."<br />";
	echo "description : ".$descript[$i]."<br />";
	echo "latitude : ".$latitude[$i]."<br />";
	echo "longitude : ".$longitude[$i]."<br />";
} */
?>
</body>
</html>