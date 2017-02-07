<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
xxx
<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------


$aid = $_GET['aid'];
$tid = $_GET['tid'];

mysql_query("DELETE FROM tradesmark m WHERE m.aid = $aid AND m.tid = $tid") or die(mysql_error());
echo "yyy";
//header("Location: http://www.pinit.uni.me/modules/pages/trades/saveads.php");
?>
<script type="text/javascript">
self.close();
</script>
</body>
</html>