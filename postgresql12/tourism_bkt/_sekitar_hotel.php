<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['lng'];
	$rad=$_GET['rad'];

    // $querysearch="SELECT id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), hotel.geom) as jarak FROM hotel where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), hotel.geom) <= ".$rad."";

    $querysearch = "SELECT id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),hotel.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) As jarak FROM hotel WHERE round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),hotel.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) <= $rad";

    // var_dump($querysearch);
    // die();

	$hasil=pg_query($querysearch);

        while($baris = pg_fetch_array($hasil))
            {
                $id=$baris['id'];
                $name=$baris['name'];
                $jarak=$baris['jarak']; 
                $lat=$baris['lat'];
                $lng=$baris['lng'];
                $dataarray[]=array('id'=>$id,'name'=>$name, 'jarak'=>$jarak,'lng'=>$lng,'lat'=>$lat);
            }
            echo json_encode ($dataarray);
?>