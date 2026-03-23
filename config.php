<?php
class Config {

    public const PRIMARY_PROVIDER = ['_2embed' => [
        'class' => '_2embed',
        'path' => '../providers/_2embed.php'
    ]];

    public const ACCESS_CONTROL_ALLOW_ORIGIN = '*'; // For testing, allow all origins

    // Provider configuration
    public const PROVIDERS = [
        '_2embed' => [
            'class' => '_2embed',
            'path' => '../providers/_2embed.php',
            'enabled' => true
        ],
        '_VidLink' => [
            'class' => '_VidLink',
            'path' => '../providers/_vidlink.php',
            'enabled' => true
        ],
        '_CinemaOS' => [
            'class' => '_CinemaOS',
            'path' => '../providers/_cinemaos.php',
            'enabled' => true
        ],
        '_VidSrc' => [
            'class' => '_VidSrc',
            'path' => '../providers/_vidsrc.php',
            'enabled' => true
        ]
    ];

    // Get enabled providers sorted 
    public static function get_enabled_providers() {
        $enabled_providers = array_filter(self::PROVIDERS, function($config) {
            return $config['enabled'] === true; // Only include enabled providers (enabled: true)
        });     

        return $enabled_providers;
    }

    public static function load_enabled_providers() {
        $enabled_providers = self::get_enabled_providers();
        
        foreach ($enabled_providers as $provider_name => $provider_config) {         
            // Validate that the path exists in config
            if (!isset($provider_config['path'])) {
                trigger_error("Provider '{$provider_name}' is missing 'path' in configuration", E_USER_WARNING);
                continue;
            }
            
            $filePath = $provider_config['path'];
            
            // Check if file exists before requiring
            if (!file_exists($filePath)) {
                trigger_error("Provider file not found: {$filePath}", E_USER_WARNING);
                continue;
            }
            
            // Require the provider file
            require_once($filePath);
        }
        require_once self::PRIMARY_PROVIDER[key(self::PRIMARY_PROVIDER)]['path'];
    }
}