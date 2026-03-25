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

$page = $_GET['page'] ?? 1;

$url = Show::get_trending_shows($page);
$shows = json_decode($url, true);

echo json_encode(['success' => true, 'type' => 'show', 'shows' => $shows]);