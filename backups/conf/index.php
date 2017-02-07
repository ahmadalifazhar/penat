<?php
	if ((strlen($_POST["upass"]) >= 1) && ($_POST["upass"] === $_POST["upass2"]))
	{
		$DB["fname"]	= $_POST[fname];
		$DB["lname"]	= $_POST[lname];
		$DB["uname"]	= $_POST[uname];
		$DB["umail"]	= $_POST[umail];
		$DB["upass"]	= $_POST[upass];
		$data = gentemp($DB);
		// 0 = RID
		// 1 = Auth ID
		// 2 = Values in BASE64
		$INPOST["auth"]	= $data[1][1];	//Auth ID
		sqlsrv_query($Link, $data[0], $data[1]);
		//$web->errmsg($data[1]]);
		$web->setarray($INPOST);
		$web->loadpage($op, "register_2.html");
	}
	else if (strlen($_POST[auth]) >= 20)
	{
		//Fetching the 1st stage of registration of the current registrar
		$result = sqlsrv_query($Link, "SELECT * FROM dbo.temp WHERE rauth=? LIMIT 0,1", array($_POST[auth]));
		$row = sqlsrv_fetch_array($result);
		//Decoding from Base64 1st stage of registration into udetail array
		$udetail = decodetmp($row["rvalue"]);
		$udetail["dob"]		= $_POST["bday"];
		$udetail["usq1"]	= $_POST["usq1"];
		$udetail["usq2"]	= $_POST["usq2"];
		$udetail["usa1"]	= $_POST["usa1"];
		$udetail["usa2"]	= $_POST["usq2"];
		$udetail["gender"]	= $_POST["Gender"];
		//
		//Generate and Insert DATA
		$data = gendata("accounts", $udetail);
		//sqlsrv_query($Link, $data[0], $data[1]);
		//Load login page instead of registeration page
		foreach ($udetail as $key => $val)
		{
			echo $key." = ".$val."<BR>";
		}
		$web->msg("Registration is successful, you may login to your account now.. ".$row["rvalue"]);
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