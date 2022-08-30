<?php
require_once '../../scripts/functions.php';

$city = readCity($_POST['cityId']);

echo json_encode($city);