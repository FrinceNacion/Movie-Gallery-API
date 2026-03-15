<?php
require_once 'providers/_2embed.php';
header('Content-Type: application/json');

// GET request only
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}
$movie_id = $_GET['id'] ?? null;

if (!$movie_id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Movie ID is required']);
    exit();
}

$url = _2embed::get_movie($movie_id);
$movie = json_decode(file_get_contents($url), true);

echo json_encode(['success' => true, 'movie' => $movie]);