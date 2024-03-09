# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

# users-api

## About The Project
This is a simple user api project. Below are the supported APIs

GET: './users'
POST: './users'
PUT: './users/:userId'
DELETE: './users/:userId'
GET: './users/:userId'

## Getting Started

### Installation
Requires php version greater than `8.0` and composer installed

1. Run `composer install` to install php dependencies
2. Run `php artisan migrate` to create `users` table
3. Run `php artisan db:seed` to create sample users
4. Run `php -S http://localhost:8000 -t public` to run the server on port `8000`

## Note: Above project uses sqlite database

