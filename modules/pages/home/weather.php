<?php
$weatherDB	= array();
$weatherlist	= array();
$weatherDB["w1"]	= "http://www.rssweather.com/wx/my/kuching/wx.php";
$weatherDB["w2"]	= "http://www.rssweather.com/wx/my/bayan+lepas/wx.php";
$weatherDB["w3"]	= "http://www.rssweather.com/wx/my/bintulu/wx.php";
$weatherDB["w4"]	= "http://www.rssweather.com/wx/my/kota+bharu/wx.php";
$weatherDB["w5"]	= "http://www.rssweather.com/wx/my/kota+kinabalu/wx.php";
$weatherDB["w6"]	= "http://www.rssweather.com/wx/my/kuala+lumpur/wx.php";
$weatherDB["w7"]	= "http://www.rssweather.com/wx/my/kuantan/wx.php";
$weatherDB["w8"]	= "http://www.rssweather.com/wx/my/kuching/wx.php";
$weatherDB["w9"]	= "http://www.rssweather.com/wx/my/kudat/wx.php";
$weatherDB["w10"]	= "http://www.rssweather.com/wx/my/labuan/wx.php";
$weatherDB["w11"]	= "http://www.rssweather.com/wx/my/langkawi/wx.php";
$weatherDB["w12"]	= "http://www.rssweather.com/wx/my/malacca/wx.php";
$weatherDB["w13"]	= "http://www.rssweather.com/wx/my/miri/wx.php";
$weatherDB["w14"]	= "http://www.rssweather.com/wx/my/penang/wx.php";
$weatherDB["w15"]	= "http://www.rssweather.com/wx/my/sandakan/wx.php";
$weatherDB["w16"]	= "http://www.rssweather.com/wx/my/senai/wx.php";
$weatherDB["w17"]	= "http://www.rssweather.com/wx/my/sibu/wx.php";
$weatherDB["w18"]	= "http://www.rssweather.com/wx/my/sitiawan/wx.php";
$weatherDB["w19"]	= "http://www.rssweather.com/wx/my/subang/wx.php";
$weatherDB["w20"]	= "http://www.rssweather.com/wx/my/tawau/wx.php";
$weatherDB["w21"]	= "http://www.rssweather.com/wx/my/johore+bharu/wx.php";
if (!empty($weatherDB["w".$_REQUEST[wid]]))
{
	$wval = $weatherDB["w".$_REQUEST[wid]];
	$_weatherlist = array();
	$url = file_get_contents($wval);
	$tstart = '<h1 class="lhs">';
	$tend = '<div id=\'div-gpt-ad';
	$tstart2 = '<h4>Now</h4>';
	$tend2 = '<div id="rssSubscribe">';
	
	$pstart = strpos($url, $tstart);
	$pend = strpos($url, $tend);
	$pstart2 = strpos($url, $tstart2);
	$pend2 = strpos($url, $tend2);

	//<div id="current" class="mcloudyn"> <h4>Now</h4>
	$tstart3 = '<div id="current" class="';
	$tend3 = '"> <h4>Now</h4>';
	$pstart3 = strpos($url, $tstart3)+strlen($tstart3);
	$pend3 = strpos($url, $tend3);
	$weatherlist["PICN"] = substr($url,$pstart3,$pend3-$pstart3);

	$weatherrow = mysql_fetch_array(mysql_query("SELECT * FROM weathers WHERE wname='".$weatherlist["PICN"]."'"));
	//$weatherlist["PIC"] = $weatherlist["PICN"];
	$weatherlist["PIC"] = $weatherrow[wfile];
	$weatherlist["DATE"] = date('Y-m-d G:i:s', time());
	$weatherlist["NAME"] = strip_tags(substr($url,$pstart,$pend-$pstart));
	$weatherlist["DETAILS"] = strip_tags(str_replace("<dt>", "<BR/>", substr($url,$pstart2,$pend2-$pstart2)), "<BR>");
	//$weatherlist["DETAILS"] = strip_tags(substr($url,$pstart2,$pend2-$pstart2));
	$web->loadpage("modules/pages/home","member.weathers.list.html", $weatherlist);
}

?>