# Kanban Board API

Simple Kanban Board API written on Laravel

[View Technical Task](task.md)

## Installation

Copy `.env.example` to `.env` file and fill database credentials.

Run `composer install` and then `php artisan migrate --seed`. 

## Endpoints

This repository includes [Postman's json file](Kanban_API_Postman.json). Export this file, then set correct `url` variable (without training slash) in your environment and you can start testing.

### Board

States with tasks and users: GET `/board`

### Tasks

List: GET `/tasks`

Create: POST `/tasks`

Single: GET `/tasks/{id}`

Update: PATCH `/tasks/{id}`

Delete: DELETE `/tasks/{id}`

Change State: `/tasks/state/{id}`

Reorder: POST `/tasks/reorder/{id}`

**Note:** Reordering a task will automatically increase orders of other elements. [View Source](app/Http/Traits/SortableResourceTrait.php#L44)

#### Task Priorities

Priorities are marked by integer and are compared to zero. [View Source](app/Models/Task.php#L72)

Low: `-1`

Medium: `0`

High: `1`

### States

List: GET `/states`

Create: POST `/states`

Single: GET `/states/{id}`

Update: PATCH `/states/{id}`

Delete: DELETE `/states/{id}`

Reorder: POST `/tasks/reorder/{id}`

**Note:** Reordering a state will automatically increase orders of other elements. [View Source](app/Http/Traits/SortableResourceTrait.php#L44)

### Users

List: GET `/users`

Create: POST `/users`

Single: GET `/users/{id}`

Update: PATCH `/users/{id}`

Delete: DELETE `/users/{id}`

## Testing

Run `php artisan test` for tests.
