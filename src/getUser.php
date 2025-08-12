<?php

use config\Database;
use objects\Users;

header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

include_once "./config/Database.php";
include_once "./objects/Users.php";


// Получаем id из параметра запроса (?id=1)
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$database = new Database();
$db = $database->getConnection();

$users = new Users($db);
$userData = $users->getOne($id);

if ($userData) {
    http_response_code(200);
    echo json_encode($userData, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Пользователь не найден"], JSON_UNESCAPED_UNICODE);
}
