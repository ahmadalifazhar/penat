<?php
if ($_POST[opchk] == "Daftar")
{
	if ($_POST[pwd] == $_POST[pwd])
	{
		include "modules/uploadsys.php";
		$detailpic = uploadpic($_POST);
		$detail[picname]		= $detailpic[filename];
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
		$detail[pwd]			= $_POST[pwd];
		$detail[mid]			= $_POST[mid];
		if ($detailpic[success] == 1)
		{
			$detail[picname]	= $detailpic[filename];
			msg("NOTIS", "Gambar berjaya dimuatnaikkan.");
		}
		else if ($detailpic[success] == 2)
			msg("ERROR", "Gambar tidak berjaya dimuatnaikkan. Pendaftaran sistem diteruskan tanpa memuatnaikkan gambar.");
		if (mysql_query(gendata("accounts", $detail, "INSERT")))
			msg(NULL, "Tahniah, akaun anda telah berjaya didaftarkan");
		else
			msg("ERROR", "Maaf, akaun anda tidak berjaya didaftarkan");
	}
	else
		msg("ERROR", "Maaf, akaun anda tidak berjaya didaftarkan. Katalaluan tidak sah atau tidak sama dgn ulang kata laluan.");
}
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCFFFF">
    <tr>
      <td colspan="3" align="left" bgcolor="#6633FF" style="color:White"><strong>Maklumat Peribadi</strong></td>
    </tr>
    <tr>
      <td width="30%" align="right">Nama Pertama</td>
      <td width="5%" align="center">:</td>
      <td width="65%"><span id="sprytextfield1">
        <input name="fname" type="text" id="fname" size="50" />
        <br>
        <span class="textfieldRequiredMsg">Sila isikan nama pertama anda.</span></span></td>
    </tr>
    <tr>
      <td width="30%" align="right">Nama Terakhir</td>
      <td width="5%" align="center">:</td>
      <td width="65%"><span id="sprytextfield2">
        <input name="lname" type="text" id="lname" size="50" />
        <br>
        <span class="textfieldRequiredMsg">Sila isikan nama terakhir anda</span><span class="textfieldRequiredMsg">.</span></span></td>
    </tr>
    <tr>
      <td width="30%" align="right">&nbsp;</td>
      <td width="5%" align="center">&nbsp;</td>
      <td width="65%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Tarikh Lahir</td>
      <td align="center">:</td>
      <td>      <input type="date" id="dob" name="dob" required> 
      (Format: mm/dd/yyyy)</td>
    </tr>
    <tr>
      <td align="right">No Kad Pengenalan</td>
      <td align="center">:</td>
      <td><span id="sprytextfield3">
      <input name="icnum" type="text" id="icnum" size="50" />
      <br>
      <span class="textfieldRequiredMsg">Sila isikan nombor kad pengenalan anda. Contoh: 810130123456.</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234.</span><span class="textfieldMinCharsMsg"><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldInvalidFormatMsg">Sila isikan format yang betul. Contoh: 810130131234</span>Nombor kad pengenalan anda kurang daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234.</span><span class="textfieldMaxCharsMsg"><span class="textfieldMinCharsMsg">Nombor kad pengenalan anda kurang daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234</span><span class="textfieldMinCharsMsg">Nombor kad pengenalan anda kurang daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234</span>Nombor kad pengenalan anda lebih daripada 12 aksara. Sila isikan format yang betul. Contoh: 810130131234.</span></span></td>
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
        <input name="addr1" type="text" id="addr1" size="50" />
      <span class="textfieldRequiredMsg">
      <BR>
      Sila isikan alamat rumah jalan 1 anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Alamat Rumah Jalan 2</td>
      <td align="center">:</td>
      <td><span id="sprytextfield5">
        <input name="addr2" type="text" id="reg8" size="50" />
      <span class="textfieldRequiredMsg">
      <BR>
      Sila isikan alamat rumah jalan 2 anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Bandar/Daerah</td>
      <td align="center">:</td>
      <td><span id="sprytextfield6">
        <input name="city" type="text" id="reg10" size="50" />
      <span class="textfieldRequiredMsg">
      <BR>
      Sila isikan bandar/daerah anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Poskod</td>
      <td align="center">:</td>
      <td><span id="sprytextfield7">
      <input name="postal" type="text" id="reg7" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan poskod anda.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td align="right">Negeri</td>
      <td align="center">:</td>
      <td><span id="spryselect1">
        <select name="state" id="select2">
          <option selected>-</option>
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
<span class="selectRequiredMsg">Sila pilih salah satu negeri anda.</span></span></td>
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
        <input name="telh" type="text" id="reg16" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan nombor telefon anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Nombor Telefon (Bimbit 1)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield9">
        <input name="telm1" type="text" id="reg20" size="50" />
      <span class="textfieldRequiredMsg"><BR>Sila isikan anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Nombor Telefon (Bimbit 2)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield10">
        <input name="telm2" type="text" id="reg21" size="50" />
      <span class="textfieldRequiredMsg"><BR>Sila isikan anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Nombor Telefon (Pejabat)</td>
      <td align="center">:</td>
      <td><span id="sprytextfield11">
        <input name="telo" type="text" id="reg22" size="50" />
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
        <input name="uname" type="text" id="reg9" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan nama keahlian anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Alamat Emel</td>
      <td align="center">:</td>
      <td><span id="sprytextfield13">
        <input name="email" type="text" id="reg12" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan alamat emel anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Kata Laluan</td>
      <td align="center">:</td>
      <td><span id="sprytextfield14">
        <input name="pwd" type="text" id="reg13" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan kata laluan anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">Ulang Kata Laluan</td>
      <td align="center">:</td>
      <td><span id="sprytextfield15">
        <input name="pwd2" type="text" id="reg14" size="50" />
      <span class="textfieldRequiredMsg"><BR>
      Sila isikan ulang kata laluan anda.</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Gambar profil</td>
      <td align="center">:</td>
      <td><input type="file" name="gfx" size="20" />
        <br />
        <input name="upload" type="checkbox" id="upload" value="1" />
        <em>Muatnaik gambar (Tinggi: 100, Lebar: 90)</em></td>
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
            <option value="<?php echo $row[mID];?>">Masjid <?php echo $row[mName];?></option>
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
      <td><input type="submit" name="opchk" id="button" value="Daftar" />
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
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
