<?php

//link to database
include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
//--------------------------------------


$aid = $_REQUEST['aid'];
$tid = $_REQUEST['tid'];

echo $aid." ".$tid;

$query = "DELETE FROM tradesmark WHERE aid=$aid AND tid=$tid";

mysql_query($query);
?>
<script type="text/javascript">
self.close();
</script>