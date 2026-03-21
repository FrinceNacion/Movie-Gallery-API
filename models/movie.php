<?php
require_once '../config.php';
Config::load_enabled_providers();

class Movie {

    public static function get_aggregated_movie($movie_id){
        $primary_provider = Config::PRIMARY_PROVIDER[key(Config::PRIMARY_PROVIDER)]['class'];
        $primary_provider = new $primary_provider();
        $embed_links = [];
        $movie = $primary_provider->get_movie($movie_id);

        // Extract primary embed link and then get from other providers
        $embed_links = self::get_embed_from_providers($movie_id, $embed_links);

        // unset primary embed links to avoid confusion
        unset($movie['embed_imdb']);
        unset($movie['embed_tmdb']);

        $movie['embed_links'] = $embed_links;
        return json_encode($movie);
    }

    public static function get_trending_movies($page = 1) {
        $primary_provider = Config::PRIMARY_PROVIDER[key(Config::PRIMARY_PROVIDER)]['class'];
        $primary_provider = new $primary_provider();
        $trending_movies = $primary_provider->get_trending_movies($page);
        return json_encode($trending_movies);
    }

    private static function get_embed_from_providers($movie_id, $embed_links) {
        $enabled_providers = Config::get_enabled_providers();
    
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
}