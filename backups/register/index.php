<?php
	if ((strlen($_POST["upass"]) >= 1) && ($_POST["upass"] === $_POST["upass2"]))
	{
		$DB["aid"]		= time()."".rand(100,999);
		$DB["fname"]	= $_POST[fname];
		$DB["lname"]	= $_POST[lname];
		$DB["uname"]	= $_POST[uname];
		$DB["umail"]	= $_POST[umail];
		$DB["upass"]	= $_POST[upass];
		$DB["ureg"]		= date("Y-m-d G:i:s");
		$data = gentemp($DB);
		// 0 = RID
		// 1 = Auth ID
		// 2 = Values in BASE64
		$INPOST["auth"]	= $data[1][1];	//Auth ID
		mysql_query($data[0]);
		//$web->errmsg($data[1]]);
		$web->setarray($INPOST);
		$web->loadpage($op, "register_2.html");
	}
	else if (strlen($_POST[auth]) >= 20)
	{
		//Fetching the 1st stage of registration of the current registrar
		$result = mysql_query("SELECT * FROM temp WHERE rauth='".$_POST[auth]."'");
		//$result = mysql_query($Link, "SELECT * FROM dbo.temp");
		$row = mysql_fetch_array($result);
		//Decoding from Base64 1st stage of registration into udetail array
		$udetail = decodetmp($row[2]);
		$udetail["udob"]	= $_POST["bday"];
		$udetail["usq1"]	= $_POST["usq1"];
		$udetail["usq2"]	= $_POST["usq2"];
		$udetail["usa1"]	= $_POST["usa1"];
		$udetail["usa2"]	= $_POST["usa2"];
		$udetail["ugender"]	= $_POST["Gender"];
		//
		//Generate and Insert DATA
		$data = gendata("accounts", $udetail, "MYSQL");
		mysql_query($data[0]);
		//Load login page instead of registeration page
		foreach ($row as $key => $val)
		{
			echo $key." X= ".$val."<BR>";
		}
		foreach ($udetail as $key => $val)
		{
			echo $key." = ".$val."<BR>";
		}
		echo "---------------<BR>";
		foreach ($data as $val)
		{
			echo " = ".$val."<BR>";
		}
		echo "---------------<BR>";
		foreach ($data[1] as $val)
		{
			echo " = ".$val."<BR>";
		}
		$web->msg("<font color=green>Howdy ".$udetail["fname"].", your registration is successful.<BR>You may login to your account now..<BR><BR></font>");
		$web->loadpage("login", "index.html");
	}
	else
	{
		if (strlen($_POST["upass"]) >= 1)
		{
			$web->errmsg("Password and retype password mismatch");
		}
		$web->loadpage($op, "register_1.html");
	}
?>