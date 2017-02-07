<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Select Company Profile</title>

<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/assets/moment.js"></script>
<script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
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
?>

<script type="text/javascript">

function submitform(){
document.getElementById("profileForm").submit();
}

</script>

</head>

<body class="metrouicss">

<h3 align="center">Please Select Company Profile :</h3>
 <div class="input-control select" align="center">
   <form method="post" name="profileForm" id="profileForm" action="?op=job&load=postJob">
    <select name="CompanyProfile" id="CompanyProfile" onchange="submitform();">
      <option selected disabled="disabled" value="">--Select Profile--</option>
      <?php    
          $query_selectProfile = "SELECT profileid,profileName FROM jobCompanyProfile WHERE uid = '$uid' GROUP BY profileid ASC ";
          $array_selectProfile=mysql_query($query_selectProfile) or die(mysql_error());
		  
		 // if(mysql_num_rows($array_selectProfile) != 0){
 
          while($rowProfile=mysql_fetch_array($array_selectProfile))
          { ?>
      <option value="<?php echo $rowProfile['profileid']; ?>"><?php echo $rowProfile['profileName']; ?></option>
     
      <?php 
          }
		//  } else{ 
   // echo "<script>alert('You Did Not Have Any Company Profile, Please add one');<//script>";
	//echo "<script>windows.href.location='?op=job&load=addProfile'<//script>";
//}
		  
		  ?>
      </select>
        </form>
    </div>

</body>
</html>