# Kanban Board API

## Installation

Copy `.env.example` to `.env` file and fill database credentials.

Run `composer install` and then `php artisan migrate --seed`. 

## Endpoints

**Users**

List: GET `/users`

**States**

List: GET `/states`

Create: POST `/states`

Single: GET `/states/{id}`

Update: PATCH `/states/{id}`

Delete: DELETE `/states/{id}`
