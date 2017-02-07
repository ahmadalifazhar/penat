<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<?php
//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------
?>

</head>

<body>
<?php
$test1 = mysql_query("SELECT * FROM test") or die(mysql_error());
       while($test = mysql_fetch_array($test1))
       {?>
		   <form method="post" action="deletetest.php">
           <input type="radio" name="nama" value="<?php echo $test['nama']; ?>" />
           <input type="submit" />
           </form>
           
           <form method="post" action="testupdate.php">
           <input type="hidden" name="nama" value="<?php echo $test['nama']; ?>" />
           nombor baru : <input type="text" name="nombor" />
           <input type="submit" />
           </form>
        <?php
        	echo "nama : " . $test['nama'] . "<br>";
			echo "nombor : " . $test['nombor'] . "<br>---------<br>";
	   }

?>


<form method="post" action="testprocess.php">
Nama : <input type="text" name="nama" />
Nombor : <input type="text" name="nombor" />
<input type="submit" />
</form>
</body>
</html>