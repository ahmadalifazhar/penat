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

<script type="text/javascript">

function makesure() {
  if (confirm('Confirm Remove Company Profile?')) {
    return true;
  }
  else {
    return false;
  }
 }

</script>

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
?>

</head>

<body class="metrouicss">

<style>.progress{position:relative;width:100%;border:1px solid #000;padding:1px;border-radius:3px;}.bar{background-color:rgb(70,70,70);width:18.5575%;height:30px;border-radius:3px;}</style>
<div>
  <fieldset>
<legend style="color:black;">Company Profile List</legend>

 <table class="striped" style="overflow:hidden">
      <?php    
          $query_selectProfile = "SELECT profileid,profileName FROM jobCompanyProfile WHERE uid = '$uid' GROUP BY profileid ASC ";
          $array_selectProfile=mysql_query($query_selectProfile) or die(mysql_error());
          while($rowProfile=mysql_fetch_array($array_selectProfile))
          { ?>
     			 <tr>
			<td>
                 <a href="#" onclick="window.open('?op=job&load=viewProfile&profileid=<?php echo $rowProfile['profileid']; ?>', 'Company Profile', 'toolbar=yes,resizable=yes,scrollbars=yes,width=600,height=500,left=20,top=20');" title="View Profile"><?php echo $rowProfile['profileName']; ?></a>
                 </td>
                 <td>
                <a href="#" onclick="window.open('?op=job&load=updateCompany&profileid=<?php echo $rowProfile['profileid']; ?>', 'Company Profile', 'toolbar=yes,resizable=yes,scrollbars=yes,width=600,height=500,left=20,top=20');" title="View Profile">Update</a>
                 </td>
                 <td>
                <a href="?op=job&load=deleteCompanyProcess&pid=<?php echo $rowProfile['profileid']; ?>" onclick="return makesure();" >Delete</a>
                 </td>
                 </tr>
     
      <?php
          }?>
          
          </table>

</fieldset>
</div>
<div>
<fieldset>
<legend style="color:black;">Manage Profile</legend>
<blockquote>
<button onclick="window.open('?op=job&load=addProfile', 'Add Profile', 'toolbar=yes,resizable=yes,scrollbars=yes,width=800,height=500,left=20,top=20');" title="Add New Company Profile">Add New Profile</button>
</blockquote>
</fieldset>
</div>

</body>
</html>