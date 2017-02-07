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
$companyLogo = $_POST['companyLogo'];
$pid = $_POST['pid'];



		/*$phpURL = $designpath."/complogo/";

		$phpGambar = $_FILES['companyLogo']['name'];
		$phpSize = $_FILES['companyLogo']['size'];
		$location_temp = $_FILES["companyLogo"]["tmp_name"];
		
		$basename = basename($_FILES['companyLogo']['name']);
		$fileName = str_replace($basename,$profileName,$basename);
		$location_save = $phpURL.$fileName.".jpg";*/


//for jobCompanyProfile table
$query1= mysql_query("UPDATE jobCompanyProfile SET profileName='$profileName',companyName='$companyName',companyAddress='$companyAddress',companyTel='$companyTel',companyEmail='$companyEmail',companyLogo='$companyLogo' WHERE profileid = '$pid'") or die('<script>alert("'.mysql_error().'");window.history.back();</script>)');  




if(!$query1){
echo "<script>alert('Sorry, there is a problem in updating your company profile,Please Try Again');</script>";
echo '<script>window.history.back();</script>';
			}
else{
//move_uploaded_file($_FILES['companyLogo']['tmp_name'],$phpURL.$fileName.".jpg");
echo "<script>alert('Your Company Profile Successfully Updated! Please Refresh Setting Page');</script>";
echo '<script>window.close();</script>';
}

?>