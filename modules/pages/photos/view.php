
<h1>Galeri Gambar > <?php echo $hMosque[full];?></h1>

<div style="display:none;">
<span id="siteDomain">perfectworld.my</span>
<span id="backUrl">%2F?op=gfx&file=<?php echo $row[pfile];?></span>
<span id="fb-app-id">336851746368576</span>
<span id="fb-timeline-ns">pwmalaysia</span>
<span id="fbTimelineApi">pwmalaysia:pwaera_at?pwaera_post</span>
<span id="fb-publish-granted">0</span>
<span id="fb-publish-enabled">0</span>
<span id="fb-timeline-granted">0</span>
<span id="fb-timeline-enabled">0</span>

<span id="user-safe-mode">1</span>
<span id="page-contents-safe">1</span>

<span id="nsuon">1</span>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<center>

	<?php
		$sql = "SELECT * FROM photos WHERE pfile='".$_REQUEST[name]."' LIMIT 0,1";
		$query = mysql_query($sql);
		if ($query)
		{
			$row = mysql_fetch_array($query);
			$nextsql = "SELECT * FROM photos WHERE mID=".$row[cat]." AND pid>".$row[pid]." ORDER BY pid ASC LIMIT 0,1";
			$nextquery = mysql_query($nextsql);
			$nextrow = mysql_fetch_array($nextquery);
			$prevsql = "SELECT * FROM photos WHERE mID=".$row[cat]." AND pid<".$row[pid]." ORDER BY pid DESC LIMIT 0,1";
			$prevquery = mysql_query($prevsql);
			$prevrow = mysql_fetch_array($prevquery);
		}
		else
		{
			$row[pfile] = "error";
			$row[pdesc] = "ERROR: Photo you enter is invalid, please try again later.";
		}
	?>
    
    <?php if (!empty($nextrow[pfile]))
	{
		?>
    <a href="?op=photos/view&cat=<?php echo $nextrow[mID];?>&id=<?php echo $nextrow[pid];?>">Previous</a> |
    
    <?php } if (!empty($prevrow[pfile]))
	{
	?>
    <a href="?op=photos/view&cat=<?php echo $prevrow[mID];?>&id=<?php echo $prevrow[pid];?>">Next</a>
    <?php 
	}
	?><BR />
    
<a href="?op=gfx&file=<?php echo $row[pfile];?>"><img src="?op=gfx&file=<?php echo $row[pfile];?>" width=500>
<P>[CLICK TO ENLARGE]</a><BR>
    <?php if (!empty($nextrow[pfile]))
	{
		?>
    <a href="?op=photos/view&cat=<?php echo $nextrow[mID];?>&id=<?php echo $nextrow[pid];?>">Previous</a> |
    
    <?php } if (!empty($prevrow[pfile]))
	{
	?>
    <a href="?op=photos/view&cat=<?php echo $prevrow[mID];?>&id=<?php echo $prevrow[pid];?>">Next</a>
    <?php 
	}
	?>
	<BR /><b><?php echo $row[pname];?></b><br />
	<BR /><?php echo $row[pdesc];?></p>
</center>

<fb:comments href="http://www.e-mosque.tk/?op=photos/view&amp;cat=<?php echo $row[mID];?>&amp;id=<?php echo $row[pid];?>" num_posts="10" width="580"></fb:comments>
<p class="facebook-init-failed" style="display:none"></p>