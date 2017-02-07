<li><a href="?option=<?php echo $option;?>&op=activitylist">Senarai Aktiviti</a></li>
<li><a href="?option=<?php echo $option;?>&op=hadith/list">Senarai Hadith</a></li>
<li><a href="?option=<?php echo $option;?>&op=FAQ/open_FAQ">Senarai FAQ</a></li>
<li><a href="?option=<?php echo $option;?>&op=livestream">Tonton LIVE!</a></li>
<li><a href="?option=<?php echo $option;?>&op=register">Daftar Pengguna</a></li>
<li><a href="?option=<?php echo $option;?>&op=location">Peta Masjid</a></li>
<?php 
	if ($admin >= 1)
	{
		
?>
</ul>
<ul><h4>PENTADBIRAN</h4>
<li><a href="?option=<?php echo $option;?>&op=activityform">Tambah Aktiviti</a></li>
<li><a href="?option=<?php echo $option;?>&op=FAQ/AddFAQ">Tambah FAQ</a></li>
<li><a href="?option=<?php echo $option;?>&op=article">Tambah Artikel</a></li>
<li><a href="?option=<?php echo $option;?>&op=mosque">Tambah Masjid</a></li>
<li><a href="?option=<?php echo $option;?>&op=searchmap">Tambah Peta</a></li>
<li><a href="?option=<?php echo $option;?>&op=activityparticipants">Senarai Peserta</a></li>
<li><a href="?option=<?php echo $option;?>&op=FAQ/manage_FAQ">Kemaskini FAQ</a></li>
<li><a href="?option=<?php echo $option;?>&op=acc/edit">Kemaskini Akaun</a></li>
<li><a href="?option=<?php echo $option;?>&op=photos/upload">Muat Naik Gambar</a></li>
<?php 
	}
	if ($member >= 1)
	{
?>
<li><a href="?option=<?php echo $option;?>&op=logout">Daftar Keluar</a></li>
<?php }?>