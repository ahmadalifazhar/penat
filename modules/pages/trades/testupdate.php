<?php

include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";

$nama = $_POST['nama'];
$nombor = $_POST['nombor'];

mysql_query("UPDATE test SET nombor = '".$nombor."' WHERE nama = '".$nama."'") or die(mysql_error());

echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=test.php">';

?>