<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="metro/js/player/mediaelementplayer.css" />
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
<script type="text/javascript" src="metro/js/tinybox/tinybox.js"></script>

<script>
$(document).ready(function(){
     $("#openOption1,#openOption2").mouseover(function () {
             $("#tdOption1,#tdOption2").slideToggle('fast');		 
      });
	 
	
});


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

<body class="metrouicss" >

 <table class="striped" style="min-height:600px; overflow:hidden">
<?php
	  
	  $partialJobTitle = $_POST['jobTitle'];
	  $partialJobTitle = $_POST['jobCategory'];
	  $partialJobTitle = $_POST['jobCountry'];
	  
	  $jobByTitle_query = mysql_query("SELECT * FROM jobpost GROUP BY TIMESTAMP DESC ");
	  
	  while($jobByTitleArray = mysql_fetch_array($jobByTitle_query)){
	  
	 ?>
     <script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$('#wrapper<?php echo $jobByTitleArray['jid']; ?>').hover(
    function(){$('#divOptionMenu<?php echo $jobByTitleArray['jid']; ?>').stop().fadeIn(100);},
    function(){$('#divOptionMenu<?php echo $jobByTitleArray['jid']; ?>').stop().fadeOut(100);}
);
});//]]>  

</script>
     
     
  <tr>
    <td>
    <div id="wrapper<?php echo $jobByTitleArray['jid']; ?>" style="display: table;">
   <div id="divTitle"><a href="#" style="font-size:20px"><?php echo $jobByTitleArray['jtitle']; ?></a> </div>
    <div id="divOptionMenu<?php echo $jobByTitleArray['jid']; ?>" style="display:none">
    <a href="#" onclick="window.open('?op=job&load=viewMore', 'Full Job Post', 'toolbar=yes,resizable=yes,scrollbars=yes,width=800,height=500,left=20,top=20');" title="View More"> View Full Post , </a>
        <a href="#" onclick="window.open('?op=job&load=viewOnMap&latXX=<?php echo $jobByTitleArray['jlat']; ?>&lonYY=<?php echo $jobByTitleArray['jlon']; ?>', 'View Job Location', 'toolbar=yes,resizable=yes,scrollbars=yes,width=800,height=500,left=20,top=20');" title="View Job Location On Map">View Location , </a>
         <a href="#" onclick="window.open('?op=job&load=viewRoute&latXX=<?php echo $jobByTitleArray['jlat']; ?>&lonYY=<?php echo $jobByTitleArray['jlon']; ?>', 'Job Driving Route', 'toolbar=yes,resizable=yes,scrollbars=yes,width=800,height=500,left=20,top=20');" title="View Driving Route From Current Location To Job Location"> View Route , </a>
        <a href="#" >  Add To List</a>
    </div>
    </div><br />
    <!--<div id="jobCompany"><?php //echo $jobByTitleArray['jCompany']; ?></div>-->
    <div id="jobDescription">
    Job Description:
    <?php echo $jobByTitleArray['jdescription']; ?>
    </div>
    <br />
    <div id="jobFooter">
   <h6><em>	Category : <?php echo $jobByTitleArray['jcategory']; ?>, Country : <?php echo $jobByTitleArray['jcountry']; ?>, Date Posted : <?php echo $jobByTitleArray['TIMESTAMP']; ?></em></h6>
    </div><div style="float:right">Closing Date : <?php echo $jobByTitleArray['jdeadline']; ?></div>
    </td>
    <td style="width:30%"><img src="" title="<?php echo $jobByTitleArray['jtitle']; ?>" /></</td>
  </tr>
  
  <?php
	  }
?>
</table>
</body>
</html>