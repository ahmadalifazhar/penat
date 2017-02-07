<?php
$db = new dbcon ( "localhost", "root", "", "blur" );
$db->setStatus ( 1 );
$isnotuser = true;
if (isset ( $_REQUEST [userid] )) {
	$cloud = new getUser ();
	$check = $cloud->qUser ( $_REQUEST [userid] );
	
	if (! $check) {
		include $module_root . "lib/error.php";
		die ();
	}
	
	if ($_REQUEST [userid] == $userunq) {
		$isnotuser = false;
	} else {
		$isnotuser = true;
	}
	// query for user n non-user
	$cloud = new getUser ();
	$cloud->qUser ( $_REQUEST [userid] );
} else {
	$isnotuser = false;
	// query for user
	
	$cloud = new getUser ();
	$cloud->qUser ( $userunq );
}

$userforcloud;
if (! $isnotuser) {
	$userforcloud = $userunq;
} else {
	$userforcloud = $_REQUEST [userid];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="metro/css/modern.css" rel="stylesheet">
	<link href="metro/css/modern-responsive.css" rel="stylesheet">
		<link href="metro/css/site.css" rel="stylesheet" type="text/css">
			<link href="metro/js/google-code-prettify/prettify.css"
				rel="stylesheet" type="text/css">
				<link href="metro/js/tinybox/tiny.css" rel="stylesheet"
					type="text/css">
					<link href="metro/js/alertify/themes/alertify.css" rel="stylesheet"
						type="text/css">
						<link href="metro/js/alertify/themes/alertify.default.css"
							rel="stylesheet" type="text/css">
							<link rel="stylesheet" type="text/css"
								href="metro/js/player/mediaelementplayer.css" />
							<script type="text/javascript"
								src="metro/js/assets/jquery-1.9.0.min.js"></script>
							<script type="text/javascript"
								src="metro/js/assets/jquery.mousewheel.min.js"></script>
							<script type="text/javascript" src="metro/js/assets/moment.js"></script>
							<script type="text/javascript"
								src="metro/js/assets/moment_langs.js"></script>
							<script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
							<script type="text/javascript" src="metro/js/modern/accordion.js"></script>
							<script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
							<script type="text/javascript" src="metro/js/modern/carousel.js"></script>
							<script type="text/javascript"
								src="metro/js/modern/input-control.js"></script>
							<script type="text/javascript"
								src="metro/js/modern/pagecontrol.js"></script>
							<script type="text/javascript" src="metro/js/modern/rating.js"></script>
							<script type="text/javascript" src="metro/js/modern/slider.js"></script>
							<script type="text/javascript"
								src="metro/js/modern/tile-slider.js"></script>
							<script type="text/javascript" src="metro/js/modern/tile-drag.js"></script>
							<script type="text/javascript" src="metro/js/modern/calendar.js"></script>
							<script type="text/javascript" src="metro/js/tinybox/tinybox.js"></script>
							<script type="text/javascript"
								src="metro/js/player/mediaelement-and-player.js"></script>
							<script type="text/javascript"
								src="metro/js/player/audio-player.js"></script>
							<script type="text/javascript"
								src="metro/js/alertify/alertify.min.js"></script>
							<script src="http://malsup.github.com/jquery.form.js"></script>
							<!-- Add fancyBox -->
							<link rel="stylesheet"
								href="metro/js/fancyapps/source/jquery.fancybox.css?v=2.1.4"
								type="text/css" media="screen" />
							<script type="text/javascript"
								src="metro/js/fancyapps/source/jquery.fancybox.pack.js?v=2.1.4"></script>

							<!-- Optionally add helpers - button, thumbnail and/or media -->
							<link rel="stylesheet"
								href="metro/js/fancyapps/source/helpers/jquery.fancybox-buttons.css?v=1.0.5"
								type="text/css" media="screen" />
							<script type="text/javascript"
								src="metro/js/fancyapps/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
							<script type="text/javascript"
								src="metro/js/fancyapps/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
							<link rel="stylesheet"
								href="metro/js/fancyapps/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7"
								type="text/css" media="screen" />
							<script type="text/javascript"
								src="metro/js/fancyapps/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
							<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    -->
							<script type="text/javascript">
        $(document).ready(function ()
        {
            $(".fancybox").fancybox();
        });


    </script>
							<script>

        function delete_file(id, x, z)
        {
            $.ajax({
                type: "GET",
                data: {id_to_delete: id},
                url: "?op=cloud&go=delete",
                success: function (html)
                {

                    getdata(x, z);
                },
                error: function ()
                {
                    //alert("Error");
                }
            });

        }
        function getdata(x, z)
        {
            $(document).ajaxStart(function ()
            {
                $('#ajaxBusy').show();
            }).ajaxStop(function ()
                {
                    $('#ajaxBusy').hide();
                });
            $("#aLoadAll" + x + "").append('<div id="ajaxBusy"><p><center><img src="images/loading.gif"></center></p></div>');

            $.ajax({
                type: "GET",
                url: "?op=cloud&go=all<?php
																if (isset ( $_GET [userid] )) {
																	echo "&userid=" . $_GET [userid];
																}
																?>",
                dataType: 'html',
                data: {page: 1, folderid: x, style: z},
                success: function (html)
                {
                    $("#aLoadAll" + x + "").hide().html(html).fadeIn("slow"); //Insert chat log into the #chatbox div


                },
                error: function ()
                {
                    //alert(x);
                }

            });

        }


        function navigate(b, y, z)
        {
            $(document).ajaxStart(function ()
            {
                $('#ajaxBusy').show();
            }).ajaxStop(function ()
                {
                    $('#ajaxBusy').hide();
                });
            $("#aLoadAll" + y + "").append('<div id="ajaxBusy"><p><center><img src="images/loading.gif"></center></p></div>');
            $.ajax({
                type: "GET",
                url: "?op=cloud&go=all<?php
																if (isset ( $_GET [userid] )) {
																	echo "&userid=" . $_GET [userid];
																}
																?>",
                dataType: 'html',
                data: {page: b, folderid: y, style: z},
                success: function (html)
                {
                    $("#aLoadAll" + y + "").hide().html(html).fadeIn("slow"); //Insert chat log into the #chatbox div
                    //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                    //if(newscrollHeight > oldscrollHeight){
                    //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                    //}
                },
                error: function ()
                {
                    //alert("Error:");
                }

            });

        }


    </script>
							<script type='text/javascript'>
        $(document).ready(function ()
        {
            $("#search_results_file").hide();
            $("#button_find_file").click(function (event)
            {
                event.preventDefault();
                search_ajax_way();
            });
            $("#search_query_file").keyup(function (event)
            {
                event.preventDefault();
                search_ajax_way();
            });

        });

        function search_ajax_way()
        {
            $("#search_results_file").show();
            var search_this = $("#search_query_file").val();
            if (search_this == "")
            {
                $("#search_results_file").hide();
            }

            $.post("?op=cloud&go=search-file", {searchit: search_this}, function (data)
            {
                $("#search_results_file").html(data);

            })
        }
    </script>
							<title>Pin Cloud</title>
							<style>
#search_results_file {
	background-color: #C1FDFC;
	border: 1px solid #D2D2D2;
	width: 100%;
	position: relative;
	z-index: 1000;
	border-top: none;
	margin-top: -10px;
	padding-left: 10px;
	padding-top: 10px;
	padding-bottom: 10px;
}
</style>

</head>

<body class="metrouicss">
	<div class="nav-bar bg-color-darken">
		<div class="nav-bar-inner">
			<span class="element">Pin Cloud</span> <span class="divider"></span>
			<ul class="menu">
				<li><a href="?op=home">Pin-It Home</a></li>
				<li data-role="dropdown"><a href="#">Pin!</a>
					<ul class="dropdown-menu">
						<li><a href="?op=traffics">Pin-Traffics</a></li>
						<li><a href="?op=entertainment">Pin-Entertainment</a></li>
						<li><a href="?op=shopping">Pin-Shopping</a></li>
						<li><a href="?op=job">Pin-Jobs</a></li>
						<li><a href="?op=trades">Pin-Trades</a></li>
					</ul></li>
			</ul>
		</div>
	</div>
	<div class="page">
		<div class="page-header">
			<div class="page-header-content">
        <?php
								if ($isnotuser) {
									?>
            <h1>
					<span class="fg-color-pink">
      <?php
									echo $cloud->getfname () . " " . $cloud->getlname ();
									?>
      </span> Pin Cloud.
				</h1>
        <?php
								} else {
									?>
            <h1>
					Welcome, <span class="fg-color-pink">
      <?php
									echo $cloud->getfname () . " " . $cloud->getlname ();
									?>
      </span>.
				</h1>
        <?php
								}
								?>
    </div>
		</div>
		<div class="page-region">
			<div class="page-region-content">
				<div class="page-control" data-role="page-control">
					<!-- Responsive controls -->
					<span class="menu-pull"></span>

					<div class="menu-pull-bar"></div>
					<!-- Tabs -->
					<ul>
						<li class="active"><a href="#cloud_s">Home</a></li>
						<li><a href="#all">Files</a></li>
						<li><a href="#photos">Album</a></li>
    <?php
				if (! $isnotuser) {
					?>
        <li class="place-right"><a href="#setting">Settings <i
								class="icon-wrench"></i></a></li>
    <?php } ?>
</ul>
					<!-- Tabs content -->
					<div class="frames">
						<div class="frame" id="all">
							<div>

								<h2>Folder List</h2>
								<blockquote>
									Below are your folders. You can create folders as many as you
									like. <a href="#">Learn more.</a>
								</blockquote>
							</div>
    <?php
				
				?>
    <?php if (!$isnotuser): ?>
        <?php
					$privacy = new Privacy ( $userforcloud, 0 );
					$q = $privacy->getfolder_sql ();
					$rlistfolder = $db->query ( $q );
					?>
        <ul class="accordion dark" style="margin-left: 0"
								data-role="accordion">
            <?php
					while ( $data = $db->fetch_array_assoc ( $rlistfolder ) ) {
						if ($data ['privacy'] == 1) {
							$privacymsg = "(Private)";
						} else {
							$privacymsg = "";
						}
						echo '<li class="">';
						echo '<a onclick="getdata(' . $data [folder_id] . ', 1)" href="#">' . $data [name] . '&nbsp' . $privacymsg . '<span class="place-right" style="font-size: 10px; font-style: italic">Created at ' . $data [date] . '&nbsp;&nbsp;&nbsp;</span></a> ';
						echo '<div style="display: none;">';
						echo '<h3>Files</h3>';
						echo '<div id="aLoadAll' . $data [folder_id] . '"></div>';
						echo '</div>';
						echo '</li>';
						echo ' ';
						echo '';
					}
					
					?>
        </ul>

    <?php else: ?>
        <?php
					$privacy = new Privacy ( $userforcloud, 1 );
					$q = $privacy->getfolder_sql ();
					$rlistfolder = $db->query ( $q );
					?>
        <ul class="accordion dark" style="margin-left: 0"
								data-role="accordion">
            <?php
					while ( $data = $db->fetch_array_assoc ( $rlistfolder ) ) {
						echo '<li class="">';
						echo '<a onclick="getdata(' . $data [folder_id] . ', 1)" href="#">' . $data [name] . '<span class="place-right" style="font-size: 10px; font-style: italic">Created at ' . $data [date] . '&nbsp;&nbsp;&nbsp;</span></a> ';
						echo '<div style="display: none;">';
						echo '<h3>Files</h3>';
						echo '<div id="aLoadAll' . $data [folder_id] . '"></div>';
						echo '</div>';
						echo '</li>';
						echo ' ';
						echo '';
					}
					
					?>
        </ul>

    <?php endif; ?>
    <?php
				if (! $isnotuser) {
					?>
        <div>
								<button
									onclick="TINY.box.show({iframe:'?op=cloud&go=create_folder',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})">
									Create Folder</button>
								<button
									onclick="TINY.box.show({iframe:'?op=cloud&go=delete_file',boxid:'frameless',width:750,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})">
									Delete Folder</button>
								<button
									onclick="TINY.box.show({iframe:'?op=cloud&go=upload_file',boxid:'frameless',width:750,height:600,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){}})">
									Upload</button>
							</div>
    <?php
				}
				?>
</div>
						<div class="frame" id="photos">
							<div>
								<h2>Album List</h2>
								<blockquote>
									There are no space limitation until further announcement. <a
										href="#">Learn more.</a>
								</blockquote>
							</div>
    <?php
				$q2 = "SELECT f.folder_id, f.name, f.date FROM folder f WHERE (f.owner = '" . $userforcloud . "' OR f.owner = 'def') AND f.type = 2";
				$rlistfolderphoto = $db->query ( $q2 );
				
				?>
    <ul class="accordion" style="margin-left: 0" data-role="accordion">
        <?php
								while ( $data = $db->fetch_array_assoc ( $rlistfolderphoto ) ) {
									echo '<li class="">';
									echo '<a onclick="getdata(' . $data [folder_id] . ', 2)" href="#">' . $data [name] . '<span class="place-right" style="font-size: 10px; font-style: italic">Created at ' . $data [date] . '&nbsp;&nbsp;&nbsp;</span></a>';
									echo ' <div style="display: none;">';
									echo ' <h3 style="padding-left: 40px">Photos</h3>';
									echo '   <div  id="aLoadAll' . $data [folder_id] . '"></div>';
									echo '   </div>';
									echo ' </li>';
									echo ' ';
									echo '';
								}
								?>
    </ul>
    <?php
				if (! $isnotuser) {
					?>
        <div>
								<button
									onclick="TINY.box.show({iframe:'?op=cloud&go=create_album',boxid:'frameless',width:760,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})">
									Create Album</button>
								<button
									onclick="TINY.box.show({iframe:'?op=cloud&go=delete_album',boxid:'frameless',width:750,height:400,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){window.location.reload()}})">
									Delete Album</button>
								<button
									onclick="TINY.box.show({iframe:'?op=cloud&go=upload_photo',boxid:'frameless',width:750,height:600,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){}})">
									Photo Upload</button>
							</div>
    <?php
				}
				?>
</div>
						<div class="frame active" id="cloud_s">
							<div>
								<center>
									<a href="?op=cloud#setting"><img src="images/cover/cover.png" /></a>
								</center>
								<br />
							</div>
							<div>
								<div class="input-control text">
									<input type="text" name="search_query_file"
										id="search_query_file"
										placeholder="What file you want to search?" />
									<button class="btn-search" id="button_find_file"></button>
								</div>
								<div id="search_results_file"></div>
								<div style="margin-top: 30px">
									<h2>Most popular files</h2>
									<ul
										style="padding: 10px 10px 10px 10px; background-color: aliceblue;">
                <?php
																$q_top = "SELECT c.location, c.type, c.views, a.auname FROM cloud c, accounts a WHERE c.owner = a.aid order by c.views desc LIMIT 0, 5 ";
																$data = $db->fetch_all_array ( $q_top, true );
																foreach ( $data as $value ) {
																	
																	$filename = explode ( "_", $value [location] );
																	$filename_temp = array_pop ( $filename );
																	$filename_temp2 = array_pop ( $filename );
																	$a_size = count ( $filename );
																	
																	if ($a_size > 1) {
																		$filename = implode ( "_", $filename );
																		echo "<li><a style='cursor:pointer' onclick='javascript:self.location=\"?op=cloud&go=item&item_id=" . $value [location] . "\"'>" . $filename . "</a>     -    " . $value [type] . "    -    <i>by " . $value [auname] . "</i>
					<span class='place-right'>" . $value [views] . " views</span></li>";
																	} else {
																		echo "<li><a style='cursor:pointer' onclick='javascript:self.location=\"?op=cloud&go=item&item_id=" . $value [location] . "\"'>" . $filename [0] . "</a>     -    " . $value [type] . "    -    <i>by " . $value [auname] . "</i>
					<span class='place-right'>" . $value [views] . " views</span></li>";
																	}
																}
																
																?>

            </ul>
								</div>
								<div style="margin-top: 30px">
									<h2>Latest files</h2>
									<ul
										style="padding: 10px 10px 10px 10px; background-color: aliceblue;">
                <?php
																$q_top = "SELECT c.location, c.type, c.views, a.auname FROM cloud c, accounts a WHERE c.owner = a.aid order by c.date desc LIMIT 0, 5 ";
																$data = $db->fetch_all_array ( $q_top, true );
																foreach ( $data as $value ) {
																	
																	$filename = explode ( "_", $value [location] );
																	$filename_temp = array_pop ( $filename );
																	$filename_temp2 = array_pop ( $filename );
																	$a_size = count ( $filename );
																	
																	if ($a_size > 1) {
																		$filename = implode ( "_", $filename );
																		echo "<li><a style='cursor:pointer' onclick='javascript:self.location=\"?op=cloud&go=item&item_id=" . $value [location] . "\"'>" . $filename . "</a>     -    " . $value [type] . "    -    <i>by " . $value [auname] . "</i>
					<span class='place-right'>" . $value [views] . " views</span></li>";
																	} else {
																		echo "<li><a style='cursor:pointer' onclick='javascript:self.location=\"?op=cloud&go=item&item_id=" . $value [location] . "\"'>" . $filename [0] . "</a>     -    " . $value [type] . "    -    <i>by " . $value [auname] . "</i>
					<span class='place-right'>" . $value [views] . " views</span></li>";
																	}
																}
																
																?>

            </ul>
								</div>

							</div>
						</div>
<?php

if (! $isnotuser) {
	?>
    <div class="frame" id="setting">
        <?php
	$q = "SELECT c.size FROM cloud c WHERE c.owner = '" . $userforcloud . "'";
	$size = $db->query ( $q );
	$total = 0;
	while ( $data = $db->fetch_array_assoc ( $size ) ) {
		$total += $data [size];
	}
	$total = $total / 1000;
	$allowed = 200;
	$percentage = $total / 200 * 100;
	?>
        <style>
.progress {
	position: relative;
	width: 100%;
	border: 1px solid #000;
	padding: 1px;
	border-radius: 3px;
}

.bar {
	background-color: rgb(70, 70, 70);
	width: <?php echo$percentage; ?>%;
	height: 30px;
	border-radius: 3px;
}
</style>
							<div>
								<fieldset>
									<legend style="color: black;">Cloud Information</legend>
									<div class="progress">
										<div class="bar"></div>
									</div>
									<br />
									<blockquote>
										Total upload size: <strong>
                        <?php
	echo $total;
	?>
                        MB (
                        <?php
	echo $percentage;
	?>
                        %)</strong><br /> Total remaining size: <strong>
                        <?php
	echo 200 - $total;
	?>
                        MB (
                        <?php
	echo 100 - $percentage;
	?>
                        %)</strong>
									</blockquote>
								</fieldset>
							</div>
							<div>
								<fieldset>
									<legend style="color: black;">Privacy Settings</legend>
									<blockquote>
										<b>Folder privacy</b><br /> <br />
                    <?php
	$privacy_setting = new Privacy ( $userforcloud, 0 );
	$q_p_list = $privacy_setting->getfolder_sql ();
	$rlistfolder2 = $db->query ( $q_p_list );
	?>
                    <?php while ($data = $db->fetch_array_assoc($rlistfolder2)): ?>

                        <?php
		$checked_pri = "";
		$checked_pub = "";
		if ($data ['privacy'] == 1) {
			$checked_pri = "checked='checked'";
		} else {
			$checked_pub = "checked='checked'";
		}
		?>
                        <div><?php echo $data['name']; ?>
                            <span class="place-right"> <label
												class="input-control radio"> <input type="radio"
													name="<?php echo $data['folder_id']; ?>"
													<?php echo $checked_pub; ?>> <span class="helper">Public
															within Pin-It</span></label> &nbsp; <label
												class="input-control radio"> <input type="radio"
													name="<?php echo $data['folder_id']; ?>"
													<?php echo $checked_pri; ?> /> <span class="helper">Private
														(Only Me)</span>
											</label>
											</span>
										</div>
										<br />

                    <?php endwhile; ?>
                    <div>
											<b> Other privacy </b> <br /> <br /> <label
												class="input-control switch"> <input type="checkbox"> <span
													class="helper">Post upload activity</span></label><br /> <label
												class="input-control switch"> <input type="checkbox"> <span
													class="helper">Post upload activity location</span></label><br />
										</div>
										<div style="display: none" id=privacymsg>Saved</div>
									</blockquote>
								</fieldset>
							</div>
							<div>
								<fieldset>
									<legend style="color: black;">Need more space?</legend>
									<blockquote>
									We offer two packages for you to choose. These packages are the cheapest yet. 
									</blockquote>
									<blockquote>
									<p>&nbsp</p>
									<p>Package 1 : 100MB for only RM 0.10!</p>
										<form action="https://www.paypal.com/cgi-bin/webscr"
											method="post" target="_top">
											<input type="hidden" name="cmd" value="_s-xclick"> <input
												type="hidden" name="encrypted"
												value="-----BEGIN PKCS7-----MIIHZwYJKoZIhvcNAQcEoIIHWDCCB1QCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCszFDJ1WNsBFquTv2BphV4NmhIn8bcft38UcP09PlIHFIWw9XWajqf9aUj1SHnwnNS6YXT4I3Fd0LjTtHUqvb+fCNlDAw8iURbsk33t/3mDIf6WbILYSvt/jAh/dg0cjO18TPpKEswJKy97TbZLlZN+ub9pBccdAewAr87pXBOATELMAkGBSsOAwIaBQAwgeQGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIbkuwt5d+WrGAgcCvTbvPv3S0oi1ILYTNT6UwL8xBYSc6AqCZXW1HxbJ1BKaR6KQ9RzCtLD7dp2qt7vLLupuLthFKjYAhgK7QcWv+tsjujD3fj8dGcle1nq5ARAXrdgI7iv7uU+5ZY9ZGG9KRLk163YP4xhlt5nPnLzyt921H5lTgqsWHEtHuaEhAxDnZn++0kU5x3jf52c1VJ5luQq9hpJXGU9l0C/LbV2S8DTHhTJrP0f0QxXE8zkzL22sIL7hF2uvyzPgNH4spVQ6gggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xMzA4MjAxOTAwNDNaMCMGCSqGSIb3DQEJBDEWBBRUS8t+0MBkVbya+pYW2Wy4HvFLFjANBgkqhkiG9w0BAQEFAASBgK3mHcQIQizmFbYeh1bGFRnxTfWBUFAuIXioqVYtMRJRHW5yl6eDE5JrgY76A2D9m2sdzVzj8slKYe46ciqfKgeViCqRJpmWXoMcz6Ajbd9P/0flGaClWOzcUeE+L2X8C8UBSAEVPtAlqPEJR1tBhFFmmWM8LU5b/dWWtypI75Jd-----END PKCS7----- ">
													<input type="image"
													src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
													border="0" name="submit"
													alt="PayPal - The safer, easier way to pay online!"> <img
														alt="" border="0"
														src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
														width="1" height="1">
										
										</form>
									</blockquote>
									<blockquote>
									<p>&nbsp</p>
									<p>Package 2 : 100GB for only RM 50!</p>
										<form action="https://www.paypal.com/cgi-bin/webscr"
											method="post" target="_top">
											<input type="hidden" name="cmd" value="_s-xclick"> <input
												type="hidden" name="encrypted"
												value="-----BEGIN PKCS7-----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-----END PKCS7----- ">
													<input type="image"
													src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
													border="0" name="submit"
													alt="PayPal - The safer, easier way to pay online!"> <img
														alt="" border="0"
														src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
														width="1" height="1">
										
										</form>
									</blockquote>
								</fieldset>
							</div>
						</div>
<?php } ?>
</div>
				</div>
			</div>
		</div>

</body>
</html>
