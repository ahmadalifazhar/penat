<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
<?php 
$offlineDB = 'config/dbconnect.php';

if (file_exists($offlineDB)) {
    include("config/dbconnect.php");
} else {

include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
}
?>
</head>
<body class="metrouicss">
<div style="padding:30px">

   
          <table>
          <tr>
          <td><div class="input-control text" style="width:400px; float:left">
          <input type="text" id="searchText" placeholder="Enter Job Title" autofocus/>
          <button class="btn-clear"></button>
          </div>
          </td>
          <td>
          <div class="input-control select" style="width:400px;">
        <select name="jobCategory" id="jobCategory" required>
            <option selected disabled="disabled" value="">--Select Category--</option>
          <?php    
          $query_selectCat = "SELECT * FROM category GROUP BY jcat_name ASC ";
          $array_selectCat=mysql_query($query_selectCat) or die(mysql_error());
          while($rowCat=mysql_fetch_array($array_selectCat))
          { ?>
          <option value="<?php echo $rowCat['jcat_id']; ?>"><?php echo $rowCat['jcat_name']; ?></option>
          <?php
          }?>
        </select>
    </div>
    </td>
          <td>
<div class="input-control select">
        <select name="jobCountry" id="jobCountry" required>
            <option selected disabled="disabled" value="">--Select Country--</option>
          <?php    
          $query_selectCountry = "SELECT * FROM country GROUP BY country_name ASC ";
          $array_selectCountry=mysql_query($query_selectCountry) or die(mysql_error());
          while($rowCountry=mysql_fetch_array($array_selectCountry))
          { ?>
          <option value="<?php echo $rowCountry['country_code']; ?>"><?php echo $rowCountry['country_name']; ?></option>
          <?php
          }?>
        </select>
    </div>
          </td>
          </tr>
          </table>  
         <button class="bg-color-blue fg-color-white" onclick="window.open('?op=job&load=postJob', 'Post New Job', 'toolbar=no,resizable=yes,scrollbars=yes,width=800,height=500,left=20,top=20');" title="Post New Job">Post New Job</button>
          
            
<table class="bordered">
  <tr>
    <td>
    <div id="wrapper" style="display: table;">
    <div id="divTitle" ><a href="#">_JOBTITLE_</a></div>
    <div id="divOtionMenu" style="display:none">
    <a href="#" onclick="TINY.box.show({iframe:'?op=job&load=viewMore',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})" > View Full Post , </a>
        <a href="#" onclick="TINY.box.show({iframe:'?op=job&load=viewOnMap&latXX=2.308092&lonYY=102.319204',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})" >View Location , </a>
         <a href="#" onclick="TINY.box.show({iframe:'?op=job&load=viewRoute&latXX=2.308092&lonYY=102.319204',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})" > View Route , </a>
        <a href="#" >  Add To List</a>
    </div>
    </div>
    Category : _CATEGORY_ , Posted at : _POSTDATETIME_ .
    </td>
    <td style="width:30%">_COMPANYLOGO_</td>
  </tr>
</table>

<br />
<br />
<br />
</div>
</body>
</html>