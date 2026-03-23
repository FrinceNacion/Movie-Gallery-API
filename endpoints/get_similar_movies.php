<?php
require_once '../models/movie.php';
header("Access-Control-Allow-Origin: " . Config::ACCESS_CONTROL_ALLOW_ORIGIN);
header("Access-Control-Allow-Methods: GET");
header('Content-Type: application/json');

// GET request only
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

$movie_id = $_GET['id'] ?? null;
$page = $_GET['page'] ?? 1;

if (!$movie_id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Movie ID is required']);
    exit();
}

$url = Movie::get_similar_movies($movie_id, $page);
$movie = json_decode($url, true);

echo json_encode(['success' => true, 'movies' => $movie]);