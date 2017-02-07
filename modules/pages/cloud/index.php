<?php
/**
PinCloud - Author faridyusof727@gmail.com
 */
$module_root = "modules/pages/cloud/"; // change as need
$userunq     = $account["aid"];
include $module_root . "classes/dbcon.php";
include $module_root . "classes/getUser.php";
include $module_root . "classes/class.upload.php";
include $module_root . "classes/Privacy.php";
include $module_root . "config.php";


if (!empty($userunq))
{

    if ($_REQUEST["go"] == "upload")
    {
        //include $module_root."upload.php";
        include $module_root . "lib/index.php";
    }
    else if ($_REQUEST["go"] == "upload_entertainment")
    {
        //include $module_root."upload.php";
        include $module_root . "lib/index_entertainment.php";
    }
    else if ($_REQUEST["go"] == "upload_file")
    {
        include $module_root . "lib/upload_file.php";

    }
    else if ($_REQUEST["go"] == "upload_photo")
    {
        include $module_root . "lib/upload_photo.php";

    }
    else if ($_REQUEST["go"] == "upload_lib")
    {
        include $module_root . "upload.php";
    }
    else if ($_REQUEST["go"] == "delete")
    {
        include $module_root . "lib/delete.php";
    }
    else if ($_REQUEST["go"] == "create_lib")
    {
        include $module_root . "create.php";
    }
    else if ($_REQUEST["go"] == "create_folder")
    {
        include $module_root . "lib/create_folder.php";
    }
    else if ($_REQUEST["go"] == "create_album")
    {
        include $module_root . "lib/create_album.php";
    }
    else if ($_REQUEST["go"] == "cshare")
    {
        include $module_root . "lib/cshare.php";
    }
    else if ($_REQUEST["go"] == "player")
    {
        include $module_root . "lib/player.php";
    }
    else if ($_REQUEST["go"] == "all")
    {

        include $module_root . "lib/all.php";

    }
    else if ($_REQUEST["go"] == "search-file")
    {

        include $module_root . "lib/search-file.php";
        die();

    }
    else if ($_REQUEST["go"] == "item")
    {

        include $module_root . "lib/item.php";


    }
    else if ($_REQUEST["go"] == "photo")
    {

        include $module_root . "lib/photo.php";

    }
    else if ($_REQUEST["go"] == "delete_folder")
    {

        include $module_root . "lib/delete_folder.php";

    }
    else if ($_REQUEST["go"] == "delete_file")
    {

        include $module_root . "lib/delete_file.php";

    }
    else if ($_REQUEST["go"] == "delete_album")
    {

        include $module_root . "lib/delete_album.php";

    }
    else
    {
        include $module_root . "upload.php";
        include $module_root . "lib/cloud.php";


        //echo "cloud interface";
    }
}
else
{

    echo '<script type="text/javascript">';
    echo 'setTimeout("window.location=\'index.php?op=account\'",5000);';
    echo '</script>';
    echo 'User not login. Redirecting to login page in 5 seconds...';

}


//echo $account["aid"];//user aid


?>