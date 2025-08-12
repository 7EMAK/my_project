<?php

use config\Database;
use objects\Users;

header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

include_once "./config/Database.php";
include_once "./objects/Users.php";

$database = new Database();
$db = $database->getConnection();

$users = new Users($db);

$stmt = $users->getAll();
$num = $stmt->rowCount();

if ($num) {
    $usersArr = array();
    $usersArr['users'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $users_item = array(
            "firstName" => $first_name,
            "lastName" => $last_name,
        );
        array_push($usersArr['users'], $users_item);
    }

    http_response_code(200);

    echo json_encode($usersArr, JSON_UNESCAPED_UNICODE);
}

else {
    http_response_code(404);

    echo json_encode(array("message" => "No users found."), JSON_UNESCAPED_UNICODE);
}
