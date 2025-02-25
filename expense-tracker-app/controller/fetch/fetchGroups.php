<?php
session_start();
use Core\Database\App;

header('Content-Type: application/json');

$db = App::resolve('Core\Database\Database');

try {
    // Fetch all groups
    $groups = $db->query("SELECT * FROM `groups` ORDER BY id DESC")->findAll();

    echo json_encode([
        "success" => true,
        "groups" => $groups
    ]);
    exit;
} catch (\Exception $e) {
    error_log("Error fetching groups: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "An error occurred while fetching groups."
    ]);
    exit;
}
