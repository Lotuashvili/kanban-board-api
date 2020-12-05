<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Http\Traits\CrudResourceTrait;
use App\Models\Task;

class TasksController extends Controller
{
    use CrudResourceTrait;

    protected array $config = [
        'model' => Task::class,
        'resource' => TaskResource::class,
        'sortable' => true,
        'relations' => [
            'user',
            'state',
        ],
        'rules' => [
            'state_id' => 'required|exists:states,id',
            'user_id' => 'nullable|exists:users,id',
            'priority' => 'required|in:-1,0,1',
            'name' => 'required|min:1',
            'description' => 'nullable|min:1',
            'deadline_at' => 'nullable|date',
        ],
    ];
}
