<?php 
class _CinemaOS {
    /** Uses TMDB or IMDB ID for movie ID
     * Returns only the URL for the movie player
     */
    static function get_movie_embed($movie_id) {
        $url = 'https://cinemaos.tech/player/%d';
        return sprintf($url, $movie_id);
    }

    /** 
    * static function get_trending_movies($page = 1) {}
    * static function get_similar_movies($movie_id, $page = 1) {}
    * - does not exist in the API documentation
    */

    /** Uses TMDB or IMDB ID for show ID
     * Returns only the URL for the show, with season and episode numbers
     */
    static function get_show_embed($show_id, $season_number = 1, $episode_number = 1) {
        $url = 'https://cinemaos.tech/player/%s/%d/%d';
        return sprintf($url, $show_id, $season_number, $episode_number);
    }
}