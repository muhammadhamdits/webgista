<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['lng'];
	$rad=$_GET['rad'];

    // $querysearch="SELECT id, name, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM restaurant  where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 
    
    $querysearch = "SELECT id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),restaurant.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) As jarak FROM restaurant WHERE round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),restaurant.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) <= $rad";

	$hasil=pg_query($querysearch);

        while($baris = pg_fetch_array($hasil))
            {
                $id=$baris['id'];
                $name=$baris['name'];
                $jarak=$baris['jarak'];
                $lat=$baris['lat'];
                $lng=$baris['lng'];
                $dataarray[]=array('id'=>$id,'name'=>$name,'jarak'=>$jarak, "lat"=>$lat,"lng"=>$lng);
            }
            echo json_encode ($dataarray);
?>