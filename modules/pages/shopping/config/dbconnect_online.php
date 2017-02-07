<?php
$server = "mysql6.000webhost.com";
     $namauser = "a1375393_mycaps";
      $passuser = "mycaps0"; 
      $db = "a1375393_mycaps";
      $con = mysql_connect($server, $namauser, $passuser)
                  or die("Tidak dapat membuat sambungan ke pangkalan data");
  	  mysql_select_db($db,$con);

?>