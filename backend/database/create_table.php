<?php
require '../scripts/functions.php';

$tables = [
'CREATE TABLE user(
id        INT(10) AUTO_INCREMENT NOT NULL,
username  VARCHAR(255) NULL,
email     VARCHAR(255) NOT NULL,
password  VARCHAR (255) NOT NULL,
role      VARCHAR (45) DEFAULT NULL,

UNIQUE KEY email_UNIQUE (email)
PRIMARY KEY(id)
);',
'CREATE TABLE category(
id        INT(10) AUTO_INCREMENT NOT NULL,
name      VARCHAR(255) NULL,

PRIMARY KEY(id)
);',
'CREATE TABLE city(
id        INT(10) AUTO_INCREMENT NOT NULL,
name      varchar(100) DEFAULT NULL,
lat       decimal(10,8) DEFAULT NULL,
lng       decimal(11,8) DEFAULT NULL,
city_id   int DEFAULT NULL,

PRIMARY KEY(id)
KEY fk_city_city1_idx (city_id)
);',
'CREATE TABLE review(
id        INT(10) AUTO_INCREMENT NOT NULL,
content  text,
publish_at datetime DEFAULT NULL,
user_id  int NOT NULL,
place_id int NOT NULL,

FOREIGN KEY (user_id) REFERENCES user(user)

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