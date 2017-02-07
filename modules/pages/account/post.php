<?php
session_start();
if(isset($_SESSION['pinitchatname'])){
	$text = $_POST['text'];
	
	//$fp = fopen("/home/marhazk/domains/pin-it.tk/public_html/new/log.html", 'a');
	//fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$account[afname]." ".$account[alname]."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
	//fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['pinitchatname']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
	//fclose($fp);
	
	if (!$member)
		die("NO WAY MAN");
	$chat[aid]		= $chkid;
	$chat[cmsg]		= stripslashes(htmlspecialchars($text));
	$chat[cdate]	= date('Y-m-d G:i:s', time());
	$chat[cdate2]	= time();
	if (mysql_query(gendata("chats", $chat, "INSERT")))
	{
		$detail[pid]		= "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
		$detail[ptext]		= ":CHAT: ".$chat[cmsg]; //Retrieve textfield value from Design.hmtl
		$detail[lat]		= $account[alat]; //Problems since IFRAME, use 0 instead of $_POST[lat]
		$detail[lon]		= $account[alon]; //Problems since IFRAME, use 0 instead of $_POST[lon]
		$detail[locname]	= $_POST[locname]; //Problems since IFRAME, use 0 instead of $_POST[locname]
		//Your subsystem/module category ID, refer to http://www.pin-it.tk/new/?op=files..
		// default must be XXYY (Example 1301)
		// XX = Reference ID, only 11-17
		// YY = sub-reference, its up to you
		$detail[pcat]		= 500; //publichat
		$detail[pdate]		= date('Y-m-d G:i:s', time()); //Date of Post
		$detail[ptype]		= 0; //(0 = Post Status, 1=Status comment)
		$detail[proot]		= $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid
		$detail[aid]		= $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid 
		if (mysql_query(gendata("posts", $detail, "INSERT")))
		mysql_query("UPDATE accounts SET achatunread=(achatunread+1) WHERE aid!=$chkid");
	}
}
?>