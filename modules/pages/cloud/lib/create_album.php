
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


<title>Pin Cloud</title>
</head>

<body class="metrouicss">
  <fieldset>
        <h2>Creating an album</h2>
    <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="?op=cloud&go=create_lib" >
    <p>Pick up a name for your album</p>
      
        <input type="hidden" name="action" value="create_album" />
        <div class="input-control text">
        <input type="text" name="album_name"/>
        <button class="btn-clear"></button>
    </div>
        
   
      <center>
      <input style="margin-top:10px" type="submit" name="Submit" value="create album" /></center>
     <br/>
        
    </div>
     <div class="status" style="margin-top:10px; padding-top:10px; padding-bottom:10px; background-color:#CF9; text-align:center; display:none"></div >
     
         
    </form>
</fieldset>
<script>
(function() {
    

var status = $('.status');
   
$("#form1").ajaxForm({
	target: '.status',
	complete: function() {
		// TINY.box.show({url:target,close:false,mask:false,boxid:'frameless',autohide:5,top:30,left:4});
		status.hide().fadeIn("slow");
	}
}); 

})(); 

      

</script>      


</body>
</html>

