<?php
include ('../../../connect.php');
$id = $_POST['id_hotel'];
$query = pg_query("SELECT MAX(id) AS id FROM room");
$result = pg_fetch_array($query);
$idmax = $result['id'];
if ($idmax==null) {$idmax=1;}
else {$idmax++;}
$idmax2 = $idmax;
$room = $_POST['room'];
$price = $_POST['roomprice'];

$count = count($room);
$sql  = "insert into room (id, name, price) VALUES ";
 
for( $i=0; $i < $count; $i++ ){
	$sql .= "('{$idmax}','{$room[$i]}','{$price[$i]}')";
	$sql .= ",";
	$idmax++;
}
$sql = rtrim($sql,",");
$insert = pg_query($sql);

$sql2 = "insert into detail_room (id_room, id_hotel) VALUES ";
for( $x=0; $x< $count; $x++ ){
	$sql2 .= "('{$idmax2}','{$id}')";
	$sql2 .= ",";
	$idmax2++;
}
$sql2 = rtrim($sql2,",");
$insert2 = pg_query($sql2);


if ($sql && $sql2){
		echo "<script>
		alert (' Data Successfully Added');
		eval(\"parent.location='../index.php?page=formsetR&id=$id '\");	
		</script>";
}else{
	echo 'error';
}


?>