<?php

use config\Database;
use objects\Users;

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

include_once "./config/Database.php";
include_once "./objects/Users.php";

// Получаем "сырые" данные POST-запроса
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->firstName) &&
    !empty($data->lastName)
) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new Users($db);
    $user->firstName = $data->firstName;
    $user->lastName = $data->lastName;

    if ($user->create()) {
        http_response_code(201);
        echo json_encode(["message" => "Пользователь успешно создан"], JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Невозможно создать пользователя"], JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Неполные данные"], JSON_UNESCAPED_UNICODE);
}
