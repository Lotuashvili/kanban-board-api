<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use App\Models\State;

class BoardController extends Controller
{
    public function __invoke()
    {
        return StateResource::collection(State::with('tasks.user')->get());
    }
}
