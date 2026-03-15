<?php
header('Content-Type: application/json');

// GET request only
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

$page = $_GET['page'] ?? 1;

require_once './providers/_2embed.php';
$url = _2embed::get_trending_movies($page);
$movie = json_decode(file_get_contents($url), true);

echo json_encode(['success' => true, 'movies' => $movie]);