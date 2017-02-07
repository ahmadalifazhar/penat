<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Watch List</title>
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>


<script>

 function makesure() {
  if (confirm('Confirm Remove Job Post From Watch List?')) {
    return true;
  }
  else {
    return false;
  }
 }
</script>
<?php 
$offlineDB = 'config/dbconnect.php';

if (file_exists($offlineDB)) {
    include("config/dbconnect.php");
} else {

include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
}
?>
</head>
<body class="metrouicss">
<div style=" padding:30px; overflow:hidden">

 <table class="striped" >
<?php
	  $uid = $account[aid];
	  
	  $ujobwatchlist_query = mysql_query("SELECT * FROM ujobwatchlist WHERE uid=$uid ");
	  
	  while($ujobwatchlistArray = mysql_fetch_array($ujobwatchlist_query)){
		  
		 $wathclist_jid = $ujobwatchlistArray['jid'];
		  
	 	 $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jid=$wathclist_jid  GROUP BY TIMESTAMP DESC ");
	  
	  		while($jobByTitleArray = mysql_fetch_array($jobByTitle_query)){
	  
	 ?>
      <tr>
			<td>
            <div style="display:inline-block; width:100%">
			<div style="float:left;"><h3 style="color:#000"><strong><?php echo $jobByTitleArray['jtitle']; ?></strong></h3></div>
            <div style="float:right; padding-top:2px"><em>Closing Date : <?php echo $jobByTitleArray['jdeadline']; ?></em></div>
            </div>
			<br /><br />
			<div id="jobDescription">
			<?php echo $jobByTitleArray['jdescription']; ?>
			</div>
			<br />
			<div id="jobFooter">
		   <a href="#" onclick="window.open('?op=job&load=viewMore&jid=<?php echo $jobByTitleArray['jid']; ?>', 'Full Job Post', 'toolbar=yes,resizable=yes,scrollbars=yes,width=800,height=500,left=20,top=20');" title="View Full Job Details"> View Full Details , </a>
			  <?php $jCompanyAdd = $jobByTitleArray['jCompanyAddress']; ?>
			  <a href="#" onclick="window.open('?op=job&load=viewOnMap&jid=<?php echo $jobByTitleArray['jid']; ?>', 'Job Location','toolbar=yes,resizable=yes,scrollbars=yes,width=800,height=600,left=20,top=20');" title="View The Job Location"> View Location , </a>
				 <a href="#" onclick="window.open('?op=job&load=viewRoute&latXX=<?php echo $jobByTitleArray['jlat']; ?>&lonYY=<?php echo $jobByTitleArray['jlon']; ?>', 'Job Driving Route', 'toolbar=yes,resizable=yes,scrollbars=yes,width=800,height=600,left=20,top=20');" title="View Driving Route From Current Location To Job Location"> View Route , </a>
				 <a href="?op=job&load=removeFromList&jid=<?php echo $jobByTitleArray['jid']; ?>" onclick="return makesure();" >  Remove From Watch List </a>
			</div>
            <div style="display:inline-block; width:100%">
            <div style="float:left">
            <h6><em>
		   Category : <?php echo $jobByTitleArray['jcategory']; ?>, Country : <?php echo $jobByTitleArray['jcountry']; ?>, Date Posted : <?php echo $jobByTitleArray['TIMESTAMP']; ?>
		   </em></h6>
            </div>
            <div style="float:right"><h6><em><?php echo $jobByTitleArray['jCompanyName']; ?></em></h6>
            </div>
            
            </div>
			</td>
			<td style="width:30%;">
			 <div class="image-collection" >
				<div >
					<img src="<?php echo $jobByTitleArray['jCompanyLogo']; ?>" title="<?php echo $jobByTitleArray['jtitle']; ?>" />
					<div class="overlay"> <?php echo $jobByTitleArray['jCompanyName']; ?></div>
				</div>
			</div>
			</td>
		  </tr>
  
  <?php
	  }
}
?>
</table>
</div>
</body>
</html>