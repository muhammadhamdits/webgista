<?php
	$host = "localhost";
	$user = "postgres";
	$pass = "320819";
	$port = "5432";
	$dbname = "tugas";
	$connectionstring = "host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$pass;
	var_dump($connectionstring);
	die();
	$conn = pg_connect($connectionstring) or die("Gagal");
?>