<?php
require_once '../models/show.php';
header("Access-Control-Allow-Origin: " . Config::ACCESS_CONTROL_ALLOW_ORIGIN);
header("Access-Control-Allow-Methods: GET");
header('Content-Type: application/json');

// GET request only
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$show_id = $_GET['id'] ?? null;

if (!$show_id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Show ID is required']);
    exit();
}

$url = Show::get_aggregated_show($show_id);
$show = json_decode($url, true);

echo json_encode(['success' => true, 'show' => $show]);