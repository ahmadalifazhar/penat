<?php

//membuat sambungan ke database mysql
     $server = "localhost";
     $namauser = "root";
      $passuser = ""; 
      $db = "shopping";
      $con = mysql_connect($server, $namauser, $passuser)
                  or die("Cannot Connect To Database!");
  	  mysql_select_db($db,$con);
	  
	  ?>