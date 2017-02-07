<?php $dir = dirname(__FILE__);
$dir = str_replace("/home/marhazk/domains/pinit.uni.me/public_html/", "", $dir);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="overflow-y:auto;">
<head>
<title>Pin.it 2013 - User Registration (2/2)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo $dir;?>/stylesheet/style.css" rel="stylesheet">
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
</head>

<body style="background-color:black;">
<div class="gridContainer clearfix" >
  <div class="contain_baru">
    <div class="baru" align="center"><a href="?op=home"><img src="<?php echo $dir;?>/images/white.png" width="250" height="100" /></a></div>
  </div>
  <div style="width: 300px; 
padding: 20px;
background: rgba(0, 0, 0, 0.6);
margin-left: auto;
margin-right:auto;
border:outset 1px #8f8f8f;

-moz-box-shadow: 5px 5px 32px #000000;
-webkit-box-shadow: 5px 5px 32px #000000;
box-shadow: 5px 5px 32px #000000;


/* rounded corners */
-webkit-border-radius: 12px;
-moz-border-radius: 7px; 
border-radius: 7px; " class="metrouicss" onload="prettyPrint()">
    <h2 style="color:whitesmoke; text-align:left; text-shadow:
    -.5px -.5px 0 #000,
    .5px -.5px 0 #000,
    -.5px .5px 0 #000,
    .5px .5px 0 #000;">User Registration 2</h2>
    <form name="form1" method="post" action="">
      <input type="hidden" name="a1" id="a1" value="<?php echo base64_encode($_POST[auname]);?>"/>
      <input type="hidden" name="a2" id="a2"  value="<?php echo base64_encode($_POST[aemail]);?>"/>
      <input type="hidden" name="a3" id="a3"  value="<?php echo base64_encode($_POST[afname]);?>"/>
      <input type="hidden" name="a4" id="a4"  value="<?php echo base64_encode($_POST[alname]);?>"/>
      <div class="input-control password">
        <input type="password" name="apwd1" id="apwd1" placeholder="Password"/>
        <button class="btn-reveal"></button>
      </div>
      <div class="input-control password">
        <input type="password" name="apwd2" id="apwd2" placeholder="Retype Password"/>
        <button class="btn-reveal"></button>
      </div>
      <div class="metrouicss" onload="prettyPrint()">
    <h6 style="color:whitesmoke; text-align:lefr; text-shadow:
    -.5px -.5px 0 #000,
    .5px -.5px 0 #000,
    -.5px .5px 0 #000,
    .5px .5px 0 #000;">Secret Questions:</h6>
  </div>
      <div class="input-control select">
        <select name="asq" id="asq">
          <?php
	$asqq = mysql_query("SELECT * FROM questions");
	while ($asqr = mysql_fetch_array($asqq))
	{
	?>
          <option value="<?php echo $asqr[asq];?>"><?php echo $asqr[asqtext];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="input-control text">
        <input type="text" name="asa" id="asa" placeholder="Secret Answer"/>
        <button class="btn-clear"></button>
      </div>
      <p style="text-align:left">
        <input type="submit" name="opchk" id="opchk" value="Register">
      </p>
    </form>
  </div>
  <p>&nbsp;</p>
  <div class="metrouicss" onload="prettyPrint()">
    <h2 style="color:whitesmoke; text-align:center; text-shadow:
    -.5px -.5px 0 #000,
    .5px -.5px 0 #000,
    -.5px .5px 0 #000,
    .5px .5px 0 #000;">New Social Network In Town</h2>
  </div>
  <div class="metrouicss" onload="prettyPrint()">
    <h4 style="color:whitesmoke; text-align:center; text-shadow:
    -.5px -.5px 0 #000,
    .5px -.5px 0 #000,
    -.5px .5px 0 #000,
    .5px .5px 0 #000;"  >Pin every interest in your daily life . Get connected today . Pin everything !</h4>
  </div>
  <div class="metrouicss" onload="prettyPrint()">
    <h6 style="color:whitesmoke; text-align:center; text-shadow:
    -.5px -.5px 0 #000,
    .5px -.5px 0 #000,
    -.5px .5px 0 #000,
    .5px .5px 0 #000;">Copyright PIN.it (Developed for PSM and Imagine Cup 2013 by Dream Team)</h6>
  </div>
</div>
</body>
</html>
