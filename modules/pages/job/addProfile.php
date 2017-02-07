<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Company Profile</title>

<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/assets/moment.js"></script>
<script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>

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
</script>
</head>
<body class="metrouicss" onload="getMap();getCurrentLocation();" style="width:90%; margin-left:auto; margin-right:auto">

<div style="padding:30px">
<form name="postJob" enctype="multipart/form-data" method="post" action="?op=job&load=addProfileProcess" >

Profile Name :
    <div class="input-control text">
        <input type="text" name="jProfileName" id="jProfileName" maxlength="100" onKeyDown="limitText(this.form.jProfileName,this.form.countdown8,100);"
onKeyUp="limitText(this.form.jProfileName,this.form.countdown8,100);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown7" size="1" value="100" disabled="disabled"> characters left.</font>
    </div>

     Company Name :
    <div class="input-control text">
        <input type="text" name="jCompanyName" id="jCompanyName" maxlength="200" onKeyDown="limitText(this.form.jCompanyName,this.form.countdown7,200);"
onKeyUp="limitText(this.form.jCompanyName,this.form.countdown7,200);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown7" size="1" value="200" disabled="disabled"> characters left.</font>
    </div>

    Telephone Number :
    <div class="input-control text">
        <input type="text" name="jobPhoneNo" id="jobPhoneNo" maxlength="11" onKeyDown="limitText(this.form.jobPhoneNo,this.form.countdown5,11);return isNumberKey(event);" 
onKeyUp="limitText(this.form.jobPhoneNo,this.form.countdown5,11);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown5" size="1" value="11" disabled="disabled"> characters left.</font>
    </div>
   

   Email :
    <div class="input-control text">
        <input type="text" name="jobEmail" id="jobEmail" maxlength="200" onKeyDown="limitText(this.form.jobEmail,this.form.countdown6,200);" 
onKeyUp="limitText(this.form.jobEmail,this.form.countdown6,200);" required/>
        <button class="btn-clear"></button>
        <font size="1" style="float:right"> <input readonly type="text" name="countdown6" size="1" value="200" disabled="disabled"> characters left.</font>
    </div>

  
Company Address:
    <div class="input-control textarea">
        <textarea name="companyAddress" id="companyAddress" onKeyDown="limitText(this.form.companyAddress,this.form.countdown4,500);" 
onKeyUp="limitText(this.form.companyAddress,this.form.countdown4,500);" required></textarea>
<font size="1" style="float:right"> <input readonly type="text" name="countdown4" size="1" value="500" disabled="disabled"> characters left.</font>
    </div>
    
   <p> Add Company Logo : 
   <input type="file" name="companyLogo" id="companyLogo" required /></p>


<div align="right"><input type="reset"  value="Reset"/> <input type="submit" name="opchk" id="opchk" value="Add Profile"></div>
</form>
</div>
</body>
</html>
