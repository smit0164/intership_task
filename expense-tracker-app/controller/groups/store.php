<?php


use Core\Validator;
use Core\Database\App;

header('Content-Type: application/json');

$groupName=isset($_POST['groupName'])? trim($_POST['groupName']): '';

if (!Validator::string($groupName)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "error" => "Group name is required!"
    ]);
    exit;
}

$db = App::resolve('Core\Database\Database');

try {
    $result = $db->query("INSERT INTO `groups` (groupName) VALUES (:groupName)", [
        'groupName' => $groupName,
    ]);

    if (!$result) {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "error" => "Failed to create group. Please try again later."
        ]);
        exit;
    }

    echo json_encode([
        "success" => true,
        "message" => "Group created successfully!",
    ]);
    exit;
} catch (\Exception $e) {
    error_log("Error creating group: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "An error occurred. Please try again later."
    ]);
    exit;
}
