<?php 
$offlineDB = 'config/dbconnect.php';

if (file_exists($offlineDB)) {
    include("config/dbconnect.php");
} else {

include "../../config.php";
include "../../accDB.php";
include "../../functions.php";
include "../../mailsys.php";
include "../account/accounts.sys.php";
}

/* For post table */
echo $aid = $account[aid];
echo "<br>";
echo $desc = $_POST['Description'];
echo "<br>";
echo $country = $_POST['Country'];
echo "<br>";
echo $deadline = $_POST['Deadline'];
echo "<br>";
echo $address = $_POST['Address'];
echo "<br>";
echo $title = $_POST['Title'];
echo "<br>";
echo $name = $_POST['name'];
echo "<br>";
echo $contactno = $_POST['contactno'];
echo "<br>";
echo $email = $_POST['email'];
echo "<br>";
echo $startdate = $_POST['Startdate'];
echo "<br>";
echo $lat = $_POST['lat'];
echo "<br>";
echo $lon = $_POST['lon'];
echo "<br>";
echo $postCat = 1700;

/* shoppingpost table */
$query1= mysql_query("INSERT INTO shoppingpostoutdated(a_id, s_desc, s_country, s_deadline, s_address, s_title, s_name, s_contact, s_email, s_startdate, s_lat, s_lon, pcat) VALUES
('$aid','$desc', '$country','$deadline','$address','$title','$name','$contactno','$email','$startdate','$lat','$lon','$postCat')") 
or die('<script>alert("'.mysql_error().'");window.history.back();</script>)');  


?>