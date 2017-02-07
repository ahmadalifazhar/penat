<?php
function mail2PTJ($row, $oid, $title)
{
	//$uWeb_mailto = "marhazk@yahoo.com, pian2020@hotmail.com";
	//$uWeb_mailto = "marhazk@yahoo.com";

	$month = date("F", strtotime($row["DateOfEvent"]));
	$month2 = date("m", strtotime($row["DateOfEvent"]));
	$year = date("Y", strtotime($row["DateOfEvent"]));
	$condMonth = $year.$month2;
	$dateStartEvent = $row["DateOfEvent"];
		  
	$uWeb_mailfrom = "mosque-event@ukm.my.test"; //sender 
	$uWeb_mailhead = "Sistem Masjid UKM <".$uWeb_mailfrom.">";
	$subject = 'Jemputan ke '.$title;
	$message2 = 'Salam __NAME__ (__USERID__)'. "\r\n\r\n" .'Anda dijemput untuk menghadiri ke '.$title.' pada '.$dateStartEvent.'. Sila klik link ini untuk ke program tersebut.'. "\r\n" .''. "\r\n" .'Link: http://www.e-mosque.tk/?op=activityjoin&auth=__AUTH__&aBulan='.$condMonth. "\r\n\r\n";
	//echo $oid."<br><BR>";
				
	$ptjs = mysql_query("SELECT * FROM accounts where accounts.mid=".$oid);
	$aid = $row["ActivityID"];

		
		
	while ($ptjr = mysql_fetch_array($ptjs))
	{
		$to      = $ptjr["email2"];
		if (strlen($to) >= 5)
		{
			$uid = $ptjr["aid"];
			$authCode = md5($aid.$uid.time());
			//$ptjq = mysql_query("UPDATE staff SET authCode='".$authCode."', authValid=1 WHERE StaffID='$uid'");
			$ptjq = mysql_query("INSERT INTO auth (aid, ActivityID, code) VALUES ('$uid', '$aid', '".$authCode."');");
			$message = str_replace("__NAME__", $ptjr["fname"]." ".$ptjr["lname"], $message2);
			$message = str_replace("__USERID__", $ptjr["aid"], $message);
			$message = str_replace("__AUTH__", $authCode, $message);
			
			//$to      = $uWeb_mailto;
			$uWeb_mailto = $to;
			$headers = 'From: '.$uWeb_mailhead . "\r\n" .
			//$headers = 'From: $uWeb_mailfrom' . "\r\n" .
				'Reply-To: '.$uWeb_mailto . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			ini_set ( "SMTP", "mail.haztech.com.my" );
			date_default_timezone_set('Asia/Kuching');
			mail($to, $subject, $message, $headers);
		}
	}
}
?>