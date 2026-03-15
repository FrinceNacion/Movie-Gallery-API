<?php
class _2embed {
    static function get_movie($movie_id) {
        $url = 'https://api.2embed.cc/movie?imdb_id=%s';
        return sprintf($url, $movie_id);
    }

    static function get_trending_movies($page = 1) {
        $url = 'https://api.2embed.cc/trending?page={%d}';
        return sprintf($url, $page);
    }

    static function get_similar_movies($movie_id, $page = 1) {
        $url = 'https://api.2embed.cc/similar?imdb_id=%s&page=%d';
        return sprintf($url, $movie_id, $page);
    }
}