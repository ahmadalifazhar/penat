<?php
ob_start();
?>

<div class="metrouicss">
  <div class="page-control" data-role="page-control" style="width:477px;margin-left:-9px;margin-top:-8px;"> <span class="menu-pull"></span>
    <div class="menu-pull-bar"></div>
    <ul>
      <li class="active"><a href="#newsfeedx" onclick="loadLog2();"><i class="icon-loop"></i>Newsfeed</a></li>
      <li><a href="#weather" onclick="loadLogWeather();">Weather</a></li>
      <li><a href="#news" onclick="loadLogNews();">News</a></li>
    </ul>
    <div class="frames">
     
      <div class="frame active" id="newsfeedx" style="margin-left:-10px;">
        <!-- start section of pin-it content -->
 
 		<div class="page-control" data-role="page-control" style="width:477px;margin-left:-11px;margin-top:-17px;>
        <span class="menu-pull"></span> 
        <div class="menu-pull-bar"></div>
        <ul>
            <li class="active"><a href="#pin-it"><i class="icon-comments-4"></i></a></li>
            <li><a href="#entertainment"><i class="icon-film"></i></a></li>
            <li><a href="#cloud"><i class="icon-upload"></i></a></li>
            <li><a href="#jobs"><i class="icon-briefcase-2"></i></a></li>
            <li><a href="#trades"><i class="icon-cart"></i></a></li>
            <li><a href="#promotions"><i class="icon-gift-2"></i></a></li>
            <li><a href="#traffic"><i class="icon-cars"></i></a></li>
            
        </ul>
        <div class="frames">
			<div class="frame active" id="pin-it" style="margin-left:-10px;">
            
            	<div class="metrouicss" id="newsfeedspost">
        
                    <form name="pinitpost" method="post" action="">
                      <input type="hidden" name="lat" id="latid">
                      <input type="hidden" name="lon" id="lonid">
                      <input type="hidden" name="locname" id="locnameid">
                      <input type="hidden" name="locname2" id="locname2id">
                        <div class="input-control textarea">
                            <textarea name="msg" id="msgpinit" cols="28" rows="5" placeholder="What up in your mind ?" style="
                           white-space: pre-wrap;     
                           white-space: -moz-pre-wrap; 
                           white-space: -pre-wrap;     
                           white-space: -o-pre-wrap;  
                           word-wrap: break-word;
                           margin-top:-7px;
                           width:460px;"></textarea>
                            <div style="display:none" id="listag"> </div>
                        </div>
                      <button class="image-button bg-color-greenDark fg-color-white" type="submit" name="opchk" id="opchkpinit" value="PinIt!"> Pin-It! <i class="icon-location bg-color-blue"></i> </button>
                      <button class="image-button bg-color-greenDark fg-color-white" type="button" onclick="TINY.box.show({iframe:'?op=cloud&go=upload',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){}})"> Upload Files <i class="icon-upload bg-color-blue"></i> </button>
                    </form>
                </div>
            	
                <div style="display:none"  id="ajaxBusy">
                  <center>
                    <p><img src="images/loading.gif"></p>
                  </center>
                </div>
                
                <div class="metrouicss" id="newsfeeds"><?php $newDB = $newsfeedrDB; include "modules/pages/home/member.newsfeeds.php"; echo $newf;?></div>
            
            
            
            </div>
            <div class="frame" id="entertainment" style="margin-left:-10px;"><?php $newDB = $sqlcatDB[1]; include "modules/pages/home/member.newsfeeds.php"; echo $newf;?></div>
            <div class="frame" id="cloud" style="margin-left:-10px;"><?php $newDB = $sqlcatDB[3]; include "modules/pages/home/member.newsfeeds.php"; echo $newf;?></div>
            <div class="frame" id="jobs" style="margin-left:-10px;"><?php $newDB = $sqlcatDB[0]; include "modules/pages/home/member.newsfeeds.php"; echo $newf;?></div>
            <div class="frame" id="trades" style="margin-left:-10px;"><?php $newDB = $sqlcatDB[4]; include "modules/pages/home/member.newsfeeds.php"; echo $newf;?></div>
			<div class="frame" id="promotions" style="margin-left:-10px;"><?php $newDB = $sqlcatDB[5]; include "modules/pages/home/member.newsfeeds.php"; echo $newf;?></div>
			<div class="frame" id="traffic" style="margin-left:-10px;"><?php $newDB = $sqlcatDB[2]; include "modules/pages/home/member.newsfeeds.php"; echo $newf;?></div>
        </div>
    </div>
 
        
      </div>
    
      
      <div class="frame" id="weather" style="margin-left:-10px;"><?php include "modules/pages/home/member.weather.php"; ?></div>
      <div class="frame" id="news" style="margin-left:-10px;"><?php include "modules/pages/home/member.news.php"; ?></div>
    </div>
  </div>
</div>
<?php $leftside = ob_get_clean();?>
