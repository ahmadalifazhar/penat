<?php
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if (isset($_REQUEST['ids']))
{
	
}
else die();

if ($_POST[link] == 1)
{
	
	$col[cloud_id]		= $_REQUEST['ids'];
	$col[share_key]		= md5($userunq.$_REQUEST['ids']);
	
	if (mysql_query(gendata("share", $col, "INSERT")))
	{
		$web->msg("File recorded into database.");
	}
	else
		$web->msg("Database error.");
		
	
}
else if ($_POST[link] == 2)
{
	$dbr = new dbcon("localhost","root","", "blur");
	$dbr->setStatus(0);
	$qr = "DELETE FROM share WHERE cloud_id = '".$_REQUEST['ids']."'";
	$dbr->query($qr);
}

$shared = 0;
$db = new dbcon("localhost","root","", "blur");
$db->setStatus(0);
$q = "SELECT cloud_id FROM share WHERE cloud_id = '".$_REQUEST['ids']."'";
$r = $db->query($q);
if ($db->num_rows($r) == 1) 
{
	$shared = 1;
	$genlink =  'http://'.$host.$uri.'/share.php?skey='.md5($userunq.$_REQUEST['ids']);
}
	


	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/assets/moment.js"></script>
<script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="metro/js/modern/accordion.js"></script>
<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="metro/js/modern/carousel.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="metro/js/modern/rating.js"></script>
<script type="text/javascript" src="metro/js/modern/slider.js"></script>
<script type="text/javascript" src="metro/js/modern/tile-slider.js"></script>
<script type="text/javascript" src="metro/js/modern/tile-drag.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>

<script type="text/javascript" src="https://sites.google.com/site/yangshuai10/jquery.copy.js"></script>
<script>

   function copy()
   {
		var content = $("#linking").val();
	  window.prompt ("Copy to clipboard: Ctrl+C, Enter", content);
	
	}
      

</script>

</head>

<body class = "metrouicss">

<fieldset>
<div><h2>Instant Link</h2></div>
<div><h4>Instant link can be share to your friends although they are not in Pin-It network.</h4></div>
<div> <input style="width:100%" name="linking" id="linking" type="text" value="<?php if ($shared == 1){echo $genlink;} ?>" /><br /><h6><a href="#" onclick="copy();">Copy Link</a></h6></div><br />

<div>
<form action="?op=cloud&go=cshare&ids=<?php echo $_REQUEST['ids']; ?>" method="post">
  <button <?php if ($shared == 1){echo "disabled";} ?>> Get link </button>
  <input name="link" type="hidden" value="1" /><br />
  

</form>


</div>

<div>
<form action="?op=cloud&go=cshare&ids=<?php echo $_REQUEST['ids']; ?>" method="post">
  <button <?php if ($shared == 0){echo "disabled";} ?>> Remove link </button>
  <input name="link" type="hidden" value="2" /><br />
  </form>
</div>
</fieldset>
<!--<form action="?op=cloud&go=cshare" method="post">
  <button> timeline share </button>
  
</form>-->
</body>
</html>