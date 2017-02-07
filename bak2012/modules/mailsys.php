<?php
function send_notification($recv, $sender, $title, $url, $others = 0)
{
	//e.g:	send_notification(100001, 100002, "Comment reply", "?op=viewcomment&id=1234567");
	
	$q1 = mysql_query("SELECT * FROM accounts WHERE aid=$recv LIMIT 0,1");
	$q2 = mysql_query("SELECT * FROM accounts WHERE aid=$sender LIMIT 0,1");
	$r1 = mysql_fetch_array($q1);
	$r2 = mysql_fetch_array($q2);
	
	$uWeb_mailfrom = time()."-notification@pinit.uni.me"; //sender
	$uWeb_mailhead = "Pin-It - ".$r2[afname]." ".$r2[alname]." <".$uWeb_mailfrom.">";
	$subject = '('.$title.') '.$r2[afname].' '.$r2[alname];
	$message = 'Hello '.$r1[afname].', '.$r1[alname].''. "\r\n\r\n" .$title.' has been sent by '.$r2[afname].' '.$r2[alname].' on '.gendate(time()).'. Click the link below to view the '.strtolower($title).'. '. "\r\n" .''. "\r\n" .'Link: http://www.pinit.uni.me/'.$url."\r\n\r\n";
	//echo $oid."<br><BR>";
				
			$uWeb_mailto = $r1[aemail];
			$headers = 'From: '.$uWeb_mailhead . "\r\n" .
			//$headers = 'From: $uWeb_mailfrom' . "\r\n" .
				'To: '.$uWeb_mailto . "\r\n" .
				'Reply-To: '.$uWeb_mailto . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			ini_set ( "SMTP", "mail.haztech.com.my" );
			date_default_timezone_set('Asia/Kuching');
			mail($to, $subject, $message, $headers);
	
	if ($others >= 1)
	{
		$q3 = mysql_query("SELECT * FROM accounts, posts WHERE posts.proot=$others AND accounts.aid=posts.aid GROUP BY accounts.aid");
		while ($r3 = mysql_fetch_array($q3))
		{
			if ($r3[aid] == $r1[aid])
				continue;
			$uWeb_mailfrom = time()."-notification@pinit.uni.me"; //sender
			$uWeb_mailhead = "Pin-It - ".$r2[afname]." ".$r2[alname]." <".$uWeb_mailfrom.">";
			$subject = '('.$title.') '.$r2[afname].' '.$r2[alname];
			$message = 'Hello '.$r3[afname].', '.$r3[alname].''. "\r\n\r\n" .$title.' has been sent by '.$r2[afname].' '.$r2[alname].' on '.gendate(time()).'. Click the link below to view the '.strtolower($title).'. '. "\r\n" .''. "\r\n" .'Link: http://www.pinit.uni.me/'.$url."\r\n\r\n";
			$uWeb_mailto = $r3[aemail];
			$headers = 'From: '.$uWeb_mailhead . "\r\n" .
				'To: '.$uWeb_mailto . "\r\n" .
				'Reply-To: '.$uWeb_mailto . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			ini_set ( "SMTP", "mail.haztech.com.my" );
			date_default_timezone_set('Asia/Kuching');
			mail($to, $subject, $message, $headers);
		}

		
	}

}
?>