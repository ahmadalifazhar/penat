<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<link href="metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="metro/js/player/mediaelementplayer.css" />
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
<script type="text/javascript" src="metro/js/tinybox/tinybox.js"></script>

<script>
$(document).ready(function(){
     $("#openOption1,#openOption2").mouseover(function () {
             $("#tdOption1,#tdOption2").slideToggle('fast');		 
      });
	 
	
});


</script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$('#wrapper').hover(
    function(){$('#divOtionMenu').stop().fadeIn(100);},
    function(){$('#divOtionMenu').stop().fadeOut(100);}
);
});//]]>  

</script>


<style>
.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: rgb(0, 130, 135); width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
<title>Pin __SYSNAME__</title>
</head>

<body class="metrouicss">

<div class="nav-bar bg-color-darken">
  <div class="nav-bar-inner"> <span class="element">Pin __SYSNAME__ :: _AFNAME_ _ALNAME_</span> <span class="divider"></span>
    <ul class="menu">
      <li><a href="?op=home">Pin-It Home</a></li>
      <li data-role="dropdown"> <a href="#">Others</a>
        <ul class="dropdown-menu">
          <li><a href="?op=entertainment">Entertainment</a></li>
          <li><a href="?op=traffics">Traffics</a></li>
          <li><a href="?op=cloud">Cloud</a></li>
          <li><a href="?op=shopping">Shopping Tracker</a></li>
          <li><a href="?op=trades">Trades</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div><br />

<div class="page">
  <div class="page-header">
    <div class="page-header-content">
      <h1> Welcome, <span class="fg-color-pink">_AFNAME_ _ALNAME_</span>.</h1>
    </div>
  </div>
  <div class="page-region">
    <div class="page-region-content">
      <div class="page-control" data-role="page-control"> 
        <!-- Responsive controls --> 
        <span class="menu-pull"></span>
        <div class="menu-pull-bar"></div>
        <!-- Tabs -->
        <ul>
          <li class="active"><a href="#latestJobs">Latest Jobs Post</a></li>
          <li><a href="#myJobPost">My Job Post</a></li>
          <li><a href="#setting">Setting</a></li>
        </ul>
        <!-- Tabs content -->
        <div class="frames">
        <!-- Start Latest jobs content div-->
          <div class="frame active" id="latestJobs">
          
          <div id="searchJob">
          <div class="input-control text" style="width:400px;">
          <input type="text" id="searchText" placeholder="Enter Job Title" autofocus/>
          <button class="btn-clear"></button>
          </div>
          
          <button class="bg-color-blue fg-color-white" onclick="TINY.box.show({iframe:'?op=job&load=postJob',boxid:'frameless',width:750,height:600,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){}})">Post a Job</button>
          
          </div>
            
<table class="bordered">
  <tr>
    <td>
    <div id="wrapper" style="display: table;">
    <div id="divTitle" ><a href="#">_JOBTITLE_</a></div>
    <div id="divOtionMenu" style="display:none">
        <a href="#" onclick="TINY.box.show({iframe:'?op=job&load=viewOnMap&latXX=2.308092&lonYY=102.319204',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})" > | View On Map | </a>
        <a href="?op=home&latXX=2.308092&lonYY=102.319204" > | View In Pin.It | </a>
         <a href="#" onclick="TINY.box.show({iframe:'?op=job&load=viewRoute&latXX=2.308092&lonYY=102.319204',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})" > | View Route | </a>
        <a href="#" > | Add To List |</a>
    </div>
    </div>
    Category : _CATEGORY_ , Posted at : _POSTDATETIME_ .
    </td>
    <td style="width:30%">_COMPANYLOGO_</td>
  </tr>
</table>



            
            
          </div>
          <!-- End Latest jobs content div-->
          
          <!-- Start My jobs Posts content div-->
          <div class="frame" id="myJobPost">
            
            <div id="searchJob">
          <div class="input-control text" style="width:400px;">
          <input type="text" placeholder="Enter Job Title" autofocus/>
          <button class="btn-clear"></button>
          </div>
          </div>
            
<table class="bordered">
  <tr>
    <td>
    _JOBTITLE_<br />
    _POSTDATETIME_<br />
    _CATEGORY_<br />
    <button id="openOption2" class="mini bg-color-blue fg-color-white">Options</button>
    </td>
  </tr>
  
  <tr >
    
    <td id="tdOption2" style="display:none">
      <button class="mini" onclick="TINY.box.show({iframe:'?op=home&go=jobId',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})">View Map</button>
  <a href="?op=home">
  <button class="mini">View in Pin-It</button></a>
  <button class="mini" onclick="TINY.box.show({iframe:'?op=job&load=editJob',boxid:'frameless',width:750,height:600,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){}})">Edit</button>
  <button class="mini">Delete</button>
 </td>
    
    </tr>
   
</table>
            
          </div>
          <!-- End My jobs Posts content div-->
          
          
           <!-- Start Settings content div-->
          <div class="frame" id="setting">
<style>.progress{position:relative;width:100%;border:1px solid #000;padding:1px;border-radius:3px;}.bar{background-color:rgb(70,70,70);width:18.5575%;height:30px;border-radius:3px;}</style>
<div>
<fieldset>
<legend style="color:black;">Cloud Information</legend>
<div class="progress">
<div class="bar"></div></div><br/>
<blockquote>Total upload size: <strong>37.115 MB (18.5575 %)</strong><br/>
Total remaining size: <strong>162.885 MB (81.4425 %)</strong></blockquote>
</fieldset>
</div>
<div>
<fieldset>
<legend style="color:black;">Privacy Settings</legend>
<blockquote>Privacy setting here</blockquote>
</fieldset>
</div>
<div>
<fieldset>
<legend style="color:black;">Need more space?</legend>
<blockquote>some text here</blockquote>
</fieldset>
</div>
</div>
          <!-- End Settings content div-->
          
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>



