<?php
class Config {

    public const PRIMARY_PROVIDER = '_2embed';

    // Provider configuration
    public const PROVIDERS = [
        '_VidLink' => [
            'class' => '_VidLink',
            'priority' => 1,
            'path' => '../providers/_vidlink.php',
            'enabled' => true
        ],
        '_CinemaOS' => [
            'class' => '_CinemaOS',
            'priority' => 2,
            'path' => '../providers/_cinemaos.php',
            'enabled' => true
        ],
        '_VidSrc' => [
            'class' => '_VidSrc',
            'priority' => 3,
            'path' => '../providers/_vidsrc.php',
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

    // Get enabled providers sorted 
    public static function get_enabled_providers() {
        $enabled_providers = array_filter(self::PROVIDERS, function($config) {
            return $config['enabled'] === true; // Only include enabled providers (enabled: true)
        });     

        return $enabled_providers;
    }
}