<?php

include '../scripts/functions.php';
header('Content-Type: application/json');
$content = json_decode(stripslashes(file_get_contents('php://input')), true);

extract($content);

//var_dump($name, $address, $type, $lat);

$response = userLogin($email, $password);

echo json_encode(['response'=>$response]);


