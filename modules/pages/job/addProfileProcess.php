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

$profileName = $_POST['jProfileName'];
$companyName = $_POST['jCompanyName'];
$companyAddress = $_POST['companyAddress'];
$companyTel = $_POST['jobPhoneNo'];
$companyEmail = $_POST['jobEmail'];
$uid = $account[aid];
//$companyLogo = $_POST['companyLogo'];


		$phpURL = $designpath."/complogo/";

		$phpGambar = $_FILES['companyLogo']['name'];
		$phpSize = $_FILES['companyLogo']['size'];
		$location_temp = $_FILES["companyLogo"]["tmp_name"];
		
		$basename = basename($_FILES['companyLogo']['name']);
		$fileName = str_replace($basename,$profileName,$basename);
		$location_save = $phpURL.$fileName.".jpg";


//for jobCompanyProfile table
$query1= mysql_query("INSERT INTO jobCompanyProfile(uid,profileName,companyName,companyAddress,companyTel,companyEmail,companyLogo)
values('$uid','$profileName','$companyName','$companyAddress','$companyTel','$companyEmail','$location_save')") or die('<script>alert("'.mysql_error().'");window.history.back();</script>)');  




if(!$query1){
echo "<script>alert('Sorry, there is a problem in adding your company profile,Please Try Again');</script>";
echo '<script>window.history.back();</script>';
			}
else{
move_uploaded_file($_FILES['companyLogo']['tmp_name'],$phpURL.$fileName.".jpg");
echo "<script>alert('Your Company Profile Successfully Added!');</script>";
echo '<script>window.close();</script>';
}

?>