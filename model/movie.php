<?php
require_once '../config.php';
require_once '../providers/_2embed.php';
require_once '../providers/_cinemaos.php';
require_once '../providers/_vidsrc.php';

class Movie {

    private static function get_aggregated_movie($movie_id){
        $primary_provider = Config::PRIMARY_PROVIDER;
        $primary_provider = new $primary_provider();

        $response = $primary_provider->get_movie($movie_id);
        $movie = json_decode($response, true);
        
        if (isset($movie['error'])) {
            return null; // throw new Error('Movie not found in primary provider');
        }

        $embed_link = [];
        $embed_link[Config::PRIMARY_PROVIDER] = $movie['embed_imdb'];
        // Add embed links from other enabled providers
        
        $movie['embed_links'] = $embed_link;
        return json_encode($movie);
    }
    

    // Get enabled providers sorted 
    private static function get_enabled_providers() {
        $enabled_providers = array_filter(Config::PROVIDERS, function($config) {
            return $config['enabled'] === true; // Only include enabled providers (enabled: true)
        });     

        return $enabled_providers;
    }
}