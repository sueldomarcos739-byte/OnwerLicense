<?php

header("Content-Type: application/json");

// Cargar archivo JSON con licencias
$licenseData = json_decode(file_get_contents("licenses.json"), true);

$userId = $_GET["userId"] ?? null;

if ($userId === null) {
    echo json_encode(["status" => "error", "message" => "Missing userId"]);
    exit;
}

$found = false;

foreach ($licenseData["licenses"] as $license) {
    if ($license["userId"] == $userId) {
        $found = true;
        if ($license["active"] == true) {
            echo json_encode(["status" => "success", "message" => "License valid"]);
        } else {
            echo json_encode(["status" => "inactive", "message" => "License inactive"]);
        }
        break;
    }
}

if (!$found) {
    echo json_encode(["status" => "error", "message" => "License not found"]);
}

?>
