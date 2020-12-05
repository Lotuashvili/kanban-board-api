<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use App\Http\Traits\CrudResourceTrait;
use App\Http\Traits\SortableResourceTrait;
use App\Models\State;

class StatesController extends Controller
{
    use CrudResourceTrait, SortableResourceTrait;

    protected array $config = [
        'model' => State::class,
        'resource' => StateResource::class,
        'sortable' => true,
        'rules' => [
            'name' => 'required|min:3',
        ],
    ];
}
