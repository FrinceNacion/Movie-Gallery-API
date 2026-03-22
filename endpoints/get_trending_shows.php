<?php
require_once '../models/show.php';
header('Content-Type: application/json');

// GET request only
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Implement get_trending_shows in the Show model to fetch trending shows from the primary provider