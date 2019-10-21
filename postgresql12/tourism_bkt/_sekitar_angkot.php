<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['long'];
	$rad=$_GET['rad'];

    // $querysearch="SELECT id, route_color, destination, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 
    
    $querysearch = "SELECT id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),angkot.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) As jarak FROM angkot WHERE round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),angkot.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) <= $rad";

	$hasil=pg_query($querysearch);

    while($baris = pg_fetch_array($hasil)){
        $id=$baris['id'];
        $route_color=$baris['route_color'];
        $destination=$baris['destination'];
        $dataarray[]=array('id'=>$id,'route_color'=>$route_color,'destination'=>$destination);
    }
    echo json_encode ($dataarray);
?>