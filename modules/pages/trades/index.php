<?php
	//This guide is originally written by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v1 by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v2 by Farid Yusof
	//Integrated designs by Marhazli (marhazk@yahoo.com) on 12:01am 13/may/2013

	//Please set your template below
	$designpath = "modules/pages/trades";
	$designfile = "design.html";
	
	include "modules/pages/cloud/classes/class.upload.php";

	if ($_REQUEST["go"] == "upload")
	{
		include $designpath."/uploadprocess.php";
	}
	if ($_REQUEST["go"] == "wishupload")
	{
		include $designpath."/mywishlist.php";
	}
	if ($_REQUEST["go"] == "uploadwish")
	{
		include $designpath."/uploadprocesswish.php";
	}
	if ($_REQUEST["go"] == "update")
	{
		include "updateprocess.php";
		//echo "masuk 3 ";
	}
	if ($_REQUEST["go"] == "updatewish")
	{
		include "updateprocess2.php";
		//echo "masuk 3 ";
	}
	
	
	if($_REQUEST["s"] == "success")
	{
		echo "<script> alert('Your product has been posted');</script>";
		header('Location: index.php?op=trades');
	}
	if($_REQUEST["s"] == "update")
	{
		echo "<script> alert('Your product has been updated');</script>";
		header('Location: index.php?op=trades');
	}
	
	if (($opchk == "Test Only") && ($member))
	{
		$detail[pid]		= "5000".time(); // (1500 = Post Status, 5000 = Status Comments)
		$detail[ptext]		= $_POST[samplesahaja]; //Retrieve textfield value from Design.hmtl
		$detail[lat]		= $_REQUEST[lat]; //Problems since IFRAME, use 0 instead of $_POST[lat]
		$detail[lon]		= $_REQUEST[lon]; //Problems since IFRAME, use 0 instead of $_POST[lon]
		$detail[locname]	= $_POST[locname]; //Problems since IFRAME, use 0 instead of $_POST[locname]
		//Your subsystem/module category ID, refer to http://www.pin-it.tk/new/?op=files..
		// default must be XXYY (Example 1301)
		// XX = Reference ID, only 11-17
		// YY = sub-reference, its up to you
		$detail[pcat]		= 1301;
		$detail[pdate]		= date('Y-m-d G:i:s', time()); //Date of Post
		$detail[ptype]		= 1; //(0 = Post Status, 1=Status comment)
		$detail[proot]		= $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid
		$detail[aid]		= $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid 
		if (mysql_query(gendata("posts", $detail, "INSERT")))
		{
			//NOTIFICATION
			$ntid					= $_REQUEST[unlike]; //Post ID
			$naid					= $_REQUEST[aid]; //Post's Owner ID
			if ($naid != $chkid)
			{
				$notification[aid]		= $naid;
				$notification[nmsg]		= ":AID:$chkid has dislike your NOTIFICATION:$naid:0:$ntid:post";
				$notification[ndate]	= date('Y-m-d G:i:s', time());
				$notification[ndate2]	= time();
				mysql_query(gendata("notifications", $notification, "INSERT"));
			}
			send_notification($naid, $chkid, "Post", "?op=profile&profile=".$naid."&ppid=".$ntid);
			$web->msg("Your product has been posted");
		}
		else
			$web->msg("Failed to posted");
	}
	
	//// Introduction of Loadpage and arrays
	$inputs = array();	//This variable must be declared as ARRAY()
	$inputs = $account;
	
	//Will find the word __SYSNAME__ from $designfile
	$inputs["SYSNAME"] = "Trades";
	
	//Will find the word __TEST1__ from $designfile
	$inputs["TEST1"] = "trades zzzzzz";

	//Will find the word __TEST2__ from $designfile
	$inputs["TEST2"] = "Hello again world...";
	
	//Will find the word __POST__ from $designfile
	$inputs["POST"] = "<tr>
						<td>woot</td>
						<td>akmal</td>
						<td>woot</td>
						<td>yess</td>
						<td>:)</td>
					   </tr>";
					   
	//Will find the word __SAVEDADS__ from $designfile
	$inputs["SAVEDADS"] = "<tr>
						<td>:)</td>
						<td>:)</td>
						<td>:)</td>
						<td>:)</td>
						<td>:)</td>
					   </tr>";
	
	//Will find the word __AID__
	$inputs['AID'] = $chkid;
	
	//Will find the word __LOGINSTATUS__ from $designfile
	if ($member)
		$inputs["LOGINSTATUS"] = "Hello ".$account[auname]." (User ID: ".$chkid.")";
	else
		$inputs["LOGINSTATUS"] = "Please login first";
	
	//Load the page of $designfile from $designpath, with inserting the array of $inputs to replace with...
	$web->loadpage($designpath, $designfile, $inputs);
?>