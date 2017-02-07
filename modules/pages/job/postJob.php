<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post a Job</title>

<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/assets/moment.js"></script>
<script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
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
$uid = $account[aid];
?>

<!-- map -->
<script type="text/javascript" src="metro/js/mapcontrol.ashx?v=7.0"></script>

<script type="text/javascript">
      var map = null;
	  var latUserLocation = null;
var lonUserLocation =null;
            
    function getMap()       
    {
        Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() 
        {
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), 
            { 
                  credentials: 'AmxdhBs_v4CGLnmLy1BSpfh2wnBLTEdD_NBB6QqF72MN_YnLRzvptDmaLR_RFqVK', 
                  theme: new Microsoft.Maps.Themes.BingTheme(),
				  showMapTypeSelector: false,
				  enableClickableLogo: false,
				  enableSearchLogo: false
				  
            }); 
        }});
		
		Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: getCurrentLocation });
		//setTimeout(getCurrentLocation,2000);
    }
      
	  
	  function getCurrentLocation(){
		
		var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);  
        geoLocationProvider.getCurrentPosition({ showAccuracyCircle: false,successCallback:displayCenter });
	  }
	  
	   function getDragLocation(){
		
		var geoLocationProvider = new Microsoft.Maps.GeoLocationProvider(map);  
        geoLocationProvider.getCurrentPosition({ showAccuracyCircle: false,successCallback:attachPushpinDragEndEvent });
	  }
	  
	  
	   function displayCenter(args)
         {
			var loc = args.center;
			//alert("pecah dua : latitude = "+loc.latitude+" longitude : "+loc.longitude);
			
			latUserLocation = loc.latitude;
			lonUserLocation = loc.longitude;
			//alert(latUserLocation+","+lonUserLocation);
			
			//set the global variable of current user location to use at create driving route function 
			//when user click from my location at create route dialog
			//window.myLoc =  latUserLocation+","+lonUserLocation;
			document.getElementById('jobLat').value = loc.latitude;
			document.getElementById('jobLon').value = loc.longitude;
			Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });
			//pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinUserLocation); 
			//map.entities.push(pushpin);
			//pushpin.setLocation(loc);
			
			
		 }
		 
		 
	  
      function attachPushpinDragEndEvent()
      {
		  
		
        var pushpinOptions = {draggable:true}; 
        var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions); 
        var pushpindragend= Microsoft.Maps.Events.addHandler(pushpin, 'dragend', endDragDetails);  
        map.entities.push(pushpin); 
        //alert('stop dragging newly added pushpin to raise event');
      }
      
      endDragDetails = function (e) 
      {
		  var loc = e.entity.getLocation();
		  	  
       
		//alert("lat : " + loc.latitude );
		document.getElementById('jobLat').value = loc.latitude;
		document.getElementById('jobLon').value = loc.longitude;
		latUserLocation = loc.latitude;
		lonUserLocation = loc.longitude;
		Microsoft.Maps.loadModule('Microsoft.Maps.Search', { callback: searchModuleLoaded });
      }
	  
	  
	  //search nama location by longitude dan latitude(alif) OLD
function searchModuleLoaded()
      {
		 
         var searchManager = new Microsoft.Maps.Search.SearchManager(map);

         var reverseGeocodeRequest = {location:new Microsoft.Maps.Location(latUserLocation,lonUserLocation), count:10, callback:reverseGeocodeCallback, errorCallback:errCallback};
         searchManager.reverseGeocode(reverseGeocodeRequest);
      }
	  
     
      function reverseGeocodeCallback(result, userData)
      {
         document.getElementById("jobAddress").value = result.name;
		 document.getElementById('viewLocation').innerHTML = "Job Will Be Pinned At : "+result.name;
      }


      function errCallback(request)
      {

         //alert("An error occurred! GeocodeRequest Failed");
      }
	  
      </script>
<!--end map function (alif 6/6/2013 12.12AM -->


<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

function isNumberKey(evt)
{
if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode==46)|| (event.keyCode==8) || (event.keyCode==9)|| (event.keyCode==17) || (event.keyCode==86)))
event.returnValue=false;
}


//function submitform(){
//document.getElementById("profileForm").submit();
//}

function submitform2(){
if( document.getElementById("jCompanyName").value == ""){
	
	alert("Please Select Company Profile");
	document.getElementById("CompanyProfile").focus();
}
else if( document.getElementById("jobTitle").value == ""){
	
	alert("Please Enter Job Title");
	document.getElementById("jobTitle").focus();
}
else if( document.getElementById("jobDescription").value == ""){
	
	alert("Please Enter Job Description");
	document.getElementById("jobDescription").focus();
}
else if( document.getElementById("jobResponsibilities").value == ""){
	
	alert("Please Enter Job Responsibilities");
	document.getElementById("jobResponsibilities").focus();
}
else if( document.getElementById("jobRequirements").value == ""){
	
	alert("Please Enter Job Requirements");
	document.getElementById("jobRequirements").focus();
}
else if( document.getElementById("jobCategory").value == ""){
	
	alert("Please Select Job Category");
	document.getElementById("jobCategory").focus();
}
else if( document.getElementById("jobCountry").value == ""){
	
	alert("Please Select Country");
	document.getElementById("jobCountry").focus();
}
else if( document.getElementById("jobState").value == ""){
	
	alert("Please Enter State");
	document.getElementById("jobState").focus();
}
else if( document.getElementById("jobDeadline").value == ""){
	
	alert("Please Select or Enter Application Deadline");
	document.getElementById("jobDeadline").focus();
}
   else{
	   document.getElementById("postJob").submit();
	   }
}
</script>


</head>
<body class="metrouicss" onload="getMap();getCurrentLocation();" style="width:90%; margin-left:auto; margin-right:auto">
 <div style="padding:30px">
 <em>Please Fill Out and Select All Required (<em style="color:red">*</em>) Fields</em><br /><br />
 


<form name="postJob" id="postJob" method="post" action="?op=job&load=postProcess" >
Job Title:<em style="color:red">*</em>
<div class="input-control text" autofocus>
        <input type="text" name="jobTitle" id="jobTitle" maxlength="500" onKeyDown="limitText(this.form.jobTitle,this.form.countdown,500);" 
onKeyUp="limitText(this.form.jobTitle,this.form.countdown,500);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown" size="1" value="500" disabled="disabled"> characters left.</font>
    </div>
    
Job Description :<em style="color:red">*</em>
<div class="input-control textarea">
        <textarea name="jobDescription" id="jobDescription" onKeyDown="limitText(this.form.jobDescription,this.form.countdown1,2000);" 
onKeyUp="limitText(this.form.jobDescription,this.form.countdown1,2000);" required></textarea>
<font size="1" style="float:right"> <input readonly type="text" name="countdown1" size="1" value="2000" disabled="disabled"> characters left.</font>
    </div>
    
    
Responsibilities :<em style="color:red">*</em>
<div class="input-control textarea">
        <textarea name="jobResponsibilities" id="jobResponsibilities" onKeyDown="limitText(this.form.jobResponsibilities,this.form.countdown2,2000);" 
onKeyUp="limitText(this.form.jobResponsibilities,this.form.countdown2,2000);"></textarea>
<font size="1" style="float:right"> <input readonly type="text" name="countdown2" size="1" value="2000" disabled="disabled"> characters left.</font>

    </div> 
    
    
Requirements :<em style="color:red">*</em>
<div class="input-control textarea">
        <textarea name="jobRequirements" id="jobRequirements" onKeyDown="limitText(this.form.jobRequirements,this.form.countdown3,2000);" 
onKeyUp="limitText(this.form.jobRequirements,this.form.countdown3,2000);"></textarea>
<font size="1" style="float:right"> <input readonly type="text" name="countdown3" size="1" value="2000" disabled="disabled"> characters left.</font>
    </div><br />

  
  
  
  <?php 
	 	  if(isset($_REQUEST['CompanyProfile'])){
			   $id = $_REQUEST['CompanyProfile'];
			   
			   $query1 = mysql_query("SELECT * FROM jobCompanyProfile WHERE profileid= '$id'");
			   while($query1Array = mysql_fetch_array($query1)){
				   ?>
	
				 <script type="text/javascript">  
				$(window).load(function(){
						

						document.getElementById("jCompanyName").value = "<?php echo $query1Array['companyName']; ?>";
						document.getElementById("jobPhoneNo").value = "<?php echo $query1Array['companyTel']; ?>";
						document.getElementById("jobEmail").value = "<?php echo $query1Array['companyEmail']; ?>";
						document.getElementById("jCompanyLogo").value = "<?php echo $query1Array['companyLogo']; ?>"; 
						//document.getElementById("companyAddress"). = "";
						
						
				});
				
				$(window).load(function(){
										   $('#companyAddress').val($('#tempText').val());
										   
										   });
				 
                 
                 </script>
                  
                  <textarea id="tempText" style="display:none"><?php echo $query1Array['companyAddress']; ?></textarea>
                  
                   <?php
			   }
			   
		  }
          
		  ?>
  
  <table width="100%">
  <tr>
    <td width="50%" style="border-style:none">Salary Option:
<div class="input-control select">
<select name="salary_type" id="salary_type">
  <option value="N/A" selected="selected">N/A</option>
  <option value="Negotiable">Negotiable</option>
  <option value="Non-Negotiable">Non-Negotiable</option>
</select>
</div>
    </td>
    <td rowspan="2">
    Company Address:
    <div class="input-control textarea">
        <textarea name="companyAddress" disabled="disabled" id="companyAddress" onKeyDown="limitText(this.form.companyAddress,this.form.countdown4,500);" 
onKeyUp="limitText(this.form.companyAddress,this.form.countdown4,500);"><?php echo $query1Array['companyAddress']; ?></textarea>
<font size="1" style="float:right"> <input readonly type="text" name="countdown4" size="1" value="500" disabled="disabled"> characters left.</font>
    </div>
    </td>
  </tr>
  <tr>
    <td>
      Job Category:<em style="color:red">*</em>
  <div class="input-control select">
    <select name="jobCategory" id="jobCategory" required>
      <option selected disabled="disabled" value="">--Select Category--</option>
      <?php    
          $query_selectCat = "SELECT * FROM category GROUP BY jcat_name ASC ";
          $array_selectCat=mysql_query($query_selectCat) or die(mysql_error());
          while($rowCat=mysql_fetch_array($array_selectCat))
          { ?>
      <option value="<?php echo $rowCat['jcat_name']; ?>"><?php echo $rowCat['jcat_name']; ?></option>
      <?php
          }?>
      </select>
    </div>
    </td>
    </tr>
  <tr>
    <td>
    Country:<em style="color:red">*</em>
<div class="input-control select">
        <select name="jobCountry" id="jobCountry" required>
            <option selected disabled value="">--Select Country--</option>
          <?php    
          $query_selectCountry = "SELECT * FROM country GROUP BY country_name ASC ";
          $array_selectCountry=mysql_query($query_selectCountry) or die(mysql_error());
          while($rowCountry=mysql_fetch_array($array_selectCountry))
          { ?>
          <option value="<?php echo $rowCountry['country_name']; ?>"><?php echo $rowCountry['country_name']; ?></option>
          <?php
          }?>
        </select>
    </div>
    </td>
    <td>
     Company Name :
    <div class="input-control text">
        <input type="text" disabled name="jCompanyName" id="jCompanyName" maxlength="500" onKeyDown="limitText(this.form.jCompanyName,this.form.countdown7,500);"
onKeyUp="limitText(this.form.jCompanyName,this.form.countdown7,500);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown7" size="1" value="500" disabled="disabled"> characters left.</font>
    </div>
    </td>
  </tr>
  <tr>
    <td>
    State:<em style="color:red">*</em>
    <div class="input-control text">
        <input type="text" name="jobState" id="jobState" maxlength="500" onKeyDown="limitText(this.form.jobState,this.form.countdown8,500);"
onKeyUp="limitText(this.form.jobState,this.form.countdown8,500);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown8" size="1" value="500" disabled="disabled"> characters left.</font>
    </div>
    </td>
    <td>
    Telephone Number :
    <div class="input-control text">
        <input type="text" disabled name="jobPhoneNo" id="jobPhoneNo" maxlength="11" onKeyDown="limitText(this.form.jobPhoneNo,this.form.countdown5,11);return isNumberKey(event);" 
onKeyUp="limitText(this.form.jobPhoneNo,this.form.countdown5,11);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown5" size="1" value="11" disabled="disabled"> characters left.</font>
    </div>
   
    </td>
  </tr>
  <tr>
  <td>
  <div class="input-control text">
   Application Deadline:<em style="color:red">*</em>
        <input type="date" name="jobDeadline" id="jobDeadline" style=" width: 500px; height:32px" placeholder="YYYY-MM-DD"/></div>
  </td>
  <td>
   Email :
    <div class="input-control text">
        <input type="text" disabled name="jobEmail" id="jobEmail" maxlength="200" onKeyDown="limitText(this.form.jobEmail,this.form.countdown6,200);" 
onKeyUp="limitText(this.form.jobEmail,this.form.countdown6,200);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown6" size="1" value="200" disabled="disabled"> characters left.</font>
    </div>
    <input type="hidden" id="jCompanyLogo" name="jCompanyLogo" />
  </td>
  </tr>
</table>


<div  align="left">
<button type="button" id="useMyLocation" onclick="$('#myMap').slideUp(1000);getCurrentLocation();" >Use Current Location</button>
<button type="button" id="onMapLocation" onclick="$('#myMap').slideDown(1000);map.entities.clear();getDragLocation();" >Pin Location on Map</button>
<div id="locButtons" style="color:#F00"></div>
<div id="viewLocation" style="color:#00F; font-size:18px"></div>
<div id='myMap' style="position:relative; width:100%; height:300px;display:none"></div>

</div>

<br />
<input type="hidden" name="jobAddress" id="jobAddress" required/>
<input type="hidden" name="jobLat" id="jobLat"/>
<input type="hidden" name="jobLon" id="jobLon"/>
<div align="right"><input type="reset"  value="Reset"/> <input type="button" name="opchk" id="opchk" value="PostJob" onclick="submitform2();"></div>
</form>

</div>
</body>
</html>
