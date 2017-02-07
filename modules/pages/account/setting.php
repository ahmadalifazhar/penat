<?php
	if (!$member)
		die("You need to relogin");
if ($opchk == "Upload!")
{
	include "modules/uploadsys.php";
	$pic = uploadpic($_POST);
	if ($pic[success])
	{
		$details[apic]		= $pic[filename];
		$detailswhr[aid]	= $chkid;
		if (mysql_query(gendata("accounts", $details, $detailswhr)))
			msg("NOTICE", "You have uploaded your default photo");
		else
			msg("ERROR", "Picture failed");
	}
}
?><!DOCTYPE html>
<!-- saved from url=(0035)http://jsfiddle.net/Lp9P2/822/show/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><!--<base href="http://jsfiddle.net/Lp9P2/822/show/">--><base href="."> 
  <title>inbox</title>
      <!--<script type="text/javascript" src="../js/jquery-1.7.1.js"></script>-->
      <link rel="stylesheet" type="text/css" href="modules/pages/home/css/normalize.css">
      <link rel="stylesheet" type="text/css" href="modules/pages/home/css/result-light.css">
      <link rel="stylesheet" type="text/css" href="modules/pages/home/css/jquery.mobile-1.1.0.min.css">
      <link rel="stylesheet" type="text/css" href="modules/pages/home/css/jquery.mobile.structure-1.1.0.min.css">
      <link href="metro/css/modern.css" rel="stylesheet">
	<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
      <!--<script type="text/javascript" src="../js/jquery.mobile-1.1.0.min.js"></script>-->
  <style type="text/css">
   
  </style>
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){

});//]]>  
</script>
</head>
<body class="metrouicss">
<div class="metrouicss">
<H3 style="margin-top:14px;" align="center">General Account Settings</H3>
 
 <table class="bordered" style="margin-top:10px;">
        <tr>
        <td align="left"><H3 style="margin-top:10px;">User Profile Picture</H3><form method="POST" enctype="multipart/form-data" action="">
	  <input type="file" name="gfx" size="20" style="margin-bottom:5px;">
	  <input type="hidden" value="1" name="upload">
	  
      <input type="submit" value="Upload!" name="opchk" style="margin-left:250px;">
      <input type="reset" value="Reset" name="B2" style="margin-right:0px;">
  
</form>	</td>
        </tr>
        
        <tr>
        <td align="left"><H3 style="margin-top:10px;margin-bottom:2px;">User Name</H3><form method="POST" enctype="multipart/form-data" action=""><br/>
        <div class="input-control text">
        <input type="text" style="width:300px;margin-bottom:5px;" value=""><input type="submit" value="Change" name="opchk" style="margin-left:265px;margin-bottom:0px;margin-right:0px;">
    	</div>
</form>	</td>
        </tr>
        
        <tr>
        <td align="left"><H3 style="margin-top:10px;margin-bottom:2px;">First Name</H3><form method="POST" enctype="multipart/form-data" action=""><br/>
        <div class="input-control text">
        <input type="text" style="width:300px;margin-bottom:5px;" value=""><input type="submit" value="Change" name="opchk" style="margin-left:265px;margin-bottom:0px;margin-right:0px;">
    	</div>
</form>	</td>
        </tr>
        
        <tr>
        <td align="left"><H3 style="margin-top:10px;margin-bottom:2px;">Last Name</H3><form method="POST" enctype="multipart/form-data" action=""><br/>
        <div class="input-control text">
        <input type="text" style="width:300px;margin-bottom:5px;" value=""><input type="submit" value="Change" name="opchk" style="margin-left:265px;margin-bottom:0px;margin-right:0px;">
    	</div>
</form>	</td>
        </tr>
        
        <tr>
        <td align="left"><H3 style="margin-top:10px;margin-bottom:2px;">Password</H3><form method="POST" enctype="multipart/form-data" action=""><br/>
        <H4>Here we in Pin-It team suggest you to change the password every 2-4 months. This will increase the security of your account and prevent future social intrusion. To gain your confidence with us we have implemented all appropriate measures to provide the maximum amount of protection to our client.</H4>
        <div class="input-control password">
        <input type="password" style="width:300px;"/><H5>Enter Current Password</H5>
    	</div>
    	<div class="input-control password">
        <input type="password" style="width:300px;"/><H5>Enter New Password</H5>
    	</div>
   		<div class="input-control password">
        <input type="password" style="width:300px;"/><input type="submit" value="Change" name="opchk" style="margin-left:265px;margin-bottom:0px;margin-right:0px;"><H5>Confirm Password</H5>
		</div>
		</form>	
		</td>
        </tr>
        
        <tr>
        <td align="left"><H3 style="margin-top:10px;margin-bottom:2px;">Privacy</H3><form method="POST" enctype="multipart/form-data" action=""><br/>
        <H4>By turning on the privacy control, this could enhance the security of your profile by limitating your activity by your connected friends only. In this case your activity cannot be seen by other persons / unknown user.</H4>
        <div>
        <label class="input-control checkbox" style="margin-bottom:5px;">
        <input type="checkbox">
        <span class="helper">Set my privacy on</span>
    	</label>
        <input type="submit" value="Save Changes" name="opchk" style="margin-left:423px;margin-bottom:10px;margin-right:0px;">
        </form>
        </div>	
		</td>
        </tr>
        
 </table>
</div>
</body>
<div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon ui-icon-loading"></span><h1>loading</h1></div></body></html>