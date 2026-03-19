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
- [ ] Support for additional provider APIs
- [ ] Stream validation to filter out broken links