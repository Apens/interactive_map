<?php
include '../../scripts/functions.php';
header('Content-Type: application/json');
$content = json_decode(stripslashes(file_get_contents('php://input')),true);
extract($content);
//var_dump($name,$type,$lat, $lng, $city_id);
createPlace($name, $address, $type, $lat, $lng, null, $city_id, 1 );

echo json_encode(['name'=> $name, 'address'=>$address ,'type'=>$type, 'lat'=>$lat, 'lng'=>$lng, 'city_id'=>$city_id])
?>