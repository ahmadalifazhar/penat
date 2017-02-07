<?php 
	if ($opchk == "Add As Friend")
	{
		$detail[aid]		= $chkid;
		$detail[faid]		= $_POST[aid];
		$detail[approve]	= 0;
		if (mysql_query(gendata("friends", $detail, "INSERT")))
		{
			$detail[aid]		= $_POST[aid];
			$detail[faid]		= $chkid;
			$detail[approve]	= 0;
			if (mysql_query(gendata("friends", $detail, "INSERT")))
			{
				send_notification($chkid, $_POST[aid], "Friend request", "?op=view/friend&aid=".$_POST[aid]."&fid=".$chkid);
				msg("NOTIS", "You has add this as your friend");
			}
			else
				msg("ERROR", "Add friend failed");
		}
		else
			msg("ERROR", "Add friend failed");
		
	}
?>
<!DOCTYPE html>
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
        <p class="ui-title">Search People List</p>
    </div><!-- /header -->
    <div data-role="content" class="ui-content" role="main">    
       <table>
           <tbody>
           <tr><td>
<form name="form1" method="post" action="">
  Search:
  <input type="text" name="search" id="search">
  <input type="submit" name="opchk" id="opchk" value="Search">
</form>
<?php
if ($opchk == "Search")
{
	$friendq = mysql_query("SELECT * FROM accounts, friends WHERE !(friends.aid!=$chkid AND friends.faid!=$chkid) AND accounts.aid=friends.aid AND friends.faid>=0 GROUP BY friends.aid, accounts.aid");
	$notListed = array();
	$num = 0;
	while ($friendr = mysql_fetch_array($friendq))
	{
		$notListed[$num] = $friendr;
		$num++;
	}
?>

<p>&nbsp;</p>
<table width="100%" border="1">
  <tr>
    <td width="30%">&nbsp;</td>
    <td width="70%">&nbsp;</td>
  </tr>
  <?php
  $friendq = mysql_query("SELECT * FROM accounts");
  while ($friendr = mysql_fetch_array($friendq))
  {
	  $notListedBool = false;
	  foreach($notListed as $notlist)
	  {
		  if ($notlist[aid] == $friendr[aid])
		  {
			  $notListedBool = true;
			  continue;
		  }
	  }
	  if ($notListedBool)
	  		continue;
	if (file_exists("./images/uploaded_images/resized/".$friendr[apic].".jpg"))
		$pic = "./images/uploaded_images/resized/".$friendr[apic].".jpg";
	else
		$pic = "./images/nopic.jpg";
  ?>
  <tr>
    <td width="30%" align="center" valign="top"><img width=50 height=55 src="<?php echo $pic;?>"><BR><?php echo $friendr[afname];?> <?php echo $friendr[alname];?></td>
    <td width="70%" align="left" valign="top"><form method=post action="" name="haa">
    <input type=hidden name=aid value="<?php echo $friendr[aid];?>">
      <input type="submit" name="opchk" id="opchk" value="Add As Friend">
    </form></td>
  </tr>
  <?php
  }
  ?>
</table>

<?php } ?>
<p>&nbsp;</p>
<p><strong>Friend List</strong> </p>
<table width="100%" border="1">
  <tr>
    <td width="30%">&nbsp;</td>
    <td width="70%">&nbsp;</td>
  </tr>
  <?php
  $friendq = mysql_query("SELECT * FROM friends, accounts WHERE friends.aid=$chkid AND accounts.aid=friends.faid AND friends.faid>=1 GROUP by accounts.aid");
  while ($friendr = mysql_fetch_array($friendq))
  {
	if (file_exists("./images/uploaded_images/resized/".$friendr[apic].".jpg"))
		$pic = "./images/uploaded_images/resized/".$friendr[apic].".jpg";
	else
		$pic = "./images/nopic.jpg";
  ?>
  <tr>
    <td width="30%" align="center" valign="top"><img width=50 height=55 src="<?php echo $pic;?>"><BR><?php echo $friendr[afname];?> <?php echo $friendr[alname];?></td>
    <td width="70%" align="left" valign="top"><form method=post action="" name="haa">
    <input type=hidden name=aid value="<?php echo $friendr[aid];?>">
      <input type="submit" name="opchk" id="opchk" value="Remove from friend">
    </form></td>
  </tr>
  <?php
  }
  ?>
</table>
 </td></tr>
       </tbody></table>
    </div><!-- /content -->
</div><!-- /page -->
<div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon ui-icon-loading"></span><h1>loading</h1></div></body></html>