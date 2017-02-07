<?php
get_menu($account);

if ($opchk == "Upload!")
{
	include "modules/uploadsys.php";
	$pic = uploadpic($_POST);
	if ($pic[success])
	{
		$details[apic]		= $pic[filename];
		$detailswhr[aid]	= $chkid;
		if (mysql_query(gendata("accounts", $details, $detailswhr)))
			msg("NOTICE", "You have uploaded your default photo");
		else
			msg("ERROR", "Picture failed");
	}
}
?>
<P><B>Picture Profile</B></p>
<form method="POST" enctype="multipart/form-data" action="">
	Choose Your photo
	  <p><input type="file" name="gfx" size="20">
	    <BR>
<BR>
<input type="hidden" value="1" name="upload"><input type="submit" value="Upload!" name="opchk"><input type="reset" value="Reset" name="B2">
  </p>
</form>		
