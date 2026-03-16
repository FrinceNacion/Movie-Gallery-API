<?php
class _2embed {
    /** Uses TMDB or IMDB ID for movie ID
     * Returns a json response with the movie details and the streaming links (embed)
     */
    static function get_movie($movie_id) {
        $url = 'https://api.2embed.cc/movie?imdb_id=%s';
        return sprintf($url, $movie_id);
    }

    /**
     * Returns a json response with the trending movies by page (20 movies per page)
     * page - page number (default: 1)
     * results[] - array of movies
     */
    static function get_trending_movies($page = 1) {
        $url = 'https://api.2embed.cc/trending?page={%d}';
        return sprintf($url, $page);
    }

    /**
     * Returns a json response with similar movies by page (20 movies per page)
     * movie_id - the IMDB/TMDB ID of the movie to find similar movies for
     * page - page number (default: 1)
     * results[] - array of similar movies
     */
    static function get_similar_movies($movie_id, $page = 1) {
        $url = 'https://api.2embed.cc/similar?imdb_id=%s&page=%d';
        return sprintf($url, $movie_id, $page);
    }
}