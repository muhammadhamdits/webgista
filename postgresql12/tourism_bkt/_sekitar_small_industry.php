<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $lng = $_GET['lng'];
	$rad=$_GET['rad'];

    // $querysearch="SELECT id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$lng." ".$latit.")',-1), small_industry.geom) as jarak FROM small_industry where st_distance_sphere(ST_GeomFromText('POINT(".$lng." ".$latit.")',-1), small_industry.geom) <= ".$rad.""; 
    
    $querysearch = "SELECT id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),small_industry.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) As jarak FROM small_industry WHERE round(CAST(ST_DistanceSpheroid(ST_GeomFromText('POINT($longi $latit)'),small_industry.geom,'SPHEROID[\"WGS 84\",6378137,298.257223563]')As numeric),2) <= $rad";

	$hasil=pg_query($querysearch);
        while($baris = pg_fetch_array($hasil))
            {
                $id=$baris['id'];
                $name=$baris['name'];
                $jarak=$baris['jarak'];
                $lat=$baris['lat'];
                $lng=$baris['lng'];
                $dataarray[]=array('id'=>$id, 'name'=>$name,'jarak'=>$jarak, "lat"=>$lat,"lng"=>$lng);
            }
            echo json_encode ($dataarray);
?>