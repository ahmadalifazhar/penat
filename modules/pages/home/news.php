<?php
	$newsDB	= array();
	$newslist	= array();
	$newsDB	= "http://my.news.yahoo.com/malaysia/";

	$_newslist = array();
	$url = file_get_contents($newsDB);
	$tstart = '<ul class="tpl-thumb_100x75_title yom-list yom-list-large">';
	$tend = '<div class="ft">';
	$tstart2 = '';
	$tend2 = 'Show More';
	$pstart = strpos($url, $tstart);
	$pend = strpos($url, $tend);
	$main = str_replace("Â»", "", str_replace("&nbsp;", "<BR>",strip_tags(substr($url,$pstart,$pend-$pstart))));
	$pstart2 = 0; //strpos($newslist["DETAILS"], $tstart2);
	$pend2 = strpos($main, $tend2);
	
	$subject = strip_tags(substr($main,$pstart2,$pend2-$pstart2), "<BR>");
	$lines = explode("<BR>", $subject);
	foreach ($lines as $val)
	{
		$titlepos = strpos($val," - ");
		$newslist["NAME"] = substr($val, 0, $titlepos);
		$endpos = strlen($val)-strlen($newslist["NAME"])-8;
		$newslist["DATE"] = date('Y-m-d G:i:s', time());
		if (strpos(substr($val, $titlepos+3,30), "2013") !== false)
			$newslist["DETAILS"] = preg_replace('/2013/', '2013.<BR>', substr($val, $titlepos+3, $endpos), 1);
		else
			$newslist["DETAILS"] = preg_replace('/ago/', 'ago.<BR>', substr($val, $titlepos+3, $endpos), 1);
		$web->loadpage("modules/pages/home","member.news.list.html", $newslist);
	}

?>