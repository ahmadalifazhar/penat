<?php
/**
PinCloud - Author faridyusof727@gmail.com
*/
error_reporting(E_ALL);

// we first include the upload class, as we will need it here to deal with the uploaded file


// retrieve eventual CLI parameters



// set variables





// we have three forms on the test page, so we redirect accordingly
if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'simple') {
$file_type_ptext = "";
$ptext_status = $_POST['status'];	
$dir_dest = $module_root."files/".$userunq;
	
    // ---------- SIMPLE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
		if (($handle->file_src_mime == 'application/x-msdownload') 
		|| ($handle->file_src_mime == 'application/x-msdos-program') 
		|| ($handle->file_src_mime == 'application/x-msdos-windows') 
		|| ($handle->file_src_mime == 'application/x-download') 
		|| ($handle->file_src_mime == 'application/bat') 
		|| ($handle->file_src_mime == 'application/x-bat') 
		|| ($handle->file_src_mime == 'application/com') 
		|| ($handle->file_src_mime == 'application/x-com') 
		|| ($handle->file_src_mime == 'application/exe') 
		|| ($handle->file_src_mime == 'application/x-exe') 
		|| ($handle->file_src_mime == 'application/x-winexed') 
		|| ($handle->file_src_mime == 'application/x-winhlp') 
		|| ($handle->file_src_mime == 'application/x-winhelp') 
		|| ($handle->file_src_mime == 'application/x-javascript') 
		|| ($handle->file_src_mime == 'application/hta') 
		|| ($handle->file_src_mime == 'application/x-ms-shortcut') 
		|| ($handle->file_src_mime == 'application/octet-stream') 
		|| ($handle->file_src_mime == 'vms/exe'))
		{
			echo '<p>';
			echo '  <b>File not uploaded on the server</b><br />';
			echo '  Error: File you are uploading is dangerous!';
			echo '</p>';
				
			
		}
		else
		{
			$handle->file_name_body_add = "_".time()."_".md5($userunq).""; // file location structure
		
			if ($handle->file_is_image)
			{
				if ($handle->image_src_x > 1000)
				{
					$handle->image_resize = true;
					$handle->image_x = 1000;
					$handle->image_ratio_y = true;
				}
				
				if ($handle->image_src_y > 800)
				{
					$handle->image_resize = true;
					$handle->image_y = 800;
					$handle->image_ratio_x = true;
				}
				$file_type_ptext = ":IMG:".$userunq."/";
				$defaultdir = 3;
			}
			else
			{
				$file_type_ptext = ":DOC:";
				$defaultdir = 1;
			}
			
			$handle->Process($dir_dest);
	
			// we check if everything went OK
			if ($handle->processed) {
				// everything was fine !
				echo '<p class="result">';
				echo '  <b>File uploaded with success.</b><br />';
				echo '  File: ' . $handle->file_dst_name;
				echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
				echo '</p>';
				
				//database parture
				$col[location]	= $handle->file_dst_name;
				$col[type]		= $handle->file_dst_name_ext;
				$col[size]		= round(filesize($handle->file_dst_pathname)/256)/4;
				$col[date]		= date('Y-m-d G:i:s', time());
				$col[owner]		= $userunq;
				$col[folder_id]		= $defaultdir; //change 
				
				if (mysql_query(gendata("cloud", $col, "INSERT")))
				{
					$web->msg("File recorded into database.");
				}
				else
					$web->msg("Database error.");
				
				
					
					$detail[pid]		= "1500".time();
					$detail[ptext]		= "zeny is now uploading a video file via pin-it entertainment"
					$detail[lat]		= $account[alat]; //iframe bugs
					$detail[lon]		= $account[alon]; //iframe bugs
					$detail[locname]	= $_POST[locname]; //iframe bugs
					$detail[pcat]		= 1200;
					$detail[pdate]		= date('Y-m-d G:i:s', time());
					$detail[ptype]		= 0;
					$detail[proot]		= $chkid;
					$detail[aid]		= $chkid;
					if (mysql_query(gendata("posts", $detail, "INSERT")))
					{
						foreach ($accDB as $value)
						{
							if (strpos($detail[ptext],"@".$value[auname]) !== false)
							{
								send_notification($value[aid], $chkid, "Tagged", "?op=view/comment&aid=".$chkid."&pid=".$detail[pid]);
							}
						}
						$web->msg("Message has been posted");
					}
					else
						$web->msg("Message failed");
				
			} else {
				// one error occured
				echo '<p class="result">';
				echo '  <b>File not uploaded to the wanted location</b><br />';
				echo '  Error: ' . $handle->error . '';
				echo '</p>';
			}
	
			// we delete the temporary files
			$handle-> Clean();
			//if (!isset($ptext_status))header('Location: '.$redirect);
			
			
		}

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
       echo '<p class="result">';
        echo '  <b>File not uploaded on the server</b><br />';
       echo '  Error: ' . $handle->error . '';
        echo '</p>';
    }


}
else if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'upload_file') {
$file_type_ptext = "";
if ($_POST['pin_status'] == 1)
{
	$ptext_status = $_POST['pin_status_text'];
	if ($_POST['pin_location'] == 1)
	{
		$alat = $account[alat];
		$alon = $account[alon];
	}
	else
	{
		$alat = "";
		$alon = "";
	}
}
else
{
	if(isset($ptext_status))
	{
		unset($ptext_status);
	}
}
$upload_folder = $_POST['folder_select'];
	
$dir_dest = $module_root."files/".$userunq;
	
    // ---------- SIMPLE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
		if (($handle->file_src_mime == 'application/x-msdownload') 
		|| ($handle->file_src_mime == 'application/x-msdos-program') 
		|| ($handle->file_src_mime == 'application/x-msdos-windows') 
		|| ($handle->file_src_mime == 'application/x-download') 
		|| ($handle->file_src_mime == 'application/bat') 
		|| ($handle->file_src_mime == 'application/x-bat') 
		|| ($handle->file_src_mime == 'application/com') 
		|| ($handle->file_src_mime == 'application/x-com') 
		|| ($handle->file_src_mime == 'application/exe') 
		|| ($handle->file_src_mime == 'application/x-exe') 
		|| ($handle->file_src_mime == 'application/x-winexed') 
		|| ($handle->file_src_mime == 'application/x-winhlp') 
		|| ($handle->file_src_mime == 'application/x-winhelp') 
		|| ($handle->file_src_mime == 'application/x-javascript') 
		|| ($handle->file_src_mime == 'application/hta') 
		|| ($handle->file_src_mime == 'application/x-ms-shortcut') 
		|| ($handle->file_src_mime == 'application/octet-stream') 
		|| ($handle->file_src_mime == 'vms/exe'))
		{
			echo '<p>';
			echo '  <b>File not uploaded on the server</b><br />';
			echo '  Error: File you are uploading is dangerous!';
			echo '</p>';
				
			
		}
		else
		{
			$handle->file_name_body_add = "_".time()."_".md5($userunq).""; // file location structure
		
			if ($handle->file_is_image)
			{
				echo '<p>';
				echo '  <b>File not uploaded on the server</b><br />';
				echo '  Error: File you are uploading cannot be entertained by these type of folder!<br />Please use photo upload instead!';
				echo '</p>';
				$handle-> Clean();
				die();
			}
			
			$file_type_ptext = ":DOC:";
			$handle->Process($dir_dest);
	
			// we check if everything went OK
			if ($handle->processed) {
				// everything was fine !
				echo '<p class="result">';
				echo '  <b>File uploaded with success.</b><br />';
				echo '  File: ' . $handle->file_dst_name;
				echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
				echo '</p>';
				
				//cloud database
				$col[location]	= $handle->file_dst_name;
				$col[type]		= $handle->file_dst_name_ext;
				$col[size]		= round(filesize($handle->file_dst_pathname)/256)/4;
				$col[date]		= date('Y-m-d G:i:s', time());
				$col[owner]		= $userunq;
				$col[folder_id]		= $upload_folder; //change 
				
				if (mysql_query(gendata("cloud", $col, "INSERT")))
				{
					$web->msg("File recorded into database.");
				}
				else
					$web->msg("Database error.");
				
				//post database
				
					
					$detail[pid]		= "1500".time();
					$detail[ptext]		= "zeny is now uploading a video file via pin-it entertainment"
					$detail[lat]		= $alat; //iframe bugs
					$detail[lon]		= $alon; //iframe bugs
					$detail[locname]	= $_POST[locname]; //iframe bugs
					$detail[pcat]		= 1200;
					$detail[pdate]		= date('Y-m-d G:i:s', time());
					$detail[ptype]		= 0;
					$detail[proot]		= $chkid;
					$detail[aid]		= $chkid;
					if (mysql_query(gendata("posts", $detail, "INSERT")))
					{
						foreach ($accDB as $value)
						{
							if (strpos($detail[ptext],"@".$value[auname]) !== false)
							{
								send_notification($value[aid], $chkid, "Tagged", "?op=view/comment&aid=".$chkid."&pid=".$detail[pid]);
							}
						}
						$web->msg("Message has been posted");
					}
					else
						$web->msg("Message failed");
				
			} else {
				// one error occured
				echo '<p class="result">';
				echo '  <b>File not uploaded to the wanted location</b><br />';
				echo '  Error: ' . $handle->error . '';
				echo '</p>';
			}
	
			// we delete the temporary files
			$handle-> Clean();
			//if (!isset($ptext_status))header('Location: '.$redirect);
			
			
		}

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
       echo '<p class="result">';
       echo '  <b>File not uploaded on the server</b><br />';
       echo '  Error: ' . $handle->error . '';
       echo '</p>';
    }


}
else if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'upload_photo') {
$file_type_ptext = "";
if ($_POST['pin_status'] == 1)
{
	$ptext_status = $_POST['pin_status_text'];
	if ($_POST['pin_location'] == 1)
	{
		$alat = $account[alat];
		$alon = $account[alon];
	}
	else
	{
		$alat = "";
		$alon = "";
	}
}
else
{
	if(isset($ptext_status))
	{
		unset($ptext_status);
	}
}
$upload_folder = $_POST['folder_select'];
	
$dir_dest = $module_root."files/".$userunq;
	
    // ---------- SIMPLE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
		if (($handle->file_src_mime == 'application/x-msdownload') 
		|| ($handle->file_src_mime == 'application/x-msdos-program') 
		|| ($handle->file_src_mime == 'application/x-msdos-windows') 
		|| ($handle->file_src_mime == 'application/x-download') 
		|| ($handle->file_src_mime == 'application/bat') 
		|| ($handle->file_src_mime == 'application/x-bat') 
		|| ($handle->file_src_mime == 'application/com') 
		|| ($handle->file_src_mime == 'application/x-com') 
		|| ($handle->file_src_mime == 'application/exe') 
		|| ($handle->file_src_mime == 'application/x-exe') 
		|| ($handle->file_src_mime == 'application/x-winexed') 
		|| ($handle->file_src_mime == 'application/x-winhlp') 
		|| ($handle->file_src_mime == 'application/x-winhelp') 
		|| ($handle->file_src_mime == 'application/x-javascript') 
		|| ($handle->file_src_mime == 'application/hta') 
		|| ($handle->file_src_mime == 'application/x-ms-shortcut') 
		|| ($handle->file_src_mime == 'application/octet-stream') 
		|| ($handle->file_src_mime == 'vms/exe'))
		{
			echo '<p>';
			echo '  <b>File not uploaded on the server</b><br />';
			echo '  Error: File you are uploading is dangerous!';
			echo '</p>';
				
			
		}
		else
		{
			$handle->file_name_body_add = "_".time()."_".md5($userunq).""; // file location structure
		
			if ($handle->file_is_image)
			{
				if ($handle->image_src_x > 1000)
				{
					$handle->image_resize = true;
					$handle->image_x = 1000;
					$handle->image_ratio_y = true;
				}
				
				if ($handle->image_src_y > 800)
				{
					$handle->image_resize = true;
					$handle->image_y = 800;
					$handle->image_ratio_x = true;
				}
				$file_type_ptext = ":IMG:".$userunq."/";
				
				$handle->Process($dir_dest);
	
			// we check if everything went OK
				if ($handle->processed) {
					// everything was fine !
					echo '<p class="result">';
					echo '  <b>File uploaded with success.</b><br />';
					echo '  File: ' . $handle->file_dst_name;
					echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
					echo '</p>';
					
					//cloud database
					$col[location]	= $handle->file_dst_name;
					$col[type]		= $handle->file_dst_name_ext;
					$col[size]		= round(filesize($handle->file_dst_pathname)/256)/4;
					$col[date]		= date('Y-m-d G:i:s', time());
					$col[owner]		= $userunq;
					$col[folder_id]		= $upload_folder; //change 
					
					if (mysql_query(gendata("cloud", $col, "INSERT")))
					{
						$web->msg("File recorded into database.");
					}
					else
						$web->msg("Database error.");
					
					//post database
					if (isset($ptext_status))
					{
						
						$detail[pid]		= "1500".time();
						$detail[ptext]		= $file_type_ptext.$handle->file_dst_name." \n".$ptext_status;
						$detail[lat]		= $alat; //iframe bugs
						$detail[lon]		= $alon; //iframe bugs
						$detail[locname]	= $_POST[locname]; //iframe bugs
						$detail[pcat]		= 1200;
						$detail[pdate]		= date('Y-m-d G:i:s', time());
						$detail[ptype]		= 0;
						$detail[proot]		= $chkid;
						$detail[aid]		= $chkid;
						if (mysql_query(gendata("posts", $detail, "INSERT")))
						{
							foreach ($accDB as $value)
							{
								if (strpos($detail[ptext],"@".$value[auname]) !== false)
								{
									send_notification($value[aid], $chkid, "Tagged", "?op=view/comment&aid=".$chkid."&pid=".$detail[pid]);
								}
							}
							$web->msg("Message has been posted");
						}
						else
							$web->msg("Message failed");
					}
				} else {
					// one error occured
					echo '<p class="result">';
					echo '  <b>File not uploaded to the wanted location</b><br />';
					echo '  Error: ' . $handle->error . '';
					echo '</p>';
				}
		
				// we delete the temporary files
				$handle-> Clean();
				//if (!isset($ptext_status))header('Location: '.$redirect);
				
					
					
					
					
				
			}
			else
			{
				echo '<p>';
				echo '  <b>File not uploaded on the server</b><br />';
				echo '  Error: File you are uploading cannot be entertained by these type of folder!<br />Please use file upload instead!';
				echo '</p>';
				$handle-> Clean();
				die();
			}
			
			
			
		}

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
       echo '<p class="result">';
       echo '  <b>File not uploaded on the server</b><br />';
       echo '  Error: ' . $handle->error . '';
       echo '</p>';
    }


}
?>
