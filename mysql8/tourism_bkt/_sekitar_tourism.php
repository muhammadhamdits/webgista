<?php
	include('../connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['lng'];
	$rad=$_GET['rad'];
    
    $lt = array();
    $lati = array();
    $long = array();
    $ln = array();
    $id = array();
    $name = array();
    $jarak = array();

    $query = "SELECT id, name, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat FROM tourism";
    $h=mysqli_query($conn, $query);
    
    // var_dump($h);
    // die();
    
    while($d = mysqli_fetch_assoc($h)){
        $id[]   = $d['id'];
        $name[] = $d['name'];
        $lt[]   = $d['lat'];
        $ln[]   = $d['lng'];
    }
    $i=0;
    foreach($lt as $lats){
        $longs = $ln[$i];
        
        $q = "SELECT st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326), ST_GeomFromText('POINT($lats $longs)', 4326)) as jarak FROM tourism";
        $hasil=mysqli_query($conn, $q);
        $data = mysqli_fetch_array($hasil);
        $jarak[] = $data['jarak'];
        $i++;
    }
    $i=0;
    foreach($ln as $longs){
        $id1     = $id[$i];
        $name1   = $name[$i];
        $jarak1  = $jarak[$i];
        $lat1    = $lt[$i];
        $lng1    = $ln[$i];
        if($jarak1 <= $rad){
            $dataarray[]=array('id'=>$id1,'name'=>$name1,'jarak'=>$jarak1, "lat"=>$lat1,"lng"=>$lng1);
        }
        $i++;
    }
    echo json_encode ($dataarray);
?>