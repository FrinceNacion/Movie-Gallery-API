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

- [ ] Create `model/movie.php` class with aggregation functionality:
  - `get_aggregated_movie($movie_id)` method that:
    - Fetches movie data from primary provider (_2embed)
    - Aggregates embed links from all enabled providers
    - Handles provider failures 
    - Returns combined movie data with all available streams

- [ ] Update `endpoints/get_movie.php` to:
  - Require the Movie model instead of direct provider
  - Validate IMDB ID format
  - Use `Movie::get_aggregated_movie()` for data retrieval
  - Return aggregated streams with provider information
  - Include error handling and appropriate HTTP status codes

## Supporting Tasks
- [ ] Fix require paths in `endpoints/get_similar_movies.php` and `endpoints/get_trending_movies.php` to correctly reference provider files

- [ ] Update `providers/_2embed.php` to fix URL formatting issues (e.g., correct sprintf placeholders)

- [ ] Add timeout handling and user agent headers in provider fetch methods for reliability

- [ ] Implement quality-based sorting for aggregated streams to prioritize higher quality links

- [ ] Add provider error logging for debugging failed provider requests

- [ ] Test aggregation with multiple providers to ensure streams are combined correctly

- [ ] Update API response format to include provider information for each stream

## Future Enhancements
- [ ] Add caching mechanism for movie data to reduce API calls
- [ ] Add fallback providers when primary provider fails
- [ ] Support for additional provider APIs
- [ ] Stream validation to filter out broken links