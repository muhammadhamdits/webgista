<?php
	$host = "localhost";
	$user = "postgres";
	$pass = "320819";
	$port = "5433";
	$dbname = "tugas";
	$conn = pg_connect("host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$pass) or die("Gagal");
?>