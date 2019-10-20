<?php
	$host = "3.83.118.140";
	$user = "postgres";
	$pass = "320819";
	$port = "5432";
	$dbname = "tugas";
	$connectionstring = "host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$pass;
	$conn = pg_connect($connectionstring) or die("Gagal");
	var_dump($conn);
	die();
?>