<?php
require_once '../../scripts/functions.php';

$districts = getDistricts(1);

echo json_encode($districts);
