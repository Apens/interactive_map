<?php
include "../scripts/bd_login_info.php";

$sql = 'CREATE DATABASE decodeuses';

try{
    $conn = new PDO("mysql:host=$host", $user, $pass, $opts);
    $conn->exec($sql);
}
catch (PDOException $e)
{
    echo $sql."<br>".$e->getMessage();
}