<?php
class _2embed {
    /** Uses TMDB or IMDB ID for movie ID
     * Returns a json response with the movie details and the streaming links (embed)
     */
    static function get_movie($movie_id) {
        $url = sprintf('https://api.2embed.cc/movie?imdb_id=%s', $movie_id);

        $movie_json = @file_get_contents($url); // returns false on failure, suppress warnings with @
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

        return $movie;
    }

    /**
     * Returns a json response with the trending movies by page (20 movies per page)
     * page - page number (default: 1)
     * results[] - array of movies
     */
    static function get_trending_movies($page = 1) {
        $url = sprintf('https://api.2embed.cc/trending?page=%d', $page);

        $movies_json = @file_get_contents($url);
        if ($movies_json === false) {
            throw new Error('Failed to fetch movie data from primary provider');
        }

        $trending_movies = json_decode($movies_json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Error('Invalid JSON from primary provider: ' . json_last_error_msg());
        }

        if (isset($trending_movies['error'])) {
            throw new Error('Movie not found in primary provider');
        }
        return $trending_movies;
    }

    /**
     * Returns a json response with similar movies by page (20 movies per page)
     * movie_id - the IMDB/TMDB ID of the movie to find similar movies for
     * page - page number (default: 1)
     * results[] - array of similar movies
     */
    static function get_similar_movies($movie_id, $page = 1) {
        $url = sprintf('https://api.2embed.cc/similar?imdb_id=%s&page=%d', $movie_id, $page);

        $movies_json = @file_get_contents($url);
        if ($movies_json === false) {
            throw new Error('Failed to fetch movie data from primary provider');
        }

        $similar_movies = json_decode($movies_json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Error('Invalid JSON from primary provider: ' . json_last_error_msg());
        }

        if (isset($similar_movies['error'])) {
            throw new Error('Movie not found in primary provider');
        }
        return $similar_movies;
    }
}