<?php
class Show {
    public static function get_aggregated_show($show_id){
        $primary_provider = Config::PRIMARY_PROVIDER[key(Config::PRIMARY_PROVIDER)]['class'];
        $primary_provider = new $primary_provider();
        $embed_links = [];
        $show = $primary_provider->get_show($show_id);

        $embed_links = self::get_embed_from_providers($show_id, $embed_links);

        unset($movie['embed_imdb']);
        unset($movie['embed_tmdb']);

        $show['embed_links'] = $embed_links;
        return json_encode($show);
    }

    public static function get_aggregated_episode_embed($show_id, $season_number = 1, $episode_number = 1) {
        $embed_links = [];
        $embed_links = self::get_embed_from_providers($show_id, $embed_links, $season_number, $episode_number);
        return json_encode($embed_links);
    }

    private static function get_embed_from_providers($movie_id, $embed_links, $season_number = 1, $episode_number = 1) {
        $enabled_providers = Config::get_enabled_providers();
    
        foreach ($enabled_providers as $provider_name => $provider_config) {
            try {
                $provider_class = new $provider_name();
                $embed_link = $provider_class->get_show_embed($show_id);

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