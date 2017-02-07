<?php
$db = new dbcon("localhost", "root", "", "blur");
if (!isset($_REQUEST[go]))
{
    die();
}
else
{
    if (isset($_REQUEST[item_id]))
    {
        if (!empty($userunq))
        {
            $itemid = $_REQUEST[item_id];
            $isuser = false;

            $db->setStatus(1);


            if (!empty($itemid))
            {

                $q_file   = "SELECT c.*, a.auname, f.name, f.privacy FROM cloud c, accounts a, folder f WHERE c.location = '" . $itemid . "' and c.owner = a.aid and f.folder_id = c.folder_id";
                $the_file = $db->fetch_all_array($q_file, true);


                if (!empty($the_file))
                {

                    $views         = null;
                    $filename      = null;
                    $location      = null;
                    $type          = null;
                    $size          = null;
                    $date_uploaded = null;
                    $owner         = null;

                    foreach ($the_file as $value)
                    {
                        if (($value['privacy'] == 1) && ($value['owner'] != $userunq))
                        {
                            die("This file is private. Access to file prohibited.");
                        }
                        $filename       = explode("_", $value[location]);
                        $filename_temp  = array_pop($filename);
                        $filename_temp2 = array_pop($filename);
                        $a_size         = count($filename);

                        if ($a_size > 1)
                        {
                            $filename = implode("_", $filename);

                        }
                        else
                        {
                            $filename = $filename[0];
                        }
                        $location      = $module_root . "files/" . $value[owner] . "/" . $value[location] . "";
                        $type          = $value[type];
                        $size          = $value[size]; //in  Kb
                        $date_uploaded = $value[date];
                        $owner         = $value[auname];
                        $folder_name   = $value['name'];
                        $views         = $value[views] + 1;
                        $id            = $value[cloud_id];
                        if ($value[owner] == $userunq)
                        {
                            $isuser = true;
                        }
                        else
                        {
                            $isuser = false;
                        }

                    }

                    if (($value[type] == "jpg")
                        || ($value[type] == "png")
                        || ($value[type] == "gif")
                    )
                    {
                        $viewing2 = "<img style=\"max-width:100%\" src=\"" . $location . "\" />";
                    }
                    else if (($value[type] == "mp4")
                        || ($value[type] == "3gp")
                        || ($value[type] == "flv")
                    )

                    {
                        $viewing = $location;
                    }
                    else if ($value[type] == "mp3")
                    {
                        $viewing = $location;

                    }
                    else if (($value[type] == "pdf")
                        || ($value[type] == "doc")
                        || ($value[type] == "docx")
                        || ($value[type] == "xls")
                        || ($value[type] == "xlsc")
                        || ($value[type] == "ppt")
                        || ($value[type] == "pptx")
                        || ($value[type] == "pages")
                        || ($value[type] == "flv")
                    )
                    {
                        $viewing2 = "<iframe src=\"http://docs.google.com/viewer?url=" . $_SERVER['SERVER_NAME'] . "/" . $location . "&embedded=true\" width=\"100%\" height=\"500px\" style=\"border: none;\"></iframe>";

                    }
                    else
                    {
                        $viewing2 = "<a href='?op=share&file=" . $value[location] . "'><img style=\"max-width:100%\" src=\"images/cover/download.png\" /></a>";
                    }

                    $q_views = "update cloud set views = " . $views . " where cloud_id = " . $id . "";
                    $db->query($q_views);

                }
                else
                {
                    die("Item not found!");
                }
            }
            else
            {
                die("Item not found!");
            }


        }
        else
        {
            die("Page cannot be accessed. Please login!");
        }
    }
    else
    {
        die();
    }
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="metro/css/modern.css" rel="stylesheet">
    <link href="metro/css/modern-responsive.css" rel="stylesheet">
    <link href="metro/css/site.css" rel="stylesheet" type="text/css">
    <link href="metro/js/alertify/themes/alertify.css" rel="stylesheet" type="text/css">
    <link href="metro/js/alertify/themes/alertify.default.css" rel="stylesheet" type="text/css">
    <link href="metro/js/tinybox/tiny.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="metro/js/tinybox/tinybox.js"></script>
    <script type="text/javascript" src="metro/js/alertify/alertify.min.js"></script>
    <script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="metro/js/assets/moment.js"></script>
    <script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
    <script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
    <script type="text/javascript" src="metro/js/modern/accordion.js"></script>
    <script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
    <script type="text/javascript" src="metro/js/modern/carousel.js"></script>
    <script type="text/javascript" src="metro/js/modern/input-control.js"></script>
    <script type="text/javascript" src="metro/js/modern/pagecontrol.js"></script>
    <script type="text/javascript" src="metro/js/modern/rating.js"></script>
    <script type="text/javascript" src="metro/js/modern/slider.js"></script>
    <script type="text/javascript" src="metro/js/modern/tile-slider.js"></script>
    <script type="text/javascript" src="metro/js/modern/tile-drag.js"></script>
    <script type="text/javascript" src="metro/js/modern/calendar.js"></script>
    <script type="text/javascript"
            src="metro/js/flowplayer/flowplayer-3.2.12.min.js">
    </script>
    <?php
    if ($isuser)
    {
        ?>
        <script>
            function delete_file(id)
            {
                $.ajax({
                    type: "GET",
                    data: {id_to_delete: id},
                    url: "?op=cloud&go=delete",
                    success: function (html)
                    {

                        self.location = "?op=cloud";
                    },
                    error: function ()
                    {
                        //alert("Error");
                    }
                });

            }
        </script>
    <?php } ?>
    <?php if (!isset($viewing2))
    {
        ?>
        <script>
            $(document).ready(function (e)
            {
                $f("player", "metro/js/flowplayer/flowplayer-3.2.16.swf", {

                    clip: {
                        url: "<?php echo $viewing; ?>"

                        // this style of configuring the cover image was added in audio
                        // plugin version 3.2.3

                    }

                });
            });

        </script>
        <style>
            #player {
                display: block;
                width: 100%;
                height: 453px;
            }
        </style>
    <?php } ?>
    <!-- 3. skin -->

    <title>Pin Cloud</title>
</head>

<body class="metrouicss">
<div class="nav-bar bg-color-darken">
    <div class="nav-bar-inner"><span class="element">Pin Cloud</span> <span class="divider"></span>
        <ul class="menu">
            <li><a href="?op=home">Pin-It Home</a></li>
            <li data-role="dropdown"><a href="#">Pin!</a>
                <ul class="dropdown-menu">
                    <li><a href="?op=traffics">Pin-Traffics</a></li>
                    <li><a href="?op=entertainment">Pin-Entertainment</a></li>
                    <li><a href="?op=shopping">Pin-Shopping</a></li>
                    <li><a href="?op=job">Pin-Jobs</a></li>
                    <li><a href="?op=trades">Pin-Trades</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="page">
    <div class="page-region">
        <div class="page-region-content">
            <div class="page-control" data-role="page-control">
                <!-- Responsive controls -->
                <span class="menu-pull"></span>

                <div class="menu-pull-bar"></div>
                <!-- Tabs -->
                <ul>
                    <li class="active"><a href="#cloud_i">Information</a></li>
                    <div class="frames">
                        <div class="frame active" id="cloud_i">
                            <div>
                                <center>
                                    <div id="player"> <?php echo $viewing2; ?> </div>
                                </center>
                            </div>
                            <?php
                            if ($isuser)
                            {
                                ?>
                                <div>
                                    <br/>
                                    <span style="cursor:pointer"
                                          onclick="Alertify.dialog.confirm('Are you OK to delete this file?', function () { delete_file(<?php echo $id; ?>); },function () {     });"><i
                                            class="icon-remove"></i> Delete this file</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="cursor:pointer"
                                          onclick="TINY.box.show({iframe:'?op=cloud&go=cshare&ids=<?php echo $id; ?>',width:300,height:300,boxid:'frameless',fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><i
                                            class="icon-share"></i> Share this file</span>
                                </div>

                            <?php
                            }
                            ?>
                            <div>
                                <fieldset style="margin-top:5px">
                                    <h2 class="place-right"><?php echo $views; ?> views.</h2>
                                    <?php
                                    echo "File name : " . $filename;
                                    echo "<br/>";
                                    echo "Folder/Album name : " . $folder_name;
                                    echo "<br/>";
                                    echo "File type : " . $type;
                                    echo "<br/>";
                                    echo "File size : " . $size . "KB";
                                    echo "<br/>";

                                    echo "Date uploaded : " . $date_uploaded;
                                    echo "<br/>";
                                    echo "Owner : " . $owner;
                                    echo "<br/>";
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
</body>
</html>
