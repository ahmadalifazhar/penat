<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>

<title>Untitled Document</title>
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
$uid = $account[aid];
$profile_id = $_REQUEST['profileid'];
?>

</head>

<body class="metrouicss">
 <table class="striped" style="overflow:hidden">
      <?php    
          $query_selectProfile = "SELECT * FROM jobCompanyProfile WHERE profileid = '$profile_id' GROUP BY profileid ASC ";
          $array_selectProfile=mysql_query($query_selectProfile) or die(mysql_error());
          while($rowProfile=mysql_fetch_array($array_selectProfile))
          { ?>
     			 <tr>
			<td>
            <div class="image-collection" >
				<div >
					<img src="<?php echo $rowProfile['companyLogo']; ?>" title="<?php echo $rowProfile['companyName']; ?>" />
					<div class="overlay"><?php echo $rowProfile['companyName']; ?></div>
				</div>
			</div>
                 </td>
                 </tr>
                 <tr>
			<td>Name :
                 <h3> <?php echo $rowProfile['companyName']; ?></h3>
                 </td>
                 </tr>
                 <tr>
			<td>Address :
                 <h4><?php echo $rowProfile['companyAddress']; ?></h4>
                 </td>
                 </tr>
                 <tr>
			<td>Telephone Number :
                 <h4><?php echo $rowProfile['companyTel']; ?></h4>
                 </td>
                 </tr>
                 <tr>
			<td>Email :
                 <?php echo $rowProfile['companyEmail']; ?>
                 </td>
                 </tr>
                 <tr>
			<td>Date Added : 
                 <h5><em><?php echo $rowProfile['dateAdded']; ?></em></h5>
                 </td>
                 </tr>
     
      <?php
          }?>
          
          </table>
</body>
</html>