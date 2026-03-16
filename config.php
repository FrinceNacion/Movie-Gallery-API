<?php
class Config {
    // Provider configuration
    const PROVIDERS = [
        '_2embed' => [
            'class' => '_2embed',
            'priority' => 1,
            'timeout' => 10, // seconds
            'enabled' => true
        ],
        '_cinemaos' => [
            'class' => '_cinemaos',
            'priority' => 2,
            'timeout' => 10,
            'enabled' => true
        ],
        '_vidsrc' => [
            'class' => '_vidsrc',
            'priority' => 3,
            'timeout' => 10,
            'enabled' => true
        ]
    ];

    // Quality ranking (higher number = better quality)
    const QUALITY_RANKING = [
        '4K' => 5,
        '2160p' => 5,
        '1440p' => 4,
        '1080p' => 4,
        '720p' => 3,
        'HD' => 3,
        '480p' => 2,
        '360p' => 1,
        'SD' => 1
    ];

    // Global settings
    const MAX_RETRIES = 2;
    const DEFAULT_TIMEOUT = 10;
}