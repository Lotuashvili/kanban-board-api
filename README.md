# Kanban Board API

## Installation

Copy `.env.example` to `.env` file and fill database credentials.

Run `composer install` and then `php artisan migrate --seed`. 

## Endpoints

**Users**

List: GET `/users`

Create: POST `/users`

Single: GET `/users/{id}`

Update: PATCH `/users/{id}`

Delete: DELETE `/users/{id}`


**States**

List: GET `/states`

Create: POST `/states`

Single: GET `/states/{id}`

Update: PATCH `/states/{id}`

Delete: DELETE `/states/{id}`
