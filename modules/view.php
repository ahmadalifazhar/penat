<?php
if ($_REQUEST[menu] >= 1)
{
if ($option >= 1)
{
	$hQuery[view] = mysql_query("SELECT * FROM posts WHERE mID= $option AND lID= ".$_REQUEST[menu]." ORDER BY pID LIMIT 0,1");
}
else
{
	$hQuery[view] = mysql_query("SELECT * FROM posts WHERE mID= $defaultmID AND lID= ".$_REQUEST[menu]." ORDER BY pID LIMIT 0,1");
}
if ($_REQUEST[menu] == 5)
{
	include "modules/org.php";
}
else if ($_REQUEST[menu] == 9)
{
	include "modules/photos/index.php";
}
else
{
	if ($hQuery[view])
	{
		$hRow[view] = mysql_fetch_array($hQuery[view]);
		$view[title] = $hRow[view][pTitle];
		$view[msg] = $hRow[view][pMsg];
	}
	if (strlen($view[title]) < 1)
	{
		$view[title] = "ERROR 404 : Page not found";
		$view[msg] = "Maklumat tidak dijumpai. Sila guna link-link yang lain atau pastikan anda atau sila hubungi pihak pentadbir website tersebut.";
	}
?>
<p><span class="breadcrumbs pathway"><h1><?php echo $view[title];?></h1></span>
    </p>
    <?php echo $view[msg];
} }
else {
	include "modules/notfound.php";
	?>

<p><span class="breadcrumbs pathway"><h1><?php echo $view[title];?></h1></span>
    </p>
<?php } ?>