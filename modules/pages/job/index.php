<?php
	//This guide is originally written by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v1 by Marhazli (marhazk@yahoo.com) on 6:49am 5/may/2013
	//Originally designed v2 by Farid Yusof
	//Integrated designs by Marhazli (marhazk@yahoo.com) on 12:01am 13/may/2013

	//Please set your template below
	$designpath = "modules/pages/job";
	$designfile = "job.php";
	include "../phpjobscheduler/firepjs.php";


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
			$web->msg("Your message has been posted");
		}
		else
			$web->msg("Failed to posted");
	}
	
	//// Introduction of Loadpage and arrays
	$inputs = array();	//This variable must be declared as ARRAY()
	$inputs = $account;
	
	//Will find the word __SYSNAME__ from $designfile
	$inputs["SYSNAME"] = "Jobs";
	
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
	//$web->loadpage($designpath, $designfile, $inputs); //farid - yg ni ko kne letak kat condition tuk request method s
	
	//test Alif
	
	$userunq     = $account["aid"];
	
	if (!empty($userunq))
{

	
	if ($_REQUEST["load"] == "postJob")
	{
		include $module_root."postJob.php";
	}
	else if($_REQUEST["load"] == "selectCompany")
	{
		include $module_root."selectCompany.php";
		
	}
	else if($_REQUEST["load"] == "postProcess")
	{
		include $module_root."postJobProcess.php";
		
	}
	else if($_REQUEST["load"] == "deleteProcess")
	{
		include $module_root."deletePostProcess.php";
		
	}
	else if($_REQUEST["load"] == "latestJob")
	{
		include $module_root."latestJobPost.php";
		
	}
	
	else if($_REQUEST["load"] == "viewAllJob")
	{
		include $module_root."searchJobResult.php";
		
	}
	else if($_REQUEST["load"] == "moveOutdated")
	{
		include $module_root."moveOutDatedJob.php";
		
	}
	else if($_REQUEST["load"] == "myJobPost")
	{
		include $module_root."myJobPost.php";
		
	}
	else if($_REQUEST["load"] == "myWatchList")
	{
		include $module_root."myWatchList.php";
		
	}
	else if($_REQUEST["load"] == "addToList")
	{
		include $module_root."addToListProcess.php";
		
	}
	else if($_REQUEST["load"] == "removeFromList")
	{
		include $module_root."removeFromListProcess.php";
		
	}
	else if($_REQUEST["load"] == "myJobPostResult")
	{
		include $module_root."myJobPostResult.php";
		
	}
	else if($_REQUEST["load"] == "viewMore")
	{
		include $module_root."viewFullPost.php";
		
	}
	else if($_REQUEST["load"] == "viewOnMap")
	{	
		include $module_root."viewOnMap.php";
		
	}
	else if($_REQUEST["load"] == "viewRoute")
	{	
		include $module_root."viewRoute.php";
		
	}
	else if($_REQUEST["load"] == "editJob")
	{
		include $module_root."editJob.php";
		
	}
	
	else if($_REQUEST["load"] == "jobSetting")
	{
		include $module_root."jobSetting.php";
		
	}
	else if($_REQUEST["load"] == "addProfile")
	{
		include $module_root."addProfile.php";
		
	}
	else if($_REQUEST["load"] == "addProfileProcess")
	{
		include $module_root."addProfileProcess.php";
		
	}
	else if($_REQUEST["load"] == "viewProfile")
	{
		include $module_root."viewProfile.php";
		
	}
	else if($_REQUEST["load"] == "updateJob")
	{
		include $module_root."updateJob.php";
		
	}
	else if($_REQUEST["load"] == "updateJobProcess")
	{
		include $module_root."updateJobProcess.php";
		
	}
	else if($_REQUEST["load"] == "test")
	{
		include $module_root."samplea.php";
		
	}
	
	else if($_REQUEST["load"] == "updateCompany")
	{
		include $module_root."updateCompany.php";
		
	}
	else if($_REQUEST["load"] == "updateCompanyProcess")
	{
		include $module_root."updateCompanyProcess.php";
		
	}
	
	else if($_REQUEST["load"] == "deleteCompanyProcess")
	{
		include $module_root."deleteCompanyProcess.php";
		
	}
	else
	{
			$web->loadpage($designpath, $designfile, $inputs); // kat sini letak - sen
	}
	
	}
else
{

    echo '<script type="text/javascript">';
    echo 'setTimeout("window.location=\'index.php?op=account\'",5000);';
    echo '</script>';
    echo '<h4>Hye, it seems that you did not login yet into PIN-IT, I am redirecting you to the login page<h4>';
	echo '<h4>If you does not have any account yet, feel free to register, it is just a simple step :), Thank You!<h4>';

}
	
?>