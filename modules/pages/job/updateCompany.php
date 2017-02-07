<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Company Profile</title>

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
$profile_id = $_REQUEST['profileid'];
?>

</head>

<body class="metrouicss">

<form name="updateCompany" method="post" action="?op=job&load=updateCompanyProcess">
 <?php    
          $query_selectProfile = "SELECT * FROM jobCompanyProfile WHERE profileid = '$profile_id' GROUP BY profileid ASC ";
          $array_selectProfile=mysql_query($query_selectProfile) or die(mysql_error());
          while($rowProfile=mysql_fetch_array($array_selectProfile))
          { ?>
          
 <table class="striped" style="overflow:hidden">
     
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
                 <td>
                 
                 Profile Name :
    <div class="input-control text">
        <input type="text" name="jProfileName" id="jProfileName" maxlength="100" onKeyDown="limitText(this.form.jProfileName,this.form.countdown8,100);"
onKeyUp="limitText(this.form.jProfileName,this.form.countdown8,100);" value="<?php echo $rowProfile['profileName']; ?>" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown7" size="1" value="100" disabled="disabled"> characters left.</font>
    </div> 
                 
                 </td>
                 </tr>
                 <tr>
			<td>Company Name :
            <div class="input-control text">
        <input type="text" name="jCompanyName" id="jCompanyName" maxlength="200" onKeyDown="limitText(this.form.jCompanyName,this.form.countdown7,200);"
onKeyUp="limitText(this.form.jCompanyName,this.form.countdown7,200);" value="<?php echo $rowProfile['companyName']; ?>" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown7" size="1" value="200" disabled="disabled"> characters left.</font>
    </div>
                 
                 </td>
                 </tr>
                 
                 <tr>
			<td>Address :
            <div class="input-control textarea">
        <textarea name="companyAddress" id="companyAddress" onKeyDown="limitText(this.form.companyAddress,this.form.countdown4,500);" 
onKeyUp="limitText(this.form.companyAddress,this.form.countdown4,500);"><?php echo $rowProfile['companyAddress']; ?></textarea>
<font size="1" style="float:right"> <input readonly type="text" name="countdown4" size="1" value="500" disabled="disabled"> characters left.</font>
    </div>
                
                 </td>
                 </tr>
                 <tr>
			<td>Telephone Number :
    <div class="input-control text">
        <input type="text" name="jobPhoneNo" id="jobPhoneNo" maxlength="11" onKeyDown="limitText(this.form.jobPhoneNo,this.form.countdown5,11);return isNumberKey(event);" 
onKeyUp="limitText(this.form.jobPhoneNo,this.form.countdown5,11);" value="<?php echo $rowProfile['companyTel']; ?>" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown5" size="1" value="11" disabled="disabled"> characters left.</font>
    </div>
               
                 </td>
                 </tr>
                 <tr>
			<td>Email :
            <div class="input-control text">
        <input type="text" name="jobEmail" id="jobEmail" maxlength="200" onKeyDown="limitText(this.form.jobEmail,this.form.countdown6,200);" 
onKeyUp="limitText(this.form.jobEmail,this.form.countdown6,200);" value="<?php echo $rowProfile['companyEmail']; ?>" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown6" size="1" value="200" disabled="disabled"> characters left.</font>
    </div>
                 
                 </td>
                 </tr>
     
      
          
          </table>
          <input type="hidden" id="companyLogo" name="companyLogo" value="<?php echo $rowProfile['companyLogo']; ?>" />
          <input type="hidden" id="pid" name="pid" value="<?php echo $profile_id ?>" />
           <button onclick="javascript:window.close();">Cancel</button>
          <input type="submit" value="Update" />
		  
		  <?php
          }?>
          </form>
</body>
</html>