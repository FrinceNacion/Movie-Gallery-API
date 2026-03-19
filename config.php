<?php
class Config {

    public const PRIMARY_PROVIDER ='_2embed';

    // Provider configuration
    public const PROVIDERS = [
        '_VidLink' => [
            'class' => '_VidLink',
            'priority' => 1,
            'timeout' => 10, // seconds, need to implement timeout handling in provider classes
            'enabled' => true
        ],
        '_CinemaOS' => [
            'class' => '_CinemaOS',
            'priority' => 2,
            'timeout' => 10,
            'enabled' => true
        ],
        '_VidSrc' => [
            'class' => '_VidSrc',
            'priority' => 3,
            'timeout' => 10,
            'enabled' => true
        ]
    ];

    // Quality ranking (higher number = better quality)
    public const QUALITY_RANKING = [
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
    public const MAX_RETRIES = 2;
    public const DEFAULT_TIMEOUT = 10;
}