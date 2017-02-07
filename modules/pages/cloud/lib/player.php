
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="metro/js/player/mediaelementplayer.css" />
<script type="text/javascript"
   src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js">
</script>
 
<!-- 2. flowplayer -->
<script type="text/javascript"
   src="//releases.flowplayer.org/5.4.1/flowplayer.min.js">
</script>
 
<!-- 3. skin -->
<link rel="stylesheet" type="text/css" href="//releases.flowplayer.org/5.4.1/skin/minimalist.css">
<script type="text/javascript" src="metro/js/player/audio-player.js"></script>
</head>
<body>
<?php 
if (($_REQUEST[play] == "1"))
{
	?>
<script type="text/javascript">  
            AudioPlayer.setup("metro/js/player/player.swf", {  
                width: 290  
            });  
        </script> 
<script type="text/javascript">  
        AudioPlayer.embed("audioplayer_1", {soundFile: "<?php echo 'modules/pages/cloud/files/'.$_REQUEST[id].'/'.$_REQUEST[file];?>", autostart:"yes", animation:"no"});  
        </script>
<div id="audioplayer_1">&nbsp;</div>
<?php
}
else if ($_REQUEST[play] == "2")
{
	?>
    <div class="flowplayer">
   <video>
      <source type="video/mp4" src="<?php echo 'modules/pages/cloud/files/'.$_REQUEST[id].'/'.$_REQUEST[file];?>">
   </video>
</div>

<?php   
}?>
</body>
</html>