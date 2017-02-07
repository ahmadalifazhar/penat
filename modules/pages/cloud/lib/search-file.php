<?php
$db = new dbcon("localhost", "root", "", "blur");
$db->setStatus(0);

$isnotuser = true;
if (isset($_REQUEST[userid]))
{
    $cloud = new getUser();
    $check = $cloud->qUser($_REQUEST[userid]);
    
    if (!$check)
    {
        include $module_root . "lib/error.php";
        die();
    }
    
    if ($_REQUEST[userid] == $userunq)
    {
        $isnotuser = false;
        
    }
    else
    {
        $isnotuser = true;
    }
    //query for user n non-user
    
   
    
}
else
{
    $isnotuser = false;
    //query for user
   
}

$userforcloud;
if (!$isnotuser)
{
    $userforcloud = $userunq;
}
else
{
    $userforcloud = $_REQUEST[userid];
}
$term = strip_tags(substr($_POST['searchit'],0, 100));
$term = mysql_escape_string($term); // Attack Prevention

if($term=="")
echo "Enter Something to Search";
else{
	//$q    = "SELECT c.* FROM cloud c WHERE c.owner = '" . $userforcloud . "' and c.location like '".$term."%' LIMIT 0, 10 ";
	$q    = "SELECT c.location, c.type, a.auname FROM cloud c, accounts a, folder f WHERE c.location like '".$term."%' and c.owner = a.aid and (f.folder_id = c.folder_id and f.privacy = 0) LIMIT 0, 10 ";
	$string = '';
	
	$data = $db->fetch_all_array($q, true);
	if (!empty($data))
    {
	 foreach ($data as $value)
        {
			$filename       = explode("_", $value[location]);
            $filename_temp  = array_pop($filename);
            $filename_temp2 = array_pop($filename);
            $a_size         = count($filename);
            //$link_file = 'modules/pages/cloud/files/'.$userforcloud.'/'.$value[location];
            if ($a_size > 1)
            {
                $filename = implode("_", $filename);
               	$string .= "<b><a href=\"?op=cloud&go=item&item_id=".$value[location]."\">".$filename."</a></b> -    ".$value[type]."    -    <i>by ".$value[auname]."</i>";
				$string .= "<br/>\n";
            }
            else
            {
               	$string .= "<b><a href=\"?op=cloud&go=item&item_id=".$value[location]."\">".$filename[0]."</a></b> -    ".$value[type]."    -    <i>by ".$value[auname]."</i>";
				$string .= "<br/>\n";
            }
			
			
			
			
			
		
		}
	}
	else
	{
		$string = "No matches found!";
	}
	echo $string;
}
			







?>
