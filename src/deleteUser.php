<?php

use config\Database;
use objects\Users;

header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");

include_once "./config/Database.php";
include_once "./objects/Users.php";

// Получаем ID пользователя (например, из URL: ?id=1)
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(["message" => "Некорректный ID"], JSON_UNESCAPED_UNICODE);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$user = new Users($db);

if ($user->delete($id)) {
    http_response_code(200);
    echo json_encode(["message" => "Пользователь удалён"], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Пользователь не найден или не удалён"], JSON_UNESCAPED_UNICODE);
}