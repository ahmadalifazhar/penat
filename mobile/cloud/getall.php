<?php
/**
 * Created by faridyusof727@gmail.com.
 * Date: 6/21/13
 * Time: 4:04 AM
 */
include "../dbcon.php";

$dbss = new dbcon("localhost", "marhazk_pinnew", "Missida890", "marhazk_pinnew");

if ($_GET['userdt_allfile'] == "mobile")
{

    $dbss->setStatus(0);
    $q = "SELECT * FROM cloud where owner = '" . $_REQUEST['aid'] . "'";
    $r = $dbss->query($q);
    $location = array();
    while ($value = $dbss->fetch_array_assoc($r))
    {
        $filename = explode("_", $value['location']);
        $text     = "";
        for ($i = 0; $i < (count($filename) - 2); $i++)
            $text .= $filename[$i] . "_";
        $text = substr($text, 0, (strlen($text) - 1));

        $location[] = $text.".".$value['type'];
        $size[] = $value['size'];
        $id[] = $value['cloud_id'];
        $real_loc[] = $value['location'];

    }

    echo json_encode(array($location,$size,$id,$real_loc));


    $db->close();

}

