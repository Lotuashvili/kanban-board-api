<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Traits\CrudResourceTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UsersController extends Controller
{
    use CrudResourceTrait;

    protected array $config = [
        'model' => User::class,
        'resource' => UserResource::class,
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param bool $creating
     *
     * @return array
     */
    protected function rules(Model $model = null, bool $creating = true): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email:filter|unique:users,email' . (!$creating ? ',' . $model->id : ''),
        ];
    }
}
