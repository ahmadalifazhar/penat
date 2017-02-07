<?php
/**
 * Created by faridyusof727@gmail.com.
 * Date: 6/21/13
 * Time: 4:04 AM
 */
include "../dbcon.php";

$dbss = new dbcon("localhost", "marhazk_pinnew", "Missida890", "marhazk_pinnew");

if ($_GET['login'] == "mobile")
{

    $dbss->setStatus(0);
    $q = "SELECT aid FROM accounts where auname = '".$_REQUEST['username'] ."' AND apwd = '". $_REQUEST['password'] ."'";
    $r = $dbss->query($q);

    if ($dbss->num_rows($r) == 1)
    {
        echo json_encode(array(true));
    }
    else
    {
        echo json_encode(array(false));
    }

    $db->close();

}

