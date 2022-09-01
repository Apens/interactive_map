<?php
require '../scripts/functions.php';

$tables = [
'CREATE TABLE user(
id        INT(10) AUTO_INCREMENT NOT NULL,

PRIMARY KEY(id)
);',
'CREATE TABLE category(
id        INT(10) AUTO_INCREMENT NOT NULL,

PRIMARY KEY(id)
);',
'CREATE TABLE city(
id        INT(10) AUTO_INCREMENT NOT NULL,

PRIMARY KEY(id)
);',
'CREATE TABLE review(
id        INT(10) AUTO_INCREMENT NOT NULL,

PRIMARY KEY(id)
);',
'CREATE TABLE place(
id        INT(10) AUTO_INCREMENT NOT NULL,

PRIMARY KEY(id)
)'
];

try{
foreach ($tables as $table) {
global $conn;
$conn->exec($table);
}
}catch (PDOException $e){
echo $e->getMessage();
}