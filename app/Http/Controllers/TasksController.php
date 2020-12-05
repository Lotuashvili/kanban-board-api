<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Http\Traits\CrudResourceTrait;
use App\Http\Traits\SortableResourceTrait;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    use CrudResourceTrait, SortableResourceTrait;

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

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function updateState(int $id, Request $request)
    {
        $model = $this->fetchModel($id);

        $request->validate([
            'state_id' => 'required|exists:states,id',
        ]);

        tap($model)->update(['state_id' => $request->input('state_id')])->load('state');

        return $this->decorate($model);
    }
}
