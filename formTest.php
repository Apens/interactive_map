<?php
require_once 'backend/scripts/functions.php';

if ($_POST){
    var_dump($_POST);
    extract($_POST);


//    var_dump($email, $password, $username);
//    userLogin($email, $password);

    createUser($username, $email, $password);
//    createUser($_POST['username'],$_POST['email'], $_POST['password']);
// equivault a l'assertion ci dessus si on n'utilise pas extract()


//    createDistrict($name, $lat, $lng, $parent_city); fonctionne
}
//var_dump($_SESSION);
//$city = readCity(1); fonctionne
//var_dump($city, json_encode($city));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="./assets/js/main.js" defer></script>
</head>
<body>
form test

<form action="formTest.php" method="post">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="text" name="email">
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
    </div>

    <input type="submit">

<!--<form action="formTest.php" method="post">-->
<!--    <div>-->
<!--        <label for="email">Email</label>-->
<!--        <input type="text" name="email">-->
<!--    </div>-->
<!--    <div>-->
<!--        <label for="password">Mot de passe</label>-->
<!--        <input type="text" name="password">-->
<!--    </div>-->
<!--    <input type="submit">-->
<!--</form>-->
</form>
</body>
</html>