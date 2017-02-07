<P><B>M</B>uat Naik Gambar</p><form method="POST" enctype="multipart/form-data" action="">
	Silih pilih gambar
	  <p><input type="file" name="gfx" size="20"> <select name=cat>
      <?php
	$startMid = $account[mid];
	$endMid = $account[mid]+99;
if ($admin == 5)
	$lmq = mysql_query("SELECT * FROM masjid ORDER BY mID ASC");
else if ($admin == 4)
{
	$lmq = mysql_query("SELECT * FROM masjid WHERE mID >= $startMid AND mID <= $endMid ORDER BY mID ASC");
}
else if ($admin == 3)
{
	$lmq = mysql_query("SELECT * FROM masjid WHERE mID = $startMid ORDER BY mID ASC");
}
while ($lmr = mysql_fetch_array($lmq))
	  {
		  ?>
<option value=<?php echo $lmr[mID];?>>Masjid <?php echo $lmr[mName];?></option>
<?php
}
if ($admin == 5)
{
?>
<option value=0>SEMUA</option>
<?php } ?>
</select>
<BR><BR> 
Tajuk Gambar:</p>
	  <p>
	    <input name="title" type="text" id="title" size="50">
	  </p>
	  <p>Deskripsi Gambar:</p>
	<p>
  <textarea name="desc" cols="50" rows="5"></textarea>
  <BR><input type="hidden" value="1" name="upload"><input type="submit" value="Muat Naik!" name="B1"><input type="reset" value="Reset" name="B2">
  </p>
</form>		
