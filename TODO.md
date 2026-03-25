# TODO: Develop Aggregation of Embed Links for Movies

This TODO list outlines the development tasks for implementing the aggregation of embed links from various source APIs in the Movie Gallery API.

## Core Aggregation Logic
- [x] Create `config.php` file to define provider configurations, including:
  - List of providers (_2embed, _cinemaos, _vidsrc, etc.) with priorities, timeouts, and enabled status
  - Quality ranking system (4K, 1080p, etc.)
  - Global settings like max retries and default timeout

- [x] Implement `_cinemaos.php` provider class with methods:
  - `get_movie($movie_id)` - returns API URL for movie embed links
  - `get_trending_movies($page)` - returns API URL for trending movies (if possible)
  - `get_similar_movies($movie_id, $page)` - returns API URL for similar movies (if possible)

- [x] Implement `_vidsrc.php` provider class with methods:
  - `get_movie($movie_id)` - returns API URL for movie embed links
  - `get_trending_movies($page)` - returns API URL for trending movies (if possible)
  - `get_similar_movies($movie_id, $page)` - returns API URL for similar movies (if possible)

- [x] Create `model/movie.php` class with aggregation functionality:
  - `get_aggregated_movie($movie_id)` method that:
    - Fetches movie data from primary provider (_2embed)
    - Aggregates embed links from all enabled providers
    - Handles provider failures 
    - Returns combined movie data with all available streams

- [x] Update `endpoints/get_movie.php` to:
  - Require the Movie model instead of direct provider
  - Use `Movie::get_aggregated_movie()` for data retrieval
  - Return aggregated streams with provider information
  - Include error handling and appropriate HTTP status codes

## Future Enhancements
- [ ] Add caching mechanism for movie data to reduce API calls
- [ ] Add fallback providers when primary provider fails
- [x] Support for additional provider APIs
- [ ] Stream validation to filter out broken links

## TV/Show Support
- [x] Add TV/series model (`models/show.php`) with methods:
  - `get_aggregated_show($show_id)`
  - `get_aggregated_episode($show_id, $season, $episode)`
- [x] Extend provider classes (`_2embed`, `_cinemaos`, `_vidsrc`, `_vidlink`) to support:
  - `get_show($show_id)`
  - `get_episode($show_id, $season, $episode)`
  - `get_similar_shows($show_id, $page)`
  - `get_trending_shows($page)`
- [x] Add endpoints:
  - `endpoints/get_show.php`
  - `endpoints/get_episode.php`
  - `endpoints/get_similar_shows.php`
  - `endpoints/get_trending_shows.php`
- [x] Update existing movie endpoints to handle and return `type: movie` / `type: show` in responses
- [ ] Add tests (if test suite exists) for show/episode aggregation and provider fallback