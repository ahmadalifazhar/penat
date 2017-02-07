
  <?php
  if ($_POST[opchk] == "Papar")
  {
	  $uEditq = mysql_query("SELECT * FROM accounts WHERE aid= ".$_POST[opname]." LIMIT 0,1");
	  $uEdit = mysql_fetch_array($uEditq);
  }

else if ($_POST[opchk] == "Padam Akaun")
{
		if (mysql_query("DELETE FROM accounts WHERE aid=".$_POST[opname]." AND pos!=5"))
			msg(NULL, "Tahniah, akaun beliau telah berjaya dipadamkan");
		else
			msg("ERROR", "Maaf, beliau anda tidak berjaya dipadamkan");
}
else if ($_POST[opchk] == "Kemaskini")
{
	if ($admin >= 2)
	{
		include "modules/uploadsys.php";
		$detailpic = uploadpic($_POST);
		$detail[fname]			= $_POST[fname];
		$detail[lname]			= $_POST[lname];
		$detail[dob]			= $_POST[dob];
		$detail[icnum]			= $_POST[icnum];
		$detail[addr1]			= $_POST[addr1];
		$detail[addr2]			= $_POST[addr2];
		$detail[city]			= $_POST[city];
		$detail[postal]			= $_POST[postal];
		$detail[state]			= $_POST[state];
		$detail[telh]			= $_POST[telh];
		$detail[telm1]			= $_POST[telm1];
		$detail[telm2]			= $_POST[telm2];
		$detail[telo]			= $_POST[telo];
		$detail[uname]			= $_POST[uname];
		$detail[email]			= $_POST[email];
		$detail[mid]			= $_POST[mid];
		$detail[pos]			= $_POST[pos];
		$detail[posname]		= $_POST[posname];
		$detail[sendemail]		= $_POST[sendemail];
		$detailwhere[aid]		= $_POST[aid];
		if ($detailpic[success] == 1)
		{
			$detail[picname]	= $detailpic[filename];
			msg("NOTIS", "Gambar berjaya dimuatnaikkan.");
		}
		else if ($detailpic[success] == 2)
			msg("ERROR", "Gambar tidak berjaya dimuatnaikkan. Kemaskini sistem diteruskan tanpa mengemaskinikan gambar.");
		if (($_POST[pwd] == $_POST[pwd2]) && (strlen($_POST[pwd]) >= 4))
		{
			$detail[pwd]		= $_POST[pwd];
			msg("NOTIS", "Katalaluan berjaya dikemaskinikan.");
		}
		else if (strlen($_POST[pwd]) >= 4)
			msg("ERROR", "Katalaluan tidak sah/sama. Kemaskini sistem diteruskan tanpa mengemaskinikan kata laluan.");

		//echo gendata("accounts", $detail, $detailwhere);
		$sqlupdate = gendata("accounts", $detail, $detailwhere);
		if (mysql_query($sqlupdate))
			msg(NULL, "Tahniah, akaun beliau telah berjaya dikemaskinikan");
		else
			msg("ERROR", "Maaf, beliau anda tidak berjaya dikemaskinikan.. $sqlupdate");
		$uEditq = mysql_query("SELECT * FROM accounts WHERE aid= ".$_POST[aid]." LIMIT 0,1");
	  	$uEdit = mysql_fetch_array($uEditq);
	}
	else
		msg("ERROR", "Maaf, akaun beliau tidak berjaya dikemaskinikan. Anda tidak dibenarkan memasuki mana-mana masjid lain.");
}

  ?>
  <form name="form2" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCFFFF">
    <tr>
      <td colspan="3" align="left" bgcolor="#6633FF" style="color:White"><strong>Maklumat Carian</strong></td>
    </tr>
    <tr>
      <td width="30%" align="right">Nama Pertama</td>
      <td width="5%" align="center">:</td>
      <td width="65%"><input name="cfname" type="text" id="cfname" size="50" /></td>
</tr>
    <tr>
      <td align="right">Nama Terakhir</td>
      <td align="center">:</td>
      <td>
      <input name="clname" type="text" id="clname" size="50" /></td>
    </tr>
    <tr>
      <td align="right">Masjid</td>
      <td align="center">:</td>
      <td><select name=cmasjid id="cmasjid">
      <?php
	$startMid = $account[mid];
	$endMid = $account[mid]-99;
if ($admin == 5)
{
	$lmq = mysql_query("SELECT * FROM masjid,category WHERE category.mType=1 AND masjid.mID=category.mID ORDER BY masjid.mID ASC");
	?>
    <option value=1 selected=selected>-----------</option>
<?php
}
else if ($admin == 4)
{
	$lmq = mysql_query("SELECT * FROM masjid WHERE mID = $startMid ORDER BY mID ASC");
}
while ($lmr = mysql_fetch_array($lmq))
	  {
		  ?>
<option value=<?php echo $lmr[mID];?>>Masjid <?php echo $lmr[mName];?></option>
<?php
}
?>
</select></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>
      <input type="submit" name="opchk" id="button6" value="Cari"></td>
    </tr>
    <tr>
      <td align="right">Senarai Nama</td>
      <td align="center">:</td>
      <td><select name="opname" id="opname">
      <?php
	  if ($_POST[opchk] == "Cari")
	  {
		  $cariklok = 0;
			  if ($_POST[cfname] == "") { $_POST[cfname] = "XYZXYZXYZXYZXYZXYZXYZXYZ"; $cariklok++; }
			  if ($_POST[clname] == "") { $_POST[clname] = "XYZXYZXYZXYZXYZXYZXYZXYZ"; $cariklok++; }
			  if ($_POST[cmasjid] >= 2) $cmasjid = " AND mID=".$_POST[cmasjid];
			  if (($_POST[cmasjid] == 1) || ($cariklok == 2)) $cmasjid = " OR mID=".$_POST[cmasjid];
		  $opnameq = mysql_query("SELECT * FROM accounts WHERE ((fname LIKE '%".$_POST[cfname]."%' OR lname LIKE '%".$_POST[clname]."%') $cmasjid ) ORDER BY fname ASC");
	  }
	  else
  		  $opnameq = mysql_query("SELECT * FROM accounts ORDER BY fname ASC");

	  while ($opnamerow = mysql_fetch_array($opnameq))
	  {
	  ?>
      <option value=<?php echo $opnamerow[aid];?>><?php echo $opnamerow[fname];?> <?php echo $opnamerow[lname];?></option>
      <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>
      <input type="submit" name="opchk" id="opchk" value="Papar">
      <input type="submit" name="opchk" id="button4" value="Padam Akaun">
      <input type="reset" id="button5" value="Reset"></td>
    </tr>
    <tr> </tr>
    <tr> </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>
  <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</p>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<form id="form1" name="form1" method="post" enctype="multipart/form-data"  action="">
<input type=hidden name=aid value="<?php echo $uEdit[aid];?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCFFFF">
    <tr>
      <td colspan="3" align="left" bgcolor="#6633FF" style="color:White"><strong>Maklumat Peribadi</strong></td>
    </tr>
    <tr>
      <td width="30%" align="right">Nama Pertama</td>
      <td width="5%" align="center">:</td>
      <td width="65%"><span id="sprytextfield1">
        <input name="fname" type="text" id="fname" value="<?php echo $uEdit[fname];?>" size="50" />
        <br>
        <span class="textfieldRequiredMsg">Sila isikan nama pertama beliau.</span></span></td>
    </tr>
    <tr>
      <td width="30%" align="right">Nama Terakhir</td>
      <td width="5%" align="center">:</td>
      <td width="65%"><span id="sprytextfield2">
        <input name="lname" type="text" id="lname" value="<?php echo $uEdit[lname];?>" size="50" />
        <br>
        <span class="textfieldRequiredMsg">Sila isikan nama terakhir beliau</span><span class="textfieldRequiredMsg">.</span></span></td>
    </tr>
    <tr>
      <td width="30%" align="right">&nbsp;</td>
      <td width="5%" align="center">&nbsp;</td>
      <td width="65%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Tarikh Lahir</td>
      <td align="center">:</td>
      <td>      <input name="dob" type="date" required id="dob" value="<?php echo $uEdit[dob];?>"> 
      (Format: mm/dd/yyyy)</td>
    </tr>
    <tr>
      <td align="right">No Kad Pengenalan</td>
      <td align="center">:</td>
      <td><span id="sprytextfield3">
      <input name="icnum" type="text" id="icnum" value="<?php echo $uEdit[icnum];?>" size="50" />
      <br>
      <span class="textfieldRequiredMsg">Sila isikan nombor kad pengenalan beliau. Contoh: 810130123456.</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234.</span><span class="textfieldMinCharsMsg"><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span>Nombor kad pengenalan beliau kurang daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234.</span><span class="textfieldMaxCharsMsg"><span class="textfieldMinCharsMsg">Nombor kad pengenalan beliau kurang daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldMinCharsMsg">Nombor kad pengenalan beliau kurang daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234</span>Nombor kad pengenalan beliau lebih daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234.</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left" bgcolor="#6633FF" style="color:White"><strong>Maklumat Tempat Tinggal</strong></td>
    </tr>
    <tr>
      <td align="right">Alamat Rumah Jalan 1</td>
      <td align="center">:</td>
      <td><span id="sprytextfield4">
        <input name="addr1" type="text" id="addr1" value="<?php echo $uEdit[addr1];?>" size="50" />
      <span class="textfieldRequiredMsg">
      <BR>
      Sila isikan alamat rumah jalan 1 beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">Alamat Rumah Jalan 2</td>
      <td align="center">:</td>
      <td><span id="sprytextfield5">
        <input name="addr2" type="text" id="reg8" value="<?php echo $uEdit[addr2];?>" size="50" />
      <span class="textfieldRequiredMsg">
      <BR>
      Sila isikan alamat rumah jalan 2 beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">Bbeliaur/Daerah</td>
      <td align="center">:</td>
      <td><span id="sprytextfield6">
        <input name="city" type="text" id="reg10" value="<?php echo $uEdit[city];?>" size="50" />
      <span class="textfieldRequiredMsg">
      <BR>
      Sila isikan bbeliaur/daerah beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">Poskod</td>
      <td align="center">:</td>
      <td><span id="sprytextfield7">
      <input name="postal" type="text" id="reg7" value="<?php echo $uEdit[postal];?>" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan poskod beliau.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td align="right">Negeri</td>
      <td align="center">:</td>
      <td><span id="spryselect1">
        <select name="state" id="select2">
        <option value="<?php echo $uEdit[state];?>" selected=selected><?php echo $uEdit[state];?></option>
          <option>-</option>
          <option value="Selangor">Selangor</option>
          <option value="Johor">Johor</option>
          <option value="Sabah">Sabah</option>
          <option value="Sarawak">Sarawak</option>
          <option value="Perak">Perak</option>
          <option value="Kedah">Kedah</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Pulau Pinang">Pulau Pinang</option>
          <option value="Kelantan">Kelantan</option>
          <option value="Pahang">Pahang</option>
          <option value="Terengganu">Terengganu</option>
          <option value="Negeri Sembilan">Negeri Sembilan</option>
          <option value="Melaka">Melaka</option>
          <option value="Perlis">Perlis</option>
          <option value="Labuan">Labuan</option>
          <option value="Putrajaya">Putrajaya</option>
        </select>
        <br>
<span class="selectRequiredMsg">Sila pilih salah satu negeri beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left" bgcolor="#6633FF" style="color:White"><strong>Maklumat Perhubungan</strong></td>
    </tr>
    <tr>
      <td align="right">Nombor Telefon (Rumah)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield8">
        <input name="telh" type="text" id="reg16" value="<?php echo $uEdit[telh];?>" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan nombor telefon beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">Nombor Telefon (Bimbit 1)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield9">
        <input name="telm1" type="text" id="reg20" value="<?php echo $uEdit[telm1];?>" size="50" />
      <span class="textfieldRequiredMsg"><BR>Sila isikan beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">Nombor Telefon (Bimbit 2)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield10">
        <input name="telm2" type="text" id="reg21" value="<?php echo $uEdit[telm2];?>" size="50" />
      <span class="textfieldRequiredMsg"><BR>Sila isikan beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">Nombor Telefon (Pejabat)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield11">
        <input name="telo" type="text" id="reg22" value="<?php echo $uEdit[telo];?>" size="50" />
</span></td>
    </tr>
    <tr>
      <td width="30%" align="right">&nbsp;</td>
      <td width="5%" align="center">&nbsp;</td>
      <td width="65%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left" bgcolor="#6633FF" style="color:White"><strong>Maklumat Keahlian</strong></td>
    </tr>
    <tr>
      <td align="right">Nama Keahlian (username)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield12">
        <input name="uname" type="text" id="reg9" value="<?php echo $uEdit[uname];?>" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan nama keahlian beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">Alamat Emel</td>
      <td align="center">:</td>
      <td><span id="sprytextfield13">
        <input name="email" type="text" id="reg12" value="<?php echo $uEdit[email];?>" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan alamat emel beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Kata Laluan Baru</td>
      <td align="center">:</td>
      <td>
        <input name="pwd" type="password" id="reg13" size="50" /></td>
    </tr>
    <tr>
      <td align="right">Ulang Kata Laluan Baru</td>
      <td align="center">:</td>
      <td>
        <input name="pwd2" type="password" id="reg14" size="50" /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Jawatan Sistem</td>
      <td align="center">:</td>
      <td><select name="pos" id="pos">
      <?php if ($uEdit[pos] == 5) {?>
<option value=5 selected=selected>Webmaster Sistem</option>      
      <?php } else {?>
      <option value=0 <?php if ($uEdit[pos] == 0) echo "selected=selected";?>>Ahli Biasa Sistem</option>
<option value=2 <?php if ($uEdit[pos] == 2) echo "selected=selected";?>>Staff Peringkat Asas I Sistem</option>
<option value=3 <?php if ($uEdit[pos] == 3) echo "selected=selected";?>>Staff Peringkat Asas II Sistem</option>
<option value=4 <?php if ($uEdit[pos] == 4) echo "selected=selected";?>>Staff Peringkat Asas III Sistem</option>
<option value=6 <?php if ($uEdit[pos] == 6) echo "selected=selected";?>>Staff Peringkat Tertinggi I Sistem</option>
<option value=7 <?php if ($uEdit[pos] == 7) echo "selected=selected";?>>Staff Peringkat Tertinggi II Sistem</option>
<option value=8 <?php if ($uEdit[pos] == 8) echo "selected=selected";?>>Staff Peringkat Tertinggi III Sistem</option>
<option value=9 <?php if ($uEdit[pos] == 9) echo "selected=selected";?>>Staff Peringkat Penolong Pengarah Sistem</option>
<option value=10 <?php if ($uEdit[pos] == 10) echo "selected=selected";?>>Staff Peringkat Pengarah Sistem</option>
<?php } ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">Nama Jawatan</td>
      <td align="center">:</td>
      <td><span id="sprytextfield15">
        <input name="posname" type="text" id="reg2" value="<?php echo $uEdit[posname];?>" size="50" />
        <span class="textfieldRequiredMsg"><BR>
          Sila isikan jawatan beliau.</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Gambar profil</td>
      <td align="center">:</td>
      <td><input type="file" name="gfx" size="20" /><BR />
      <input name="upload" type="checkbox" id="upload" value="1" />
      <em>Muatnaik gambar (Tinggi: 100, Lebar: 90)</em></td>
    </tr>
    <tr>
      <td align="right">Hantar emel pemberitahuan</td>
      <td align="center">:</td>
      <td><input name="sendemail" type="checkbox" id="sendemail" value="1"  <?php if ($uEdit[sendemail] == 1) echo 'checked="checked"';?> /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Jenis Daftar Masuk Keahlian Masjid</td>
      <td align="center">:</td>
      <td><span id="spryselect2">
        <select name="mid" id="mid">
          <?php
		  $list = mysql_query("SELECT * FROM masjid ORDER BY mID ASC");
		  if ($list)
		  {
			  while ($row = mysql_fetch_array($list))
			  {
				  ?>
            <option <?php if ($uEdit[mid] == $row[mID]) echo "selected=selected";?> value="<?php echo $row[mID];?>">Masjid <?php echo $row[mName];?></option>
            <?php } }
			?>
          </select>
      <span class="selectRequiredMsg"><br>
      Sila pilih salah satu.</span></span>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td><input type="submit" name="opchk" id="button" value="Kemaskini" />
      <input type="reset" name="button2" id="button2" value="Reset" /></td>
    </tr>
    <tr>
      <td width="30%" align="right">&nbsp;</td>
      <td width="5%" align="center">&nbsp;</td>
      <td width="65%">&nbsp;</td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {minChars:12, maxChars:12});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "none", {isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17");
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
</script>
