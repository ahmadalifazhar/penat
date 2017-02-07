<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="metro/css/modern.css" rel="stylesheet">
<link href="metro/css/modern-responsive.css" rel="stylesheet">
<link href="metro/css/site.css" rel="stylesheet" type="text/css">
<link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="metro/js/assets/moment.js"></script>
<script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
<script type="text/javascript" src="metro/js/modern/accordion.js"></script>
<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
<script type="text/javascript" src="metro/js/modern/carousel.js"></script>
<script type="text/javascript" src="metro/js/modern/input-control.js"></script>
<script type="text/javascript" src="metro/js/modern/pagecontrol.js"></script>
<script type="text/javascript" src="metro/js/modern/rating.js"></script>
<script type="text/javascript" src="metro/js/modern/slider.js"></script>
<script type="text/javascript" src="metro/js/modern/tile-slider.js"></script>
<script type="text/javascript" src="metro/js/modern/tile-drag.js"></script>
<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
-->

<style>
.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: rgb(0, 130, 135); width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
<title>Pin Cloud</title>
</head>

<body class="metrouicss">
  <fieldset>
        <h2>Pin-Cloud Upload</h2>
    <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="?op=cloud&go=upload_lib" >
    <p>
              
      <textarea style="width:100%; height:100px; resize:none" name="status" id="textarea" placeholder="Pin anything..."></textarea>
      </p>
      <p>Pick up a file to upload, and press &quot;upload&quot;:</p>
      <p>
  <input id="file_select" type="file"  name="my_field" value="" />  
        <input type="hidden" name="action" value="simple" /><br/><br/>
        <input type="submit" name="Submit" value="upload" />
      </p>
        <div class="progress">
        <div class="bar"></div >
        <div class="percent">0%</div >
        
    </div>
     <div class="status" style="margin-top:10px; padding-top:10px; padding-bottom:10px; background-color:#CF9; text-align:center; display:none"></div >
     
         
    </form>
</fieldset>
<script>
(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('.status');
   
$("#form1").ajaxForm({
	
	
    beforeSend: function() {
        status.empty();
		
        status.hide();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
		
    },
	target: '.status',
	complete: function() {
		// TINY.box.show({url:target,close:false,mask:false,boxid:'frameless',autohide:5,top:30,left:4});
		status.hide().fadeIn("slow");
		 
		 
		
	}
}); 

})(); 

      

</script>      

</script>
</body>
</html>

