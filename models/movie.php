<?php
require_once '../config.php';
require_once '../providers/_2embed.php';
require_once '../providers/_cinemaos.php';
require_once '../providers/_vidsrc.php';

class Movie {

    public static function get_aggregated_movie($movie_id){
        $primary_provider = Config::PRIMARY_PROVIDER;
        $primary_provider = new $primary_provider();
        $embed_links = [];

        $response = $primary_provider->get_movie($movie_id);
        if (empty($response) || !is_string($response)) {
            throw new Error('Primary provider returned an invalid response');
        }

        $movie_json = @file_get_contents($response); // returns false on failure, suppress warnings with @
        if ($movie_json === false) {
            throw new Error('Failed to fetch movie data from primary provider');
        }

        $movie = json_decode($movie_json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Error('Invalid JSON from primary provider: ' . json_last_error_msg());
        }

        if (isset($movie['error'])) {
            throw new Error('Movie not found in primary provider');
        }

        // Extract primary embed link and then get from other providers
        $embed_links[Config::PRIMARY_PROVIDER] = $movie['embed_imdb'] ?? null;
        $embed_links[Config::PRIMARY_PROVIDER . '(2)'] = $movie['embed_tmdb'] ?? null;
        $embed_links = self::get_embed_from_providers($movie_id, $embed_links);

        // unset primary embed links to avoid confusion
        unset($movie['embed_imdb']);
        unset($movie['embed_tmdb']);

        $movie['embed_links'] = $embed_links;
        return json_encode($movie);
    }

    private static function get_embed_from_providers($movie_id, $embed_links) {
        $enabled_providers = self::get_enabled_providers();
    
        foreach ($enabled_providers as $provider_name => $provider_config) {
            try {
                $provider_class = new $provider_name();
                $embed_link = $provider_class->get_movie_embed($movie_id);

                if (isset($embed_link)) {
                    $embed_links[$provider_name] = $embed_link;
                }
            } catch (Throwable $e) {
                continue;
            }
        }

        return $embed_links;
    }
    

    // Get enabled providers sorted 
    private static function get_enabled_providers() {
        $enabled_providers = array_filter(Config::PROVIDERS, function($config) {
            return $config['enabled'] === true; // Only include enabled providers (enabled: true)
        });     

        return $enabled_providers;
    }
}