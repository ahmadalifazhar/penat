<?php
session_start();

$userunq  = $account["aid"];
$user = accdb($userunq);
$_SESSION['username'] = $userunq; // Must be already set
?>


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
function getTitle(value){
	$.post("?op=job&load=viewAllJob",{partialJobTitle:value, jobCategory: document.getElementById("jobCategory").value, jobCountry: document.getElementById("jobCountry").value},
	
	function(data){
		
		$("#results").html(data);
	});

}

function getCat(value){
	$.post("?op=job&load=viewAllJob",{jobCategory:value, partialJobTitle: document.getElementById("searchText").value, jobCountry: document.getElementById("jobCountry").value},
	
	function(data){
		
		$("#results").html(data);
	});

}

function getCountry(value){
	$.post("?op=job&load=viewAllJob",{jobCountry:value, partialJobTitle: document.getElementById("searchText").value, jobCategory: document.getElementById("jobCategory").value},
	
	function(data){
		
		$("#results").html(data);
	});

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
<div style="padding:30px">

   
          <table>
          <tr>
          <td><div class="input-control text" style="width:400px; float:left">
          <input type="text" id="searchText" placeholder="Enter Job Title" onkeyup="getTitle(this.value)" autofocus/>
          <button class="btn-clear"></button>
          </div>
          </td>
          <td>
          <div class="input-control select" style="width:400px;">
        <select name="jobCategory" id="jobCategory" onchange="getCat(this.value)" required>
            <option selected value="">--Select Category--</option>
          <?php    
          $query_selectCat = "SELECT * FROM category GROUP BY jcat_name ASC ";
          $array_selectCat=mysql_query($query_selectCat) or die(mysql_error());
          while($rowCat=mysql_fetch_array($array_selectCat))
          { ?>
          <option value="<?php echo $rowCat['jcat_name']; ?>"><?php echo $rowCat['jcat_name']; ?></option>
          <?php
          }?>
        </select>
    </div>
    </td>
          <td>
<div class="input-control select">
        <select name="jobCountry" id="jobCountry" onchange="getCountry(this.value)" required>
            <option selected value="">--Select Country--</option>
          <?php    
          $query_selectCountry = "SELECT * FROM country GROUP BY country_name ASC ";
          $array_selectCountry=mysql_query($query_selectCountry) or die(mysql_error());
          while($rowCountry=mysql_fetch_array($array_selectCountry))
          { ?>
          <option value="<?php echo $rowCountry['country_name']; ?>"><?php echo $rowCountry['country_name']; ?></option>
          <?php
          }?>
        </select>
    </div>
          </td>
          </tr>
          </table>  
          
            
            <div id="results" class="style1" style="width:100%;height:100%">
            
             <table class="striped" style="overflow:hidden">
<?php
			  $jobByTitle_query = mysql_query("SELECT * FROM jobpost GROUP BY TIMESTAMP DESC ");
			  
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
				<a href="?op=job&load=addToList&jid=<?php echo $jobByTitleArray['jid']; ?>" >  Add To List</a>
			</div>
            <div style="display:inline-block; width:100%">
            <div style="float:left">
            <h6><em>
		   Category : <?php echo $jobByTitleArray['jcategory']; ?>, Country : <?php echo $jobByTitleArray['jcountry']; ?>, Date Posted : <?php echo $jobByTitleArray['TIMESTAMP']; ?> 
		   
           <div id="main_container">
<?php echo $jobByTitleArray['uid']; ?>
<a href="javascript:void(0)" onClick="javascript:chatWith('Advertiser')">Chat With <?php echo $user[afname]; ?></a>
<a href="javascript:void(0)" onClick="javascript:chatWith('babydoe')"> Chat With John Doe</a>
<!-- YOUR BODY HERE -->

</div>
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

?>
         </table>  
            </div>
            
<!--<div style="margin: 0 auto; width:100%; min-height:600px; overflow:hidden">
    <object type="text/html" data="?op=job&load=viewAllJob" style="width:102%; min-height:600px; margin:1%;overflow:hidden">
    </object>
</div>-->

<br />
<br />
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
</body>
</html>