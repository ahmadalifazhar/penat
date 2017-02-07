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

//for job table
$uid = $account[aid];
$JobTitle = $_POST['jobTitle'];
$JobDesc = $_POST['jobDescription'];
$JobResponsibilty = $_POST['jobResponsibilities'];
$JobRequirements = $_POST['jobRequirements'];
$JobSalaryOption = $_POST['salary_type'];
$JobCategory = $_POST['jobCategory'];
$JobCountry = $_POST['jobCountry'];
$JobState = $_POST['jobState'];
$JobDeadline = $_POST['jobDeadline'];
$JobAddress = $_POST['jobAddress'];
$JobLat = $_POST['jobLat'];
$JobLon = $_POST['jobLon'];
$PostCat = 1100;
$JobCompanyAddress = $_POST['companyAddress'];
$JobCompanyName = $_POST['jCompanyName'];
$JobCompanyTel = $_POST['jobPhoneNo'];
$JobCompanyEmail = $_POST['jobEmail'];
$JobCompanylogo = $_POST['jCompanyLogo'];

//for jobposts table
$query1= mysql_query("INSERT INTO jobpost(uid,jtitle,jdescription,jresponsibility,jrequirement,jsalaryoption,jcategory,jcountry,jstate,jdeadline,jaddress,jlat,jlon,pcat,jCompanyAddress,jCompanyName,jCompanyTel,jCompanyEmail,jCompanyLogo)
values('$uid','$JobTitle','$JobDesc','$JobResponsibilty','$JobRequirements','$JobSalaryOption','$JobCategory','$JobCountry','$JobState','$JobDeadline','$JobAddress','$JobLat','$JobLon','$PostCat','$JobCompanyAddress','$JobCompanyName','$JobCompanyTel','$JobCompanyEmail','$JobCompanylogo')") or die('<script>alert("'.mysql_error().'");window.history.back();</script>)');  

//for post table

$postTextTemp = "Job Title : $JobTitle  

Job Description : 
$JobDesc  

Company Name : $JobCompanyName
Location : $JobState , $JobCountry
Send your resume to : $JobCompanyEmail  
Closing Date: $JobDeadline";

$postText = $postTextTemp;

		if (strlen($_POST[jobTitle]) >= 1)
		{
			$temptext = "";
			$temptext = $postText;
			$temptext = str_replace(chr(10), "", $temptext);
			$temptext = str_replace(chr(13), "", $temptext);
			$temptext = str_replace("\r", "", $temptext);
			//$temptext = str_replace("\n", "", $temptext);
			$detail[pid]		= "1500".time();
			$detail[ptext]		= $postText;
			$detail[lat]		= $JobLat;
			$detail[lon]		= $JobLon;
			$detail[locname]	= $JobAddress;
			$detail[pcat]		= 1100;
			$detail[pdate]		= date('Y-m-d G:i:s', time());
			$detail[pdate2]		= time();
			$detail[ptype]		= 0;
			$detail[proot]		= $chkid;
			$detail[aid]		= $chkid;
			if (mysql_query(gendata("posts", $detail, "INSERT")))
			{
				$temptext = $detail[ptext];
				foreach ($accDB as $value)
				{
					if (strpos($temptext,"@".$value[auname]) !== false)
					{
						//NOTIFICATION
						$temptext = str_replace("@".$value[auname], "", $temptext);
						$ntid					= $detail[pid]; //Post ID
						$naid					= $value[aid]; //Post's Owner ID
						if ($naid != $chkid)
						{
							$notification[aid]		= $naid;
							$notification[nmsg]		= ":AID:$chkid has tagged your name in his/her NOTIFICATION:$chkid:1:$ntid:post";
							$notification[ndate]	= date('Y-m-d G:i:s', time());
							$notification[ndate2]	= time();
							mysql_query(gendata("notifications", $notification, "INSERT"));
							send_notification($value[aid], $chkid, "Tagged", "?op=profile&profile=".$chkid."&ppid=".$detail[pid]);
						}
					}
				}
				$web->msg("Message has been posted");
			}
			else
				$web->msg("Message failed");
		}
		else
			$web->msg("Message failed. No text found.");



if(!$query1){
echo "<script>alert('Sorry, there is a problem in adding your job advertisement,Please Try Again');</script>";
echo '<script>window.history.back();</script>';
			}
else{
echo "<script>alert('Your Job Advertisement Successfully Added!');</script>";
echo '<script>window.location.href = "?op=job&load=latestJob"</script>';
}

?>