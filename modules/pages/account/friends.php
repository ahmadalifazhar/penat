<?php
	if (!$member)
		die("You need to relogin");
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
	else if ($opchk == "Remove friend")
	{
		if (mysql_query("DELETE FROM friends WHERE (aid=$chkid AND faid=".$_POST[aid].") OR (faid=$chkid AND aid=".$_POST[aid].");"))
			msg("NOTIS", "Friend has been removed.");
		else
			msg("ERROR", "Friend failed to be removed.");
	}
	//$friendq = mysql_query("SELECT * FROM accounts, friends WHERE !(friends.aid!=$chkid AND friends.faid!=$chkid) AND accounts.aid=friends.aid AND friends.faid>=0 GROUP BY friends.aid, accounts.aid");
	$friendList = array();
	$friendListN = 0;
	//$friendq = mysql_query("SELECT accounts.aid,  accounts.afname, accounts.alname, accounts.apic, (SELECT COUNT(f.aid) FROM friends f WHERE f.faid=accounts.aid) AS totalfriend, (SELECT COUNT(posts.pid) FROM posts WHERE posts.proot=accounts.aid) AS totalpost FROM friends, accounts, posts WHERE friends.faid=$chkid AND accounts.aid=friends.aid GROUP by accounts.aid ORDER BY totalfriend, totalpost DESC");
?>
<!DOCTYPE html>
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
<body class="metrouicss">
<div class="metrouicss">
    <H3 style="margin-top:14px;" align="center">Search People List</H3>   
    <table class="bordered">
    <tr><td align="left"><H3 style="margin-top:10px;;margin-bottom:18px;">Get Connected With Others !</H3><form name="form1" method="post" action="" enctype="multipart/form-data">
   <div class="input-control text">
        <input type="text" name="search" id="search" style="width:500px;margin-bottom:5px;">
        <input type="submit" value="Search" name="opchk" style="margin-bottom:0px;margin-right:0px;margin-left:63px;">
    	</div>
</form> </td></tr>
    </table>
    
    

<?php
if ($opchk == "Search")
{
?>

<table class="bordered">
  <tr>
  	<td colspan="2"><H3 style="margin-top:10px;" align="left">Search Result</H3></td>
    </tr>
<?php
//$friendq = mysql_query("SELECT accounts.aid, accounts.afname, accounts.alname, accounts.apic, (SELECT COUNT(f.aid) FROM friends f WHERE f.faid=accounts.aid) AS totalfriend, (SELECT COUNT(posts.pid) FROM posts WHERE posts.proot=accounts.aid) AS totalpost FROM accounts, posts WHERE (accounts.afname LIKE '%".$_POST[search]."%' OR accounts.alname LIKE '%".$_POST[search]."%' OR accounts.auname LIKE '%".$_POST[search]."%' OR accounts.aemail LIKE '%".$_POST[search]."%') GROUP BY accounts.aid");
$friendq = mysql_query("SELECT aid FROM accounts WHERE (afname LIKE '%".$_POST[search]."%' OR alname LIKE '%".$_POST[search]."%' OR auname LIKE '%".$_POST[search]."%' OR aemail LIKE '%".$_POST[search]."%') GROUP BY aid");
while ($friendr = mysql_fetch_array($friendq))
{
	$friendr = $accDB["aid".$friendr[aid]];
	if ($friendr[isfriend])
		$btnName = "Remove friend";
	else
		$btnName = "Add As Friend";
	$pic = $friendr[arealpic];
?>
  <tr>
  <td width="85%"><div class="replies" style="margin-top:2px;margin-bottom:-6px;mergin-left:-4px;">
	<div class="bg-color-blue">
    	<div class="avatar"><a href="?op=profile&profile=<?php echo $friendr[aid];?>"><img width=48 height=48 src="<?php echo $pic;?>"></a></div>
        <div class="reply">
            <div class="author" style="size:20px"><?php echo $friendr[afname];?> <?php echo $friendr[alname];?></div>
            <div class="text"> <?php echo $friendr[totalfriend]; ?> Friends . <?php echo $friendr[totalpost]; ?> Pins</div>
        </div>
     </div>
   </div></td>
  
    
    <td width="15%" align="left" valign="top">
    <?php if ($chkid != $friendr[aid]) {?>
    <form method=post action="" name="haa">
    <input type=hidden name=aid value="<?php echo $friendr[aid];?>">
      <input type="submit" name="opchk" id="opchk" value="<?php echo $btnName;?>" style="margin-top:2px;margin-right:-1px;">
    </form><?php }?></td>
  </tr>
  <?php
  }
  ?>
 
</table>

<?php } ?>


<table class="bordered">
  <tr>
  	<td colspan="2"><H3 style="margin-top:10px;" align="left">Friend List</H3></td>
    </tr>
  
  <?php
  foreach ($accDB as $friendr)
  {
	  if ($friendr[isfriend])
	  {
  ?>
  <tr>
    <td width="80%">
    
    	<div class="replies" style="margin-top:2px;margin-bottom:-6px;mergin-left:-4px;">
		<div class="bg-color-blue">
			<div class="avatar"><a href="?op=profile&profile=<?php echo $friendr[aid];?>"><img width=48 height=48 src="<?php echo $friendr[arealpic];?>"></a></div>
			<div class="reply">
            <div class="author" style="size:20px"><?php echo $friendr[afname];?> <?php echo $friendr[alname];?></div>
            <div class="text"> <?php echo $friendr[totalfriend];?> Friends . <?php echo $friendr[totalpost]; ?> Pins</div>
        </div>
		</div>
	</div>

    </td>
    <td width="20%" valign="top"><form method=post action="" name="haa">
    <input type=hidden name=aid value="<?php echo $friendr[aid];?>">
      <input type="submit" name="opchk" id="opchk" value="Remove friend" style="margin-top:2px;margin-right:-1px;">
    </form></td>
  </tr>
  <?php
  } 
  }
  ?>
</table>
 </td></tr>
 
       </tbody></table>
    </div><!-- /content -->
</div><!-- /page -->
<div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon ui-icon-loading"></span><h1>loading</h1></div></body></html>