<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../../metro/css/modern.css" rel="stylesheet">
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet">
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="../../../metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link href="../metro/js/player/mediaelementplayer.css" rel="stylesheet" type="text/css"/>

</head>

<body class="metrouicss" >
<div style="overflow:hidden">
<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------

$aid = $_GET['profile'];

$rawuser = mysql_query("SELECT a.* FROM accounts a WHERE a.aid = '$aid'") or die(mysql_error());
$user = mysql_fetch_array($rawuser);
//echo $user['auname'];
$userpin = "@".$user['auname'];
?>
<p></p>
<form method="post" action="pinitprocess.php">
<input type="hidden" name="aid" value="<?php echo $aid; ?>" />
<div class="input-control textarea">
<textarea name="ptext"><?php echo $userpin; ?> </textarea>
</div>
<label class="input-control checkbox">
	<input type="checkbox" name="shareloc" value="1">
	<span class="helper">Share Location</span>
</label>
<br />
<button class="image-button bg-color-greenDark fg-color-white" type="submit" name="opchk" id="opchkpinit" value="PinIt!"> Pin-It! <i class="icon-location bg-color-blue"></i> </button>
</form>
</div>
</body>
</html>