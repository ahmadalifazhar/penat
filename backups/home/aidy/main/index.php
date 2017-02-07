<!doctype html>
<html>
<head>
	<title>Pin.It</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/style.css" type="text/css" rel="stylesheet" />
    
    
    <link href="css/modern.css" rel="stylesheet">
    <link href="css/modern-responsive.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet" type="text/css">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="js/assets/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="js/assets/jquery.mousewheel.min.js"></script>

    <script type="text/javascript" src="js/modern/dropdown.js"></script>
    <script type="text/javascript" src="js/modern/accordion.js"></script>
    <script type="text/javascript" src="js/modern/buttonset.js"></script>
    <script type="text/javascript" src="js/modern/carousel.js"></script>
    <script type="text/javascript" src="js/modern/input-control.js"></script>
    <script type="text/javascript" src="js/modern/pagecontrol.js"></script>
    <script type="text/javascript" src="js/modern/rating.js"></script>
    <script type="text/javascript" src="js/modern/slider.js"></script>
    <script type="text/javascript" src="js/modern/tile-slider.js"></script>
    <script type="text/javascript" src="js/modern/tile-drag.js"></script>
    <script type="text/javascript" src="js/modern/calendar.js"></script>
    
    
    
    
     <script src="js/jquery-1.8.2.js" type="text/javascript"></script>
	<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script type="text/javascript" src="js/map2.js"></script>
    
    
    <!---make conncetion to database---------------------------------------->
    <?php
    include 'connectDB.php';
	include 'cubapin.php';
    ?>
    <script type="text/javascript">
    function connectDB()
	{
		alert("<?php echo $out; ?>");
	}
    </script>
    <!---------------------------------------------->
	<script type="text/javascript">
		$(document).ready(function() {
		$("#PinItMap").height($(document).height()-65);
		});
	</script>
	<script type="text/javascript">


ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	//togglehtml: ["suffix", "<img src='plus.gif' class='statusicon' />", "<img src='minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})


</script>

<script type="text/javascript">
	
	function addStuff()
{
  var loc = document.getElementById('myDiv');
  var stuff = document.getElementById('in').value;
  var old = loc.innerHTML;
  loc.innerHTML = old+stuff+'<br />';
  var div = document.getElementById('myDiv');
  h = div.scrollHeight;
  div.scrollTop = h;
}


    </script>
    
    <!-- test menu slider start-->
    
    <style type='text/css'>
#sidebox {
	float:left;
    position:absolute;
    left:0px;
    top:0px;
    width:290;
    height:100%;
	z-index:888;
	
}

#sidebox .contentx {
	font:"Trebuchet MS", Arial, Helvetica, sans-serif;
	color:#FFF;
	padding-top: 10px;
	padding-left:10px;
	padding-right:10px;
    float:left;
    width:290px;
    height:100%;
	box-shadow: 1px 0px 3px #888888;
	background:#000;
	opacity:.5;
	z-index:9999;
	
}

#sidebox .tab {
	margin-top:90%;
    cursor:pointer;
    float:right;
    width:16px;
    height:60px;
	background-image:url(images/VmenuRec.png);
	box-shadow: 1px 0px 3px #888888;
	background-color:#888888;
	z-index:999
}

.tab: hover{
background-color:#fff;
}

  </style>
  


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$('#sidebox .tab').toggle(function(){
    $('#sidebox').animate({'left':-290});
	
}, function(){
    $('#sidebox').animate({'left':0});
});
});//]]>  

</script>
    
    <!-- end menu slider test-->
    
    
    
    
</head>
<body class="metrouicss" onLoad="connectDB();getMap();getCurrentLocation();cubapin();prettyPrint();">   <!-- updatePushpinLocation(); -->
<!-- Start Drop Down Top Menu-->

<div class="glossymenu">
<a class="menuitem submenuheader" >
<div class="menudot"><img src="images/menudot.png"></div>
</a>
<div class="submenu">
	<ul>
	<li>
    
    <div id="cssmenu" >
    <ul>
    	<li>
        	<a href="#"><img src="images/Personal.png" style="background-image:url(images/Personal.png);width:80px;height:80px;" alt=""></a>
        </li>
        
        <li>
        	<a href="#"><img src="images/Personal.png" style="background-image:url(/images/Personal.png);width:80px;height:80px;" alt=""></a>
        </li>
        
        <li>
        	<a href="#" target="_top"><img src="" style="background-image:url(/images/Personal.png);width:80px;height:80px;" alt=""></a>
        </li>
        
     </ul></div>
    
    
    </li>
	</ul>
</div>		
</div>

<!-- End DropDown Top Menu-->

	<div class="content">
    
    <!-- Start Block For Top Header
    
		<div class="top_block Top_Header">
			<div class="content">
            <!-- Start Content For Top Header-->
            
            <!-- End Content For Top Header
			</div>
		</div>
        
     <!-- End Block For Top Header-->
        
    
   
    
    
    <!-- Start Block For Left Live Bar
        <div class="background Left_LiveBar">
		</div>
		<div class="left_block Left_LiveBar">
			<div class="contentleft">
            <!-- Start Content For Left Live Bar-->
            
            
            
            
            <!-- End Content For Left Live Bar
			</div>
		</div>
       <!-- End Block For Left Live Bar-->
    
    

       
        
        
        
        
       <!-- Start Block For Center-->
		<div class="background Center">
		</div>
		<div class="center_block Center">
			<div class="content">
            <!-- Start Content For Center-->
            


        <!-- &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="AddCustomPushpin" onClick="addCustomPushpin();" />
         <input type="button" value="GetCurrentLocation" onClick="getCurrentLocation();" />
         <input type="button" value="Pin!" onClick="pin();" />-->
       
        <div id="sidebox">
 
  <div class="contentx">
  <br />
Welcome.<br />
<br />
       <div class="input-control text">


    <input type="text" class="with-helper" placeholder="What is in your mind?"/ />
    <button class="helper"></button>
    </div><input type="submit" value="PIN it"/>
  
  </div> <div class="tab"></div>
</div>
         
      
      
            <div id='PinItMap' ></div>
            <!-- End Content For Center-->
			</div>
		</div>
        <!-- End Block For Center-->
        
	</div>
</body>
</html>
