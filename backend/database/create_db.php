<?php
include "../scripts/functions.php";

$sql = 'CREATE DATABASE decodeuses';

try{
    global $conn;
    $conn->exec($sql);
}
catch (PDOException $e)
{
    echo $sql."<br>".$e->getMessage();
}