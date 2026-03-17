<?php
class _Vidsrc {
    /** Uses TMDB or IMDB ID for movie ID
     * Returns only the URL for the movie player
     */
    static function get_movie_embed($movie_id) {
        $url = 'https://vidsrc-embed.ru/embed/movie/%s';
        return sprintf($url, $movie_id);
    }

    /*
    * Returns a json file response with the latest movies by page
    * result[] - array of latest movies
    */
    static function get_latest_movies($page = 1) {
        $url = 'https://vidsrc-embed.ru/movies/latest/page-%d.json';
        return sprintf($url, $page);
    }

    /** 
    * static function get_trending_movies($page = 1) {}
    * static function get_similar_movies($movie_id, $page = 1) {}
    * - does not exist in the API documentation
    */
}
