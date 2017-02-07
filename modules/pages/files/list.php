<tr bgcolor="<?php echo $value[bgcolor];?>">
<td><?php echo $value[name];?>
<BR />
<a href="?op=files&relate=<?php echo $value[fc];?>">show related files</a><BR />Total FVV: <?php echo count($value[logfile]);?>
<BR />View source ref:
<?php
	foreach($value[logfile] as $v)
	{
		echo '<BR>pinit/01/04/'.$v[fc].'/'.$v[fvvv].' [<A href="?op=files&fid='.$v[fid].'&fc='.$v[fc].'&fvv='.$v[fvvv].'">VIEW</a>] [<A href="?op=files&fid='.$v[fid].'&fc='.$v[fc].'&fvv='.$v[fvvv].'&code=1">SOURCE</a>] [<A href="?op=files&fid='.$v[fid].'&fc='.$v[fc].'&fvv='.$v[fvvv].'&download=1">DL</a>]<BR>(ver: '.$v[fver].') (size: '.$v[fsize].') (mod: '.$v[fby].')';
	}
?>
</td>
<td><?php echo $value[type];?></td>
<td><?php echo $value[size];?></td>
<td><?php echo date('l jS \of F Y h:i:s A', $value[lastmod]);?></td>
<td><?php echo $value[modname];?></td>
<td><?php echo $value[statuschk];?><br /><BR /><input type="radio" name="f<?php echo $value[fid];?>" value="2" <?php echo $value[statuseditcheckbox];?> /> Editing
<BR /><input type="radio" name="f<?php echo $value[fid];?>" value="5" <?php echo $value[statusidlecheckbox];?> /> HOLD/IDLE
<BR /><input type="radio" name="f<?php echo $value[fid];?>" value="3" <?php echo $value[statuscompletecheckbox];?> /> Complete version (Final)
<BR /><input type="radio" name="f<?php echo $value[fid];?>" value="1" <?php echo $value[statusfreecheckbox];?> /> FREE edit
<BR /><input type="radio" name="f<?php echo $value[fid];?>" value="4" <?php echo $value[statusbugcheckbox];?> /> Buggy/Error file
</td>
<td><select name="mod_by_<?php echo $value[fid];?>" id="select">
<option><?php echo $value[modname];?></option>
<option>-</option>
<option>Marhazk</option>
<option>Farid</option>
<option>Aidy</option>
<option>Zeny</option>
<option>Alif</option>
<option>Tan</option>
  </select></td>
<td>ref FC &amp; FVV : 
  pinit/01/04/<input name="fc<?php echo $value[fid];?>" type=text value="<?php echo $value[fc];?>" size="2" />/<input name="fvv<?php echo $value[fid];?>" type=text value="<?php echo $value[fvv];?>" size="5" /><br />ver : <input name="fver<?php echo $value[fid];?>" type=text value="<?php echo $value[fver];?>" size="2" /><BR /><textarea name="overview<?php echo $value[fid];?>" cols="35" rows="5"><?php echo $value[overview];?></textarea><BR />
<input type=submit name=opchk value="SAVE" /></td>
</tr>