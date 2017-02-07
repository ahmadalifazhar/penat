<?php
/**
 * Created by faridyusof727@gmail.com.
 * Date: 6/21/13
 * Time: 4:04 AM
 */
include "../dbcon.php";

$dbss = new dbcon("localhost", "marhazk_pinnew", "Missida890", "marhazk_pinnew");

if ($_GET['userdt'] == "mobile")
{

    $dbss->setStatus(0);
    $q = "SELECT aid FROM accounts where auname = '".$_REQUEST['username'] ."' AND apwd = '". $_REQUEST['password'] ."'";
    $r = $dbss->query($q);

    while ($data = $dbss->fetch_array_assoc($r))
    {
        echo json_encode(array($data['aid']));
    }


    $db->close();

}

