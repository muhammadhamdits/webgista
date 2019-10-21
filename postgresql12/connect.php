<?php
	$host = "localhost";
	$user = "postgres";
	$pass = "320819";
	$port = "5432";
	$dbname = "tugas";
	$conn = pg_connect("host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$pass) or die("Gagal");
?>