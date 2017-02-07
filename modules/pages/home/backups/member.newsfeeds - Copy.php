<?php
ob_start();
	foreach($newsfeedrDB as $newsfeedr)
	{
		
	if (file_exists("./images/uploaded_images/resized/".$newsfeedr[apic].".jpg"))
		$pic = "./images/uploaded_images/resized/".$newsfeedr[apic].".jpg";
	else
		$pic = "./images/nopic.jpg";
	?>
   
     <div class="replies" style="margin-left:15px;margin-top:5px;">
	<div class="bg-color-greenDark">
    <b class="sticker sticker-left sticker-color-greenDark"></b>
    		<div class="avatar"><a href="#" onClick="TINY.box.show({iframe:'?op=profile&profile=<?php echo $newsfeedr[aid];?>',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><img src="<?php echo $pic;?>" width="40" height="40" align="right" /></a></div>
        	<div class="reply">
        	<div class="date">currrr</div>
            <div class="author" style="color:#FFF"><a href="#" onClick="TINY.box.show({iframe:'?op=profile&profile=<?php echo $newsfeedr[aid];?>',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><?php echo $newsfeedr[afname];?><?php echo $newsfeedr[alname];?></a></div>
            <div class="text"><?php echo $newsfeedr[ptext];?></div>
            
            <div class="text"><?php
	$num = 0;
	$enableLike = true;
	$likeq = mysql_query("SELECT * FROM likes WHERE target=".$newsfeedr[pid]);
	while ($likerow = mysql_fetch_array($likeq))
	{
		if ($likerow[aid] == $chkid)
			$enableLike = false;
		$num++;
	}
	if ($num >= 1)
	{
	?><?php echo $num;?> Likes
          <?php } ?> <?php
	$num = 0;
	$enableDislike = true;
	$dlikeq = mysql_query("SELECT * FROM dislikes WHERE target=".$newsfeedr[pid]);
	while ($dlikerow = mysql_fetch_array($dlikeq))
	{
		if ($dlikerow[aid] == $chkid)
			$enableDislike = false;
		$num++;
	}
	if ($num >= 1)
	{
	?>
          . <?php echo $num;?> Hates
          <?php } ?> </div>
        </div>
     </div>
   </div>
   
    <?php
$commentq = mysql_query("SELECT * FROM posts, accounts WHERE posts.proot=".$newsfeedr[pid]." AND accounts.aid=posts.aid ORDER BY posts.pid ASC");
while ($commentr = mysql_fetch_array($commentq))
{
	$commentr[ptext] = pintext($commentr[ptext], $accDB);
	if (file_exists("./images/uploaded_images/resized/".$commentr[apic].".jpg"))
	{
		$cpic = "./images/uploaded_images/resized/".$commentr[apic].".jpg";
		echo " <table width=100% height=100% style=\"margin-bottom:0px;\">";
	}
	else
		$cpic = "./images/nopic.jpg";
	?>
 <div class="replies" style="margin-left:15px;margin-top:-9px">
	<div class="bg-color-greenDark">
    	<div class="avatar"><a href="#" onClick="TINY.box.show({iframe:'?op=profile&profile=<?php echo $commentr[aid];?>',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><img src="<?php echo $cpic;?>"><BR /></a></div>
        <div class="reply">
        	<div class="date">caaaa</div>
            <div class="author"><a href="#" onClick="TINY.box.show({iframe:'?op=profile&profile=<?php echo $commentr[aid];?>',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><?php echo $commentr[afname];?> <?php echo $commentr[alname];?></a></div>
            <div class="text"><?php echo $commentr[ptext]; ?></div>
        </div>
     </div>
   </div>
      <?php
}
?>
    
    
 
    <form id="form2" name="form2" method="post" action="">
      <input type=hidden name=pid value="<?php echo $newsfeedr[pid];?>" />
      <input type=hidden name=aid value="<?php echo $newsfeedr[aid];?>" />
   
        <?php
$commentq = mysql_query("SELECT * FROM posts, accounts WHERE posts.proot=".$newsfeedr[pid]." AND accounts.aid=posts.aid ORDER BY posts.pid ASC");
while ($commentr = mysql_fetch_array($commentq))
{
	$commentr[ptext] = pintext($commentr[ptext], $accDB);
	if (file_exists("./images/uploaded_images/resized/".$commentr[apic].".jpg"))
	{
		$cpic = "./images/uploaded_images/resized/".$commentr[apic].".jpg";
		echo " <table width=100% height=100% style=\"margin-bottom:0px;\">";
	}
	else
		$cpic = "./images/nopic.jpg";
	
	
	?>
      
        <?php
}
?>
      </table>
      
      <div id="adiv<?php echo $newsfeedr[pid];?>" style="font:24px bold; display: block; margin-top:20px;">
        <p>
          <?php if ($enableLike) { ?>
          <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="PinLike!"> Pinlike </button>
          <?php } else {?>
          <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="UnPinLike!"> Unpinlike </button>
          <?php } ?>
          <?php if ($enableDislike) { ?>
           <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="PinDislike!"> Pinhate </button>
          <?php } else {?>
        <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="UnPinDislike!"> Unpinhate </button>
          <?php } ?>
         
           <button class="mini bg-color-greenDark fg-color-white" type="button" onclick="hideshow(document.getElementById('adiv<?php echo $newsfeedr[pid];?>'),document.getElementById('bdiv<?php echo $newsfeedr[pid];?>'))"> Reply </button>
          </p>
      </div>
      <div id="bdiv<?php echo $newsfeedr[pid];?>" style="font:24px bold; display: none">
        <p>
         <textarea placeholder="Reply here..." name="msg" id="msg" rows="3" style="
   white-space: pre-wrap;     
   white-space: -moz-pre-wrap; 
   white-space: -pre-wrap;     
   white-space: -o-pre-wrap;  
   word-wrap: break-word; 
   width:100%;    
" onMouseOut="javascript:hideshow(document.getElementById('adiv<?php echo $newsfeedr[pid];?>'),document.getElementById('bdiv<?php echo $newsfeedr[pid];?>')"></textarea>
        
         
        </p>
        <p>
          <?php if ($enableLike) { ?>
          <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="PinLike!"> Pinlike </button>
        
          <?php } else { ?>
          <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="UnPinLike!"> Unpinlike </button>
         
          <?php } ?>
          <?php if ($enableDislike) { ?>
          <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="PinDislike!"> Pinhate </button>
      
          <?php } else { ?>
          <button class="mini bg-color-blue fg-color-white" type="submit" name="opchk" id="opchk" value="UnPinDislike!"> Unpinhate </button>
        
          <?php } ?>
          <button class="mini bg-color-greenDark fg-color-white" type="submit" name="opchk" id="opchk2" value="PinReply!"> Reply </button>
         
        </p>
      </div>
    </form>
    <p>&nbsp;</p>
      </td>
    
      </tr>
    
    <tr>
      <td colspan=2></td>
    </tr>
    
    <?php } ?>
     
  </table>
 
  </table>
  <?php /*?>

<table>
  <?php
	foreach($newsfeedrDB as $newsfeedr)
	{
		
	if (file_exists("./images/uploaded_images/resized/".$newsfeedr[apic].".jpg"))
		$pic = "./images/uploaded_images/resized/".$newsfeedr[apic].".jpg";
	else
		$pic = "./images/nopic.jpg";
	?>
  <tr>
    <td><img width=28 height=28 src="<?php echo $pic;?>"> <?php echo $newsfeedr[afname];?> <?php echo $newsfeedr[alname];?></td>
    <td><?php echo $newsfeedr[ptext];?></td>
  </tr>
  <tr>
    <td width=30%></td>
    <td width=70%><?php
	$num = 0;
	$enableLike = true;
	$likeq = mysql_query("SELECT * FROM likes WHERE target=".$newsfeedr[pid]);
	while ($likerow = mysql_fetch_array($likeq))
	{
		if ($likerow[aid] == $chkid)
			$enableLike = false;
		$num++;
	}
	if ($num >= 1)
	{
	?>
      <p><i><?php echo $num;?> likes this post</i></p>
      <?php } ?>
      <?php
	$num = 0;
	$enableDislike = true;
	$dlikeq = mysql_query("SELECT * FROM dislikes WHERE target=".$newsfeedr[pid]);
	while ($dlikerow = mysql_fetch_array($dlikeq))
	{
		if ($dlikerow[aid] == $chkid)
			$enableDislike = false;
		$num++;
	}
	if ($num >= 1)
	{
	?>
      <p><i><?php echo $num;?> dislikes this post</i></p>
      <?php } ?>
      <form id="form2" name="form2" method="post" action="">
        <input type=hidden name=pid value="<?php echo $newsfeedr[pid];?>" />
        <input type=hidden name=aid value="<?php echo $newsfeedr[aid];?>" />
        <table width=100%>
          <?php
$commentq = mysql_query("SELECT * FROM posts, accounts WHERE posts.proot=".$newsfeedr[pid]." AND accounts.aid=posts.aid ORDER BY posts.pid ASC");
while ($commentr = mysql_fetch_array($commentq))
{
	if (file_exists("./images/uploaded_images/resized/".$commentr[apic].".jpg"))
		$cpic = "./images/uploaded_images/resized/".$commentr[apic].".jpg";
	else
		$cpic = "./images/nopic.jpg";
	?>
          <tr>
            <td width=30%><img width=50 height=55 src="<?php echo $cpic;?>"><BR />
              <?php echo $commentr[afname];?> <?php echo $commentr[alname];?></td>
            <td width=70%><?php echo $commentr[ptext];?></td>
          </tr>
          <?php
}
?>
        </table>
        <div id="adiv<?php echo $newsfeedr[pid];?>" style="font:24px bold; display: block">
          <p>
            <?php if ($enableLike) { ?>
            <input type="submit" name="opchk" id="opchk" value="PinLike!" />
            <?php } else {?>
            <input type="submit" name="opchk" id="opchk" value="UnPinLike!" />
            <?php } ?>
            <?php if ($enableDislike) { ?>
            <input type="submit" name="opchk" id="opchk" value="PinDislike!" />
            <?php } else {?>
            <input type="submit" name="opchk" id="opchk" value="UnPinDislike!" />
            <?php } ?>
            <a href="javascript:hideshow(document.getElementById('adiv<?php echo $newsfeedr[pid];?>'),document.getElementById('bdiv<?php echo $newsfeedr[pid];?>'))">
            <input type="button" name="opchk" id="opchk" value="PinReply!" />
            </a> </p>
        </div>
        <div id="bdiv<?php echo $newsfeedr[pid];?>" style="font:24px bold; display: none">
          <p>
            <textarea name="msg" id="msg" rows="5" onMouseOut="javascript:hideshow(document.getElementById('adiv<?php echo $newsfeedr[pid];?>'),document.getElementById('bdiv<?php echo $newsfeedr[pid];?>')"></textarea>
          </p>
          <p>
            <?php if ($enableLike) { ?>
            <input type="submit" name="opchk" id="opchk" value="PinLike!" />
            <?php } else { ?>
            <input type="submit" name="opchk" id="opchk" value="UnPinLike!" />
            <?php } ?>
            <?php if ($enableDislike) { ?>
            <input type="submit" name="opchk" id="opchk" value="PinDislike!" />
            <?php } else { ?>
            <input type="submit" name="opchk" id="opchk" value="UnPinDislike!" />
            <?php } ?>
            <input type="submit" name="opchk" id="opchk2" value="PinReply!" />
          </p>
        </div>
      </form>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan=2></td>
  </tr>
  <?php } ?>
</table><?php */?>

<?php $newf = ob_get_clean();?>