<?php

use config\Database;
use objects\Users;

header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");

include_once "./config/Database.php";
include_once "./objects/Users.php";

// Получаем «сырой» JSON из тела запроса
$data = json_decode(file_get_contents("php://input"));

// Проверка на минимальный набор данных
if (
    !empty($data->id) &&
    !empty($data->firstName) &&
    !empty($data->lastName)
) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new Users($db);
    $user->id = $data->id;
    $user->firstName = $data->firstName;
    $user->lastName = $data->lastName;

    if ($user->update()) {
        http_response_code(200);
        echo json_encode(["message" => "Пользователь обновлён"], JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Не удалось обновить пользователя"], JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Неполные данные"], JSON_UNESCAPED_UNICODE);
}

