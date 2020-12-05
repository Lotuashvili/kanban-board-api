<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use App\Http\Traits\CrudResourceTrait;
use App\Models\State;

class StatesController extends Controller
{
    use CrudResourceTrait;

    protected array $config = [
        'model' => State::class,
        'resource' => StateResource::class,
        'sortable' => true,
        'rules' => [
            'name' => 'required|min:3',
        ],
    ];
}
