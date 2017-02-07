<?php
session_start();



include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";

echo $account["auname"];
$_SESSION['username'] = $account["auname"];// Must be already set
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd" >

<html>
<head>
<title>Sample Chat Application</title>
<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
</style>

<link type="text/css" rel="stylesheet" media="all" href="/modules/pages/job/images/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="/modules/pages/job/images/screen.css" />

<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->

</head>
<body>
<div id="main_container">

<a href="javascript:void(0)" onClick="javascript:chatWith('janedoe')">Chat With Jane Doe</a>
<a href="javascript:void(0)" onClick="javascript:chatWith('zenyth89')">Chat With Zack</a>
<a href="javascript:void(0)" onClick="javascript:chatWith('Marhazk')">Chat With Marhazk</a>
<a href="javascript:void(0)" onClick="javascript:chatWith('ahmad_alif89')">Chat With Ahmad Alif</a>
<a href="javascript:void(0)" onClick="javascript:chatWith('aidy')">Chat With aidy</a>
<!-- YOUR BODY HERE -->

</div>

<script type="text/javascript" src="/modules/pages/job/images/jquery.js"></script>
<script type="text/javascript" src="/modules/pages/job/images/chat.js"></script>

</body>
</html>