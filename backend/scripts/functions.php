<?php
include 'bd_login_info.php';
session_start();

try {
    $conn= new PDO($attr,$user,$pass,$opts);
}
catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

function queryMysql($query){
    global $conn;
    return $conn->query($query);
}

//Crud des tables
/* User */
function createUser($username, $email, $password, $role= null){
    global $conn;
    $users = getUsers();
    if ($users == null){
        $role = "ADMIN";
    } else {
        $role = "USER";
    }
    var_dump($role);
    $reqSql = "INSERT INTO user(username, email, password, role ) 
                VALUE(:username, :email, :password, :role )";
    $statement = $conn->prepare($reqSql);
    $statement->execute([
        ':email' => $email,
        ':username' => $username,
        ':password' => $password,
        ':role'=> $role
    ]);

}

function getUsers(){
    $reqSql = "SELECT * FROM user";
    return queryMysql($reqSql)->fetchAll();
}

function readUser($email, $password){
    $reqSql = "SELECT * FROM user WHERE email ='$email' AND password='$password'";
    $user = queryMysql($reqSql);
    return queryMysql($reqSql);

}

function userLogin($email, $password){
   $user = readUser($email, $password);

   if ($user->rowCount() == 0){
//       var_dump('bug');
        return ["error"=>"Utilisateur ou mot de passe invalide"];
   } else {
        $userData = $user->fetch();
//        var_dump($userData);

        $_SESSION['user'] = [
            'id'       => $userData['id'],
            'username' => $userData['username'],
            'email'    => $userData['email'],
            'role'     => $userData['role']
        ];

        return [
            "status_code" => 200,
            "user" => [
                'id'       => $userData['id'],
                'username' => $userData['username'],
                'email'    => $userData['email'],
                'role'     => $userData['role']
                ]
            ];
   }

}

function updateUser($userID, $email, $password, $role){
    $reqSql ="UPDATE user SET username='$email', password='$password', role='$role' WHERE id='$userID'";
    queryMysql($reqSql);
}

function deleteUser($userId){
    $reqSql = "DELETE FROM user WHERE id='$userId'";
    queryMysql($reqSql);
}

/* Category */


function createCategory($name){
    global $conn;
    $reqSql ="INSERT INTO category(name) VALUE(:name)";
    $statement = $conn->prepare($reqSql);
    $statement->execute([
        ':name'=> $name
    ]);
}

function readCategory($categoryId){
    $reqSql = "SELECT * FROM category WHERE id='$categoryId'";
     return queryMysql($reqSql);
}

function updateCategory($name, $categoryId){
    $reqSql ="UPDATE category SET name='$name' WHERE id='$categoryId'";
    queryMysql($reqSql);
}

function deleteCategory($categoryId){
    $reqSql = "DELETE FROM category WHERE id='$categoryId'";
    queryMysql($reqSql);
}

/* city */
function createCity($name, $lat, $lng){
    global $conn;
    $reqSql ="INSERT INTO city(name, lat, lng) VALUE(:name, :lat, :lng)";
    $statement = $conn->prepare($reqSql);
    $statement->execute([
        ':name'=> $name,
        ':lat'=> $lat,
        ':lng'=> $lng,
    ]);

}

function readCity($cityId){
    $reqSql = "SELECT * FROM city WHERE id='$cityId'";
    $city= queryMysql($reqSql);
    return $city->fetch();
}

function updateCity($name, $lat, $lng, $cityId){
    $reqSql ="UPDATE city SET name='$name', lat='$lat', lng='$lng' WHERE id='$cityId'";
    queryMysql($reqSql);
}

function deleteCity($cityId){
    $reqSql = "DELETE FROM city WHERE id='$cityId'";
    queryMysql($reqSql);
}

/* district */
function createDistrict($name, $lat, $lng, $parentCityId){
    global $conn;
    $reqSql ="INSERT INTO city(name, lat, lng, city_id) VALUE(:name, :lat, :lng, :city_id)";
    $statement = $conn->prepare($reqSql);
    $statement->execute([
        ':name'=> $name,
        ':lat'=> $lat,
        ':lng'=> $lng,
        ':city_id'=> $parentCityId,
    ]);

}

function getDistricts($parentCity){
    $reqSql = "SELECT * FROM city WHERE city_id='$parentCity'";
    return queryMysql($reqSql)->fetchAll();
}

function readDistrict($districtId){
    $reqSql = "SELECT * FROM city WHERE id='$districtId'";
    return queryMysql($reqSql);
}

function updateDistrict($name, $lat, $lng, $parentCityId, $districtId){
    $reqSql ="UPDATE city SET name='$name', lat='$lat', lng='$lng', city_id='$parentCityId' WHERE id='$districtId'";
    queryMysql($reqSql);
}

function deleteDistrict($districtId){
    $reqSql = "DELETE FROM city WHERE id='$districtId'";
    queryMysql($reqSql);
}

/* Place */


function createPlace($name, $address, $type, $lat, $lng, $img, $parentCityId, $category_id){
    global $conn;
    $reqSql ="INSERT INTO place(name, address, type, lat, lng, img, city_id, category_id) 
                VALUE(:name, :address, :type, :lat, :lng, :img, :city_id, :category_id)";
    $statement = $conn->prepare($reqSql);
    $statement->execute([
        ':name'=> $name,
        ':address'=> $address,
        ':type'=> $type,
        ':lat'=> $lat,
        ':lng'=> $lng,
        ':img'=> $img,
        ':city_id'=> $parentCityId,
        ':category_id'=> $category_id,
    ]);
}

function readPlace($placeId){
    $reqSql = "SELECT * FROM place WHERE id='$placeId'";
    return queryMysql($reqSql);
}

function updatePlace($name, $address,$lat, $lng, $img, $parentCityId, $category_id, $placeId){
    $reqSql ="UPDATE place SET name='$name', address='$address', lat='$lat', lng='$lng', img='$img', city_id='$parentCityId', category_id='$category_id' WHERE id='$placeId'";
    queryMysql($reqSql);
}

function deletePlace($placeId){
    $reqSql = "DELETE FROM place WHERE id='$placeId'";
    queryMysql($reqSql);
}


