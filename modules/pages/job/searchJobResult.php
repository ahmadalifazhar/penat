<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

 <table class="striped" style="overflow:hidden">
<?php
	  
	  $partialJobTitle = $_POST['partialJobTitle'];
	  $partialJobCategory = $_POST['jobCategory'];
	  $partialJobCountry = $_POST['jobCountry'];
	  
	  //----------------1 All not Set
			  if(empty($partialJobTitle) && empty($partialJobCategory) && empty($partialJobCountry)){
				
		
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
           
           
           <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
           
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
 
 
 //----------------2 Set Title only
 if(!empty($partialJobTitle) && empty($partialJobCategory) && empty($partialJobCountry)){
	 

		
			  $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jtitle LIKE '%$partialJobTitle%' GROUP BY TIMESTAMP DESC ");
			  
			  if(mysql_num_rows($jobByTitle_query) > 0){
			  
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
           
           <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
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
		else{
				  echo "<h3>No Results</h3>";
			  }
 }
 
  //----------------3 Set Title and category only, country not set
   if(!empty($partialJobTitle) && !empty($partialJobCategory) && empty($partialJobCountry)){

			  
			  $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jtitle LIKE '%$partialJobTitle%' AND jcategory = '$partialJobCategory' GROUP BY TIMESTAMP DESC ");
			  
			  if(mysql_num_rows($jobByTitle_query) > 0){
			  
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
           
            <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
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
		else{
				  echo "<h3>No Results</h3>";
			  }
 }
 
 
  //---------------- All is Set
if(!empty($partialJobTitle) && !empty($partialJobCategory) && !empty($partialJobCountry)){

		
			  $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jtitle LIKE '%$partialJobTitle%' AND jcategory = '$partialJobCategory' AND jcountry =  '$partialJobCountry' GROUP BY TIMESTAMP DESC ");
			  
			  if(mysql_num_rows($jobByTitle_query) > 0){
			  
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
           
            <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
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
		else{
				  echo "<h3>No Results</h3>";
			  }
 }
 
  //---------------- Set title and country only
if(!empty($partialJobTitle) && empty($partialJobCategory) && !empty($partialJobCountry)){

		
			   $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jtitle LIKE '%$partialJobTitle%' AND jcountry = '$partialJobCountry' GROUP BY TIMESTAMP DESC ");
			  
			  if(mysql_num_rows($jobByTitle_query) > 0){
			  
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
           
            <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
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
		else{
				  echo "<h3>No Results</h3>";
			  }
 }
 
  //----------------6 Set Category and country only
if(empty($partialJobTitle) && !empty($partialJobCategory) && !empty($partialJobCountry)){

	
			 $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jcategory = '$partialJobCategory' AND jcountry =  '$partialJobCountry' GROUP BY TIMESTAMP DESC ");
			  
			  if(mysql_num_rows($jobByTitle_query) > 0){
			  
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
           
            <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
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
		else{
				  echo "<h3>No Results</h3>";
			  }
 }
 
  //----------------7 set category only
  if(empty($partialJobTitle) && !empty($partialJobCategory) && empty($partialJobCountry)){

	 
	 		  $JobCategory = $_POST['jcategory'];
		
			  $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jcategory = '$partialJobCategory' GROUP BY TIMESTAMP DESC ");
			  
			  if(mysql_num_rows($jobByTitle_query) > 0){
			  
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
           
            <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
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
		else{
				  echo "<h3>No Results</h3>";
			  }
 }
 
  //----------------8 set country only
if(empty($partialJobTitle) && empty($partialJobCategory) && !empty($partialJobCountry)){


			  $jobByTitle_query = mysql_query("SELECT * FROM jobpost WHERE jcountry = '$partialJobCountry' GROUP BY TIMESTAMP DESC ");
			  
			  if(mysql_num_rows($jobByTitle_query) > 0){
			  
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
           
            <?php 
$getuid = $jobByTitleArray['uid'];
$user = accdb($getuid);
?>		   
           
<img src="/images/<?php echo isonline($user);?>.gif">

<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $user[auname]; ?>')">Chat With <?php echo $user[afname]; ?></a>
           
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
		else{
				  echo "<h3>No Results</h3>";
			  }
 }
 
 
?>
</table>
</body>
</html>