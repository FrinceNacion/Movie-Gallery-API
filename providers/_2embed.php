<?php
class _2embed {
    /**
     * Helper method to fetch and validate JSON from API
     * $url The API endpoint URL
     * $type Resource type for error messages (e.g., 'movie', 'show')
     * Returns a decoded JSON response
     * @throws Error
     */
    static function fetch_and_validate($url, $type = 'data') {
        $json = @file_get_contents($url); // returns false on failure, suppress warnings with @
        if ($json === false) {
            throw new Error("Failed to fetch {$type} data from primary provider");
        }

        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Error('Invalid JSON from primary provider: ' . json_last_error_msg());
        }

        if (isset($data['error'])) {
            throw new Error(ucfirst($type) . ' not found in primary provider');
        }

        return $data;
    }

    /** Uses TMDB or IMDB ID for movie ID
     * Returns a json response with the movie details and the streaming links (embed)
     */
    static function get_movie($movie_id) {
        $url = sprintf('https://api.2embed.cc/movie?imdb_id=%s', $movie_id);
        return self::fetch_and_validate($url, 'movie');
    }

    // Returns only the embed URL of the movie
    static function get_movie_embed($movie_id) {
        $url = 'https://www.2embed.cc/embed/%s';
        return sprintf($url, $movie_id);
    }

    /**
     * Returns a json response with the trending movies by page (20 movies per page)
     * page - page number (default: 1)
     * results[] - array of movies
     */
    static function get_trending_movies($page = 1) {
        $url = sprintf('https://api.2embed.cc/trending?page=%d', $page);
        return self::fetch_and_validate($url, 'trending movies');
    }

    /**
     * Returns a json response with similar movies by page (20 movies per page)
     * movie_id - the IMDB/TMDB ID of the movie to find similar movies for
     * page - page number (default: 1)
     * results[] - array of similar movies
     */
    static function get_similar_movies($movie_id, $page = 1) {
        $url = sprintf('https://api.2embed.cc/similar?imdb_id=%s&page=%d', $movie_id, $page);
        return self::fetch_and_validate($url, 'similar movies');
    }

    // Returns a json response with the show details
    static function get_show($show_id){
        $url = sprintf('https://api.2embed.cc/tv?imdb_id=%s', $show_id);
        return self::fetch_and_validate($url, 'show');
    }

    static function get_show_embed($show_id, $season_number = 1, $episode_number = 1) {
        $url = sprintf('https://www.2embed.cc/embedtv/%s&s=%d&e=%d', $show_id, $season_number, $episode_number);
        return self::fetch_and_validate($url, 'show');
    }

    static function get_season_details($show_id, $season_number = 1) {
        $url = sprintf('https://api.2embed.cc/season?imdb_id=%s&season=%d', $show_id, $season_number);
        return self::fetch_and_validate($url, 'season details');
    }

    static function get_trending_shows($page = 1) {
        $url = sprintf('https://api.2embed.cc/trendingtv?page=%d', $page);

        return self::fetch_and_validate($url, 'trending shows');
    }

    static function get_similar_shows($show_id, $page = 1) {
        $url = sprintf('https://api.2embed.cc/similartv?imdb_id=%s&page=%d', $show_id, $page);
        return self::fetch_and_validate($url, 'similar shows');
    }

    
}