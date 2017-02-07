<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../../../metro/css/modern.css" rel="stylesheet"> 
<link href="../../../metro/css/modern-responsive.css" rel="stylesheet"> 
<link href="../../../metro/css/site.css" rel="stylesheet" type="text/css">
<link href="js/tinybox/tiny.css" rel="stylesheet" type="text/css">
<script type="text/JavaScript" src="../../../metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="../../../metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../../../metro/js/assets/moment.js"></script>
<script type="text/javascript" src="../../../metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/carousel.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/slider.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/tile-slider.js"></script>
<script type="text/javascript" src="../../../metro/js/modern/tile-drag.js"></script>

<script type="text/javascript">

function getName(value){
	$.post("searchproduct2.php",{partialProductName:value},
	
	function(data){
		
		$("#results").html(data);
	});

}

function getByType(value1,value2)
{
	if(value1!="")
	{
   		$.post("searchproduct3.php",{partialProductName:value1,ptype:value2},
		  
		function(data){
			$("#results").html(data);
		});
	}
	else
	{
		$.post("searchproduct4.php",{ptype:value2},
		  
		function(data){
			$("#results").html(data);
		});
	}
}

//set autofocus cursor
$(document).ready(function() {
  $("#productName").focus();
});

</script>

<title>Untitled Document</title>
</head>

<body class="metrouicss" onload='getByType("","all")' style="overflow-x:hidden">

<table width="100%">
  <tr>
    <td width="50%">
    <div class="input-control text">
    <input type="text" id="searchText" name="searchText" onkeyup="getName(this.value)" placeholder="Product Name">
    <button class="btn-clear" tabindex="-1" type="button"></button></div>
    </td>
    <td><div class="input-control select">
    <select name="ptype" id="ptype" onchange="getByType(searchText.value,this.value)">
            	<option selected="selected" value="all">All category</option>
            	<option value="Vehicles">Vehicles</option>
                <option value="Properties">Properties</option>
                <option value="Electronics">Electronics</option>
                <option value="Personal Items">Personal Items</option>
                <option value="Hobbies">Hobbies</option>
                <option value="Services">Services</option>
                <option value="Others">Others</option>
    </select>
</div></td>
  </tr>
  
<tr>
<td colspan="2" style="height:100%">
<div id="results" class="style1" style="height:100%"></div>
</td>
</tr>

</table>

</body>
</html>