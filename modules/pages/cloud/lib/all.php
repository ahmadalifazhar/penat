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

    } else
    {
        $isnotuser = true;
    }
    //query for user n non-user

    $pagination = new pagination($_REQUEST[userid], "AND folder_id = " . $_GET[folderid] .
        "");
    $pagination->page($_GET[page]);

} else
{
    $isnotuser = false;
    //query for user

    $pagination = new pagination($userunq, "AND folder_id = " . $_GET[folderid] . "");
    $pagination->page($_GET[page]);
}

$userforcloud;
if (!$isnotuser)
{
    $userforcloud = $userunq;
} else
{
    $userforcloud = $_REQUEST[userid];
}

$q = "SELECT c.* FROM cloud c WHERE c.owner = '" . $userforcloud .
    "' AND c.folder_id = " . $_GET[folderid] . " LIMIT " . $pagination->getStart() .
    "," . $pagination->getLimit() . "";
$data = $db->fetch_all_array($q, true);

?>
<?php

if (!$isnotuser)
{
    $nofilemsg = "<tr><td colspan='4'><center>Empty folder/album</center></td></tr>";
} else
{
    $nofilemsg = "<tr><td colspan='3'><center>Empty folder/album</center></td></tr>";
}

if ($_GET[style] == 1)
{

?>

<table class="bordered">
  <thead>
    <tr>
      <th>File Name</th>
      <th class="right">Extension</th>
      <th class="right">View/Download</th>
      <?php

    if (!$isnotuser)
    {

?>
      <th class="right">Share</th>
      <?php

    }

?>
    </tr>
  </thead>
  <tbody>
    
<?php

    if (!empty($data))
    {
        //getCloudList($start, $limit)
        //$userfiles_all = $cloud->getCloudList($pagination->getStart(), $pagination->getLimit());
        foreach ($data as $value)
        {
            $share = "";

            $link_file = 'modules/pages/cloud/files/' . $userforcloud . '/' . $value[location];


            $link_file = "javascript:self.location='?op=cloud&go=item&item_id=" . $value[location] .
                "'";


            $filename = explode("_", $value[location]);
            $filename_temp = array_pop($filename);
            $filename_temp2 = array_pop($filename);
            $a_size = count($filename);
            //$link_file = 'modules/pages/cloud/files/'.$userforcloud.'/'.$value[location];
            if ($a_size > 1)
            {
                $filename = implode("_", $filename);
                if (!$isnotuser)
                {
                    $share = "<td class=\"right\"><button  style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-pink fg-color-white\" onclick=\"TINY.box.show({iframe:'?op=cloud&go=cshare&ids=" .
                        $value[cloud_id] . "',width:300,height:300,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})\"><i class=\"icon-share\"></i>Share</button></td>";
                    $dlt_chkbox = "<i class='icon-remove place-right' style='cursor:pointer' onclick=\"Alertify.dialog.confirm('Are you OK to delete " .
                        $filename . "?', function () { delete_file(" . $value[cloud_id] . "," . $_GET[folderid] .
                        "," . $_GET[style] . "); },function () {     });\"></i>&nbsp;";

                } else
                {
                    $share = "";
                    $dlt_chkbox = "";

                }

                if (strlen($filename) > 40)
                {
                    $filename = substr($filename, 0, 40) . "...";
                }

                echo "<tr><td><span class=\"fg-color-greenDark\">";
                echo $filename . "</span>" . $dlt_chkbox . "</td>" . "<td class=\"right\">" . $value[type] .
                    "</td><td class=\"right\"><button onclick=\"" . $link_file . "\" style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-greenDark fg-color-white\"><i class=\"icon-download\"></i>View/Download</button></td>" .
                    $share;
            } else
            {
                if (!$isnotuser)
                {
                    $share = "<td class=\"right\"><button  style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-pink fg-color-white\" onclick=\"TINY.box.show({iframe:'?op=cloud&go=cshare&ids=" .
                        $value[cloud_id] . "',width:300,height:300,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})\"><i class=\"icon-share\"></i>Share</button></td>";
                    $dlt_chkbox = "<i class='icon-remove place-right' style='cursor:pointer' onclick=\"Alertify.dialog.confirm('Are you OK to delete " .
                        $filename[0] . "?', function () {delete_file(" . $value[cloud_id] . "," . $_GET[folderid] .
                        "," . $_GET[style] . "); },function () {     });\"></i>&nbsp;";

                } else
                {
                    $share = "";
                    $dlt_chkbox = "";

                }

                if (strlen($filename[0]) > 40)
                {
                    $filename[0] = substr($filename[0], 0, 40) . "...";
                }

                echo "<tr><td><span class=\"fg-color-greenDark\">";
                echo $filename[0] . "</span>" . $dlt_chkbox . "</td>" . "<td class=\"right\">" .
                    $value[type] . "</td><td class=\"right\"><button onclick=\"" . $link_file . "\" style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-greenDark fg-color-white\"><i class=\"icon-download\"></i>View/Download</button></td>" .
                    $share;

            }

            //	$filename = $cloud->explode_file_dir($value[location]);
            //	$text = "";
            //	for ($i = 0; $i < (count($filename)-2); $i++)
            //		$text .= $filename[$i]."_";
            //	$text = substr($text, 0, (strlen($text)-1));
            //	echo $text." - ".$value[type]."<br/>";
        }
    } else
    {
        echo $nofilemsg;
    }

?>
    </tbody>
</table>
    <?php

} else
    if ($_GET[style] == 2)
    {
        echo '<div style="overflow: auto; padding-left: 40px; padding-top: 10px;">';
        foreach ($data as $value)
        {
            $share = "";
            if (!$isnotuser)
            {
                $share = "<td class=\"right\"><button  style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-pink fg-color-white\" onclick=\"TINY.box.show({iframe:'?op=cloud&go=cshare&ids=" .
                    $value[cloud_id] . "',width:300,height:300,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})\"><i class=\"icon-share\"></i>Share</button></td>";
                $dlt_chkbox = "<input type=\"checkbox\">&nbsp;";
                $dlt_btn = "<div><button class=\"bg-color-blue fg-color-white\">Delete</button></div>";

            } else
            {
                $share = "";
                $dlt_chkbox = "";
                $dlt_btn = "";
            }

            $link_file = 'modules/pages/cloud/files/' . $userforcloud . '/' . $value[location];
            $link_file2 = $link_file;
            if (($value[type] == "jpg") || ($value[type] == "png") || ($value[type] == "gif"))
            {
                $link_file = "javascript:TINY.box.show({image:'" . $link_file .
                    "',boxid:'frameless',opacity:20,closejs:function(){closeJS()}})";
            } else
                if ($value[type] == "mp3")
                {
                    //onclick="TINY.box.show({,width:200,height:100,opacity:20,topsplit:3})"
                    $link_file = "javascript:TINY.box.show({iframe:'?op=cloud&go=player&play=1&id=" .
                        $userforcloud . "&file=" . $value[location] .
                        "',width:300,height:24,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})";
                } else
                    if ($value[type] == "mp4")
                    {
                        //onclick="TINY.box.show({,width:200,height:100,opacity:20,topsplit:3})"
                        $link_file = "javascript:TINY.box.show({url:'?op=cloud&go=player&play=2&id=" . $userforcloud .
                            "&file=" . $value[location] .
                            "',width:750,height:450,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})";
                    } else
                    {
                        $link_file = "javascript:self.location='?op=share&file=" . $value[location] .
                            "'";
                    }

                    $filename = explode("_", $value[location]);
            $filename_temp = array_pop($filename);
            $filename_temp2 = array_pop($filename);
            $a_size = count($filename);
            //$link_file = 'modules/pages/cloud/files/'.$userforcloud.'/'.$value[location];
            list($width, $height, $type, $attr) = getimagesize($link_file2);
            if ($width > $height)
            {
                $thecss = "max-height:150px; width:auto";
            } else
            {
                $thecss = "max-width:150px; height:auto";
            }

            if ($a_size > 1)
            {
                $filename = implode("_", $filename);
                if (!$isnotuser)
                {
                    $option = 'title="
			<span style=\'cursor:pointer\' onclick=\'self.location = &quot;?op=cloud&go=item&item_id=' .
                        $value[location] . '&quot;\'><i class=\'icon-laptop\'></i> Details</span>&nbsp;&nbsp;&nbsp;&nbsp;
   			<span style=\'cursor:pointer\' onclick=\'Alertify.dialog.confirm(&quot;Are you OK to delete ' .
                        $filename . '?&quot;, function () {$.fancybox.close(); delete_file(' . $value[cloud_id] . ',' . $_GET[folderid] .
                        ',' . $_GET[style] . ');},function () {     });\'><i class=\'icon-remove\'></i> Delete</span>
			"';
                }
                echo '<div class="tile image">';
                echo '<div class="tile-content">';
                echo '<a class="fancybox" href="' . $link_file2 . '" ' . $option .
                    '><img style="' . $thecss . '" src="' . $link_file2 . '" alt=""></a>';

                // echo '<a class="fancybox" href="' . $link_file2 . '" title="<a href=\'?op=cloud&go=item&item_id='.$value[location].'\'>Click for details</a><i class=\'icon-remove\'></i>"><img style="'.$thecss.'" src="' . $link_file2 . '" alt=""></a>';
                echo '</div>';
                echo '</div>';
                echo '';
                echo '';
                echo '';
                // Alertify.dialog.confirm('Are you OK to delete ".$filename."?', function () { delete_file(" . $value[cloud_id] . "); },function () {     });

                // <a href=\'?op=cloud&go=item&item_id='.$value[location].'\'


                //echo "<tr><td>" . $dlt_chkbox . "<span class=\"fg-color-greenDark\">";
                //echo wordwrap($filename, 30, "<br/>\n", true) . "</span></td>" . "<td class=\"right\">" . $value[type] . "</td><td class=\"right\"><button onclick=\"" . $link_file . "\" style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-greenDark fg-color-white\"><i class=\"icon-download\"></i>Download/View</button></td>" . $share;
            } else
            {
                if (!$isnotuser)
                {
                    $option = 'title="
			<span style=\'cursor:pointer\' onclick=\'self.location = &quot;?op=cloud&go=item&item_id=' .
                        $value[location] . '&quot;\'><i class=\'icon-laptop\'></i> Details</span>&nbsp;&nbsp;&nbsp;&nbsp;
   			<span style=\'cursor:pointer\' onclick=\'Alertify.dialog.confirm(&quot;Are you OK to delete ' .
                        $filename[0] . '?&quot;, function () {$.fancybox.close(); delete_file(' . $value[cloud_id] . ',' . $_GET[folderid] .
                        ',' . $_GET[style] . ');},function () {     });\'><i class=\'icon-remove\'></i> Delete</span>
			"';
                }
                echo '<div class="tile image">';
                echo '<div class="tile-content">';
                echo '<a class="fancybox" href="' . $link_file2 . '" ' . $option .
                    '><img style="' . $thecss . '" src="' . $link_file2 . '" alt=""></a>';
                echo '</div>';
                echo '<div class="brand"></div>';
                echo '</div>';
                echo '';
                echo '';
                echo '';

                //echo "<tr><td>" . $dlt_chkbox . "<span class=\"fg-color-greenDark\">";
                //echo wordwrap($filename[0], 30, "<br/>\n", true) . "</span></td>" . "<td class=\"right\">" . $value[type] . "</td><td class=\"right\"><button onclick=\"" . $link_file . "\" style=\"margin-right:0px;margin-bottom:0px\" class=\"bg-color-greenDark fg-color-white\"><i class=\"icon-download\"></i>Download/View</button></td>" . $share;

            }


            //	$filename = $cloud->explode_file_dir($value[location]);
            //	$text = "";
            //	for ($i = 0; $i < (count($filename)-2); $i++)
            //		$text .= $filename[$i]."_";
            //	$text = substr($text, 0, (strlen($text)-1));
            //	echo $text." - ".$value[type]."<br/>";
        }
        if (empty($data))
        {
            echo "<div><center>No photos</center><br/></div>";
        }
        echo "</div>";
        //echo '<div style="padding-left:40px">'.$dlt_btn."</div>";

    }

?>
  

<?php

/* Setup page vars for display. */
$page = $pagination->getPage();
if ($page == 0)
    $page = 1; //if no page var is given, default to 1.
$prev = $page - 1; //previous page is page - 1
$next = $page + 1; //next page is page + 1
$lastpage = ceil($pagination->totalPage() / $pagination->getLimit()); //lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1; //last page minus 1

/*
Now we apply our rules and draw the pagination object. 
We're actually saving the code to a variable in case we want to draw it more than once.
*/

?>
<?php

if ($pagination->totalPage() > 10)
{

?>
<div class="pagination">
  <ul style="text-align:center">
    <li class="first" onclick="navigate(1,<?php

    echo $_GET[folderid];

?>,<?php

    echo $_GET[style];

?>);"><a></a></li>
    <li class="prev" onclick="navigate(<?php

    if ($page == 1)
    {
        echo "1";
    } else
    {
        echo $prev;
    }

?>,<?php

    echo $_GET[folderid];

?>,<?php

    echo $_GET[style];

?>);"><a></a></li>
    <li class="spaces"><a>...</a></li>
    <li class="active"><a><?php

    echo $page;

?></a></li>
    <li class="spaces"><a>...</a></li>
    <li class="next" onclick="navigate(<?php

    if ($page == $lastpage)
    {
        echo $lastpage;
    } else
    {
        echo $next;
    }

?>,<?php

    echo $_GET[folderid];

?>,<?php

    echo $_GET[style];

?>);"><a></a></li>
    <li class="last" onclick="navigate(<?php

    echo $lastpage;

?>,<?php

    echo $_GET[folderid];

?>,<?php

    echo $_GET[style];

?>);"><a></a></li>
  </ul>
</div>
<?php

}

?>
