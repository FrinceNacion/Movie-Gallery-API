<?php
class VidLink{

    // Might only work with TMDB ID, 
    // IMDB ID might not work, need to test
    public function get_movie_embed($movie_id) {
        $url = 'https://vidlink.pro/movie/%s';
        return sprintf($url, $movie_id);
    }

    /** 
    * static function get_trending_movies($page = 1) {}
    * static function get_similar_movies($movie_id, $page = 1) {}
    * - does not exist in the API documentation
    */
}