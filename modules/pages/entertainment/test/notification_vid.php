

<?php

include "../../../config.php";
include "../../../accDB.php";
include "../../../functions.php";
include "../../../mailsys.php";
include "../../../account/accounts.sys.php";

$title = $_GET['title'];
$detail[pid] = "1500".time(); // (1500 = Post Status, 5000 = Status Comments)
$detail[ptext] = "is watching " .$title." via Pin-It Entertainment";
$detail[lat] =  $account[alat];
$detail[lon] =  $account[alon];
$detail[locname] = ""; //Problems since IFRAME, use 0 instead of $_POST[locname]
$detail[pcat] = 1200;
$detail[pdate] = date('Y-m-d G:i:s', time()); //Date of Post
$detail[ptype] = 0; //(0 = Post Status, 1=Status comment)
$detail[proot] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid
$detail[aid] = $chkid; //Current Account ID, you also can use $account[aid] instead of $chkid 
if (mysql_query(gendata("posts", $detail, "INSERT")))
{
$web->msg("Your message has been posted");

}
else
$web->msg("Failed to posted");
?>

