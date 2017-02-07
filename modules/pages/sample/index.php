<?php
	//This guide is originally written by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v1 by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v2 by Farid Yusof
	//Integrated designs by Marhazli (marhazk@yahoo.com) on 12:01am 13/may/2013
	//Last revised and updated by Marhazli (marhazk@yahoo.com) on 2:54am 29/may/2013

	//Please set your template below
	$designpath				= "modules/pages/sample";
	$designfile				= "Design.html";
	$account["SYSNAME"]		= "Sample";	//Will find the word __SYSNAME__ from $designfile
	$account["SYSTITLE"]	= "SampleTitle";	//Will find the word __SYSTITLE__ from $designfile
	$account["SYSLINK"]		= "sample";	//Will find the word __SYSLINK__ from $designfile

	if (($opchk == "Test Only") && ($member))
	{
		$detail[pid]		= "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
		$detail[ptext]		= $_POST[samplesahaja]; //Retrieve textfield value from Design.hmtl
		$detail[lat]		= $account[alat]; //Current account's Latitude
		$detail[lon]		= $account[alon]; //Current account's Longtitude
		$detail[locname]	= $_POST[locname]; //Problems since IFRAME, use 0 instead of $_POST[locname]
		//Your subsystem/module category ID, refer to http://www.pin-it.tk/new/?op=files..
		// default must be XXYY (Example 1301)
		// XX = Reference ID, only 11-17
		// YY = sub-reference, its up to you
		// Example are Below:
		//ref format : [sys name]/[sys ver]/[sys devel month]/[class]/[ref no].[no ver: a-z]
		//ref: pinit/01/04/00/xxx.x (Root System)
		//ref: pinit/01/04/01/xxx.x (Account System)
		//ref: pinit/01/04/02/xxx.x (Profile System)
		//ref: pinit/01/04/03/xxx.x (Geo-map System)
		//ref: pinit/01/04/04/xxx.x (Setting System)
		//ref: pinit/01/04/05/xxx.x (Chat/MSG System)
		//ref: pinit/01/04/06/xxx.x (Geo-map System)
		//ref: pinit/01/04/07/xxx.x (- System) *Reserved*
		//ref: pinit/01/04/08/xxx.x (- System) *Reserved*
		//ref: pinit/01/04/09/xxx.x (- System) *Reserved*
		//ref: pinit/01/04/10/xxx.x (- System) *Reserved*
		//ref: pinit/01/04/11/xxx.x (Jobs SubSystem)
		//ref: pinit/01/04/12/xxx.x (Entertainment SubSystem)
		//ref: pinit/01/04/13/xxx.x (Transportation SubSystem)
		//ref: pinit/01/04/14/xxx.x (Cloud SubSystem)
		//ref: pinit/01/04/15/xxx.x (Education SubSystem)
		//ref: pinit/01/04/16/xxx.x (Trades SubSystem)
		//ref: pinit/01/04/17/xxx.x (Shopping Tracker SubSystem)
		$detail[pcat]		= 1301;
		$detail[pdate]		= date('Y-m-d G:i:s', time()); //Date of Post
		$detail[ptype]		= 0; //(0 = Post Status, 1=Status comment)
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
			$web->msg("Your message has been posted");
		}
		else
			$web->msg("Failed to posted");
	}
	
	//// Introduction of Loadpage and arrays
	$inputs = array();	//This variable must be declared as ARRAY()
	$inputs = $account;
	
	//Will find the word __TEST1__ from $designfile
	$inputs["TEST1"] = "Hello world...";

	//Will find the word __TEST2__ from $designfile
	$inputs["TEST2"] = "Hello again world...";
	
	//Will find the word __LOGINSTATUS__ from $designfile
	if ($member)
		$inputs["LOGINSTATUS"] = "Hello ".$account[auname]." (User ID: ".$chkid.")";
	else
		$inputs["LOGINSTATUS"] = "Please login first";
	
	//Load the page of $designfile from $designpath, with inserting the array of $inputs to replace with...
	$web->loadpage($designpath, $designfile, $inputs);
?>