<?php

//Conexion a Integral Works
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "dbs5873766";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

  /*if (!$conn) {
		echo "<p>Could not connect to the server '" . $hostname . "'</p>\n";
 	echo mysql_error();
	}else{
		echo "<p>Successfully connected to the server '" . $hostname . "'</p>\n";
	}*/
