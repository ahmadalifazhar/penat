<?php
	if (!$member)
		die("You need to relogin");

	//$friendq = mysql_query("SELECT * FROM accounts, friends WHERE !(friends.aid!=$chkid AND friends.faid!=$chkid) AND accounts.aid=friends.aid AND friends.faid>=0 GROUP BY friends.aid, accounts.aid");
	$friendList = array();
	$friendListN = 0;
//	$friendq = mysql_query("SELECT accounts.aid, accounts.afname, accounts.alname, accounts.apic, (SELECT COUNT(f.aid) FROM friends f WHERE f.faid=accounts.aid) AS totalfriend, (SELECT COUNT(posts.pid) FROM posts WHERE posts.proot=accounts.aid) AS totalpost, (SELECT COUNT(friends.aid) FROM friends WHERE friends.faid=$chkid AND friends.aid=accounts.aid) AS isfriend FROM ".$_REQUEST[target].", accounts, posts WHERE ".$_REQUEST[target].".target=".$_REQUEST[pid]." AND accounts.aid=".$_REQUEST[target].".aid GROUP by accounts.aid ORDER BY totalfriend, totalpost DESC");
	$friendq = mysql_query("SELECT aid FROM ".$_REQUEST[target]." WHERE ".$_REQUEST[target].".target=".$_REQUEST[pid]);
	while ($friendr = mysql_fetch_array($friendq))
	{
		$friendr = switchdb($friendr);
		$pic = $friendr[arealpic];
		$friendr[apic] = $pic;
		$friendList[$friendListN] = $friendr;
		$friendListN++;
	}
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
    <H3 style="margin-top:14px;" align="center">Peoples who <?php echo $_REQUEST[dtarget];?> this post</H3>   
    
    


<table class="bordered">
  <tr>
  	<td colspan="2"><H3 style="margin-top:10px;" align="left">Friend List</H3></td>
    </tr>
  
  <?php
  foreach ($friendList as $friendr)
  {
	  if ($friendr[isfriend] >= 1)
		  $btnName = "Remove friend";
	  else
		  $btnName = "Add as Friend";
  ?>
  <tr>
    <td width="80%">
    
    	<div class="replies" style="margin-top:2px;margin-bottom:-6px;mergin-left:-4px;">
		<div class="bg-color-blue">
			<div class="avatar"><a href="?op=profile&profile=<?php echo $friendr[aid];?>"><img width=48 height=48 src="<?php echo $friendr[apic];?>"></a></div>
			<div class="reply">
            <div class="author" style="size:20px"><?php echo $friendr[afname];?> <?php echo $friendr[alname];?></div>
            <div class="text"> <?php echo $friendr[totalfriend];?> Friends . <?php echo $friendr[totalpost]; ?> Pins</div>
        </div>
		</div>
	</div>

    </td>
    <td width="20%" valign="top"><?php if ($chkid != $friendr[aid]) {?><form method=post action="?op=friends" name="haa">
    <input type=hidden name=aid value="<?php echo $friendr[aid];?>">
    
      <input type="submit" name="opchk" id="opchk" value="<?php echo $btnName;?>" style="margin-top:2px;margin-right:-1px;">
    </form><?php }?></td>
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