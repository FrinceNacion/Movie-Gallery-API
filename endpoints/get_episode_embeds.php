<?php
require_once '../models/show.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

$show_id = $_GET['id'] ?? null;
$season_number = $_GET['season'] ?? 1;
$episode_number = $_GET['episode'] ?? 1;

$url = Show::get_aggregated_episode_embed($show_id, $season_number, $episode_number);
$episode = json_decode($url, true);

echo json_encode(['success' => true, 'embed_links' => $episode]);