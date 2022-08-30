<?php
require_once 'backend/scripts/functions.php';

if ($_POST){
    var_dump($_POST);
    extract($_POST);

//    var_dump();
    createDistrict($name, $lat, $lng, $parent_city);
}

$city = readCity(1);

var_dump($city, json_encode($city));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
form test

<form action="formTest.php" method="post">
    <div>
        <label for="name">arrondissment</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="lat">lat de la ville</label>
        <input type="number" step="any" name="lat">
    </div>
    <div>
        <label for="lng">long de la ville</label>
        <input type="number" step="any" name="lng">
    </div>
    <div>
        <label for="parent_city">nom de la ville</label>
        <input type="number" name="parent_city">
    </div>

    <input type="submit">
</form>
</body>
</html>