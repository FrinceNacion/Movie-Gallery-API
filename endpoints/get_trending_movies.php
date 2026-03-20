<?php
require_once '../models/movie.php';
header('Content-Type: application/json');

// GET request only
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

$page = $_GET['page'] ?? 1;

$url = Movie::get_trending_movies($page);
$movies = json_decode($url, true);

echo json_encode(['success' => true, 'movies' => $movies]);