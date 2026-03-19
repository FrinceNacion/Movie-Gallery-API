# Movie Gallery API

A multi-site streaming link aggregator API to consolidate embed links from multiple provider sources into a unified backend service.

## Project Description

Movie Gallery API is a backend aggregation service that fetches and consolidates streaming links from multiple embed providers (VidLink, CinemaOS, VidSrc, 2Embed, etc.). The API provides a unified interface for fetching movie data, trending content, and discovering similar movies while abstracting the complexity of managing multiple provider integrations.

> **ℹ️ Note:** 
> This project is for educational purposes only. It aggregates streaming links from various sites already available on the internet but does not host or provide the actual video content.

## Features

- **Multi-Provider Aggregation**: Fetches data from multiple streaming providers simultaneously
- **Configuration**: Centralized config file for managing providers and other possible future configurations
- **RESTful Endpoints**: API routes for movies, trending content, and similar recommendations

## API Endpoints

- `GET /endpoints/get_movie.php?id={movie_id}` - Retrieve aggregated movie data and available streams
- `GET /endpoints/get_trending_movies.php?page={page}` - Fetch trending movies
- `GET /endpoints/get_similar_movies.php?id={movie_id}&page={page}` - Get movies similar to specified movie_id

## Getting Started

1. Clone the repository
2. Configure your web server to serve the API
3. Adjust provider settings in `config.php` as needed
4. Test endpoints with your preferred HTTP client (Postman, cURL, etc.)

Example request:
```bash
curl "http://localhost/endpoints/get_movie.php?id=tt1234567"
```