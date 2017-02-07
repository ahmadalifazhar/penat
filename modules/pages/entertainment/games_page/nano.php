<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pin-It Games</title>
</head>



<?php
$detail[pid] = "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
$detail[ptext] = "is playing Nano Kingdoms 2 via Pin-IT Entertainment";
$detail[lat] =  $account[alat];
$detail[lon] =  $account[alon];
$detail[locname] = ""; //Problems since IFRAME, use 0 instead of $_POST[locname]
$detail[pcat] = 1200;
$detail[pdate] = date('Y-m-d G:i:s', time()); //Date of Post
$detail[ptype] = 0; //(0 = Post Status, 1=Status comment)
$detail[proot] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid
$detail[aid] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid 
(mysql_query(gendata("posts", $detail, "INSERT")))
?>
<body bgcolor="#000000">
<table>
<tr>
<td valign="middle" align="center">
<embed width="700" height="480" base="http://external.kongregate-games.com/gamez/0016/1289/live/" src="http://external.kongregate-games.com/gamez/0016/1289/live/embeddable_161289.swf" type="application/x-shockwave-flash"></embed>
</td>
</tr>
</table>
</body>
</html>