<?php
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
<html class="ui-mobile"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><!--<base href="http://jsfiddle.net/Lp9P2/822/show/">--><base href="."> 
  <title>inbox</title>
      <!--<script type="text/javascript" src="../js/jquery-1.7.1.js"></script>-->
      <link rel="stylesheet" type="text/css" href="../css/normalize.css">
      <link rel="stylesheet" type="text/css" href="../css/result-light.css">
      <link rel="stylesheet" type="text/css" href="../css/jquery.mobile-1.1.0.min.css">
      <link rel="stylesheet" type="text/css" href="../css/jquery.mobile.structure-1.1.0.min.css">
      <!--<script type="text/javascript" src="../js/jquery.mobile-1.1.0.min.js"></script>-->
  <style type="text/css">
    table {
    color: black;
    background: #fff;
    border: 1px solid #b4b4b4;
    font: bold 17px helvetica;
    padding: 0;
    margin-top:10px;
    width: 100%;
    -webkit-border-radius: 8px;
}   
table tr td {
    color: #666;
    border-bottom: 1px solid #b4b4b4;
    border-right: 1px solid #b4b4b4;
    padding: 10px 10px 10px 10px;
    background-image: -webkit-linear-gradient(top, #fdfdfd, #eee);
}        
table tr td:last-child {
    border-right: none;
}
table tr:last-child td {
    border-bottom: none;
}
p.ui-title {
	font-family:"Segoe UI"
	font-size:11pt;
}
  </style>
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){

});//]]>  
</script>
</head>
<body class="ui-mobile-viewport ui-overlay-c">
  <div data-role="page" data-url="/Lp9P2/822/show/" tabindex="0" class="ui-page ui-body-c ui-page-active" style="min-height: 640px;">
    <div data-role="header" data-theme="b" class="ui-header ui-bar-b" role="banner">
        <p class="ui-title">Setting</p>
    </div><!-- /header -->
    <div data-role="content" class="ui-content" role="main">    
       <table>
           <tbody>
           <tr><td><p style="font-weight:bold">
<P><B>Picture Profile</B></p>
<form method="POST" enctype="multipart/form-data" action="">
	Choose Your photo
	  <p><input type="file" name="gfx" size="20">
	    <BR>
<BR>
<input type="hidden" value="1" name="upload"><input type="submit" value="Upload!" name="opchk"><input type="reset" value="Reset" name="B2">
  </p>
</form>		
</p>
           </td></tr>
       </tbody></table>
    </div><!-- /content -->
</div><!-- /page -->
<div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon ui-icon-loading"></span><h1>loading</h1></div></body></html>