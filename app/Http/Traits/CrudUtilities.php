<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait CrudUtilities
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param int|null $id
     *
     * @return mixed
     * @throws \Throwable
     */
    protected function insertOrUpdate(Request $request, ?int $id = null)
    {
        $model = $this->fetchOrNewModel($id);
        $data = $request->validate($this->rules($model, $creating = empty($id)));

        return $this->decorate(
            ($creating ? $this->model()::create($data) : tap($model)->update($data))
                ->loadMissing($this->config('relations', []))
        );
    }

    /**
     * Pass object to resource if given in config
     *
     * @param $object
     *
     * @return mixed
     */
    protected function decorate($object)
    {
        $resource = $this->config('resource');

        if (empty($resource)) {
            return $object;
        }

        return is_a($object, Model::class) ? new $resource($object) : $resource::collection($object);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    protected function fetchModel(int $id): Model
    {
        return $this->model()::with($this->config('relations', []))->findOrFail($id);
    }

    /**
     * @param int|null $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    protected function fetchOrNewModel(?int $id = null): Model
    {
        if (filled($id)) {
            return $this->fetchModel($id);
        }

        $model = $this->model();

        return new $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Throwable
     */
    protected function all(): Collection
    {
        return $this->model()::with($this->config('relations', []))
            ->latest()
            ->latest('id')
            ->get();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    protected function model(): string
    {
        $model = $this->config('model');

        throw_if(empty($model), new Exception('Model is not set.'));

        return $model;
    }

    /**
     * @param string $key
     * @param null $default
     *
     * @return array|mixed
     */
    protected function config(string $key, $default = null)
    {
        return data_get($this->config ?? [], $key, $default);
    }

    /**
     * Reads rules from config if not overriden
     * Override in controller, if rules are based on $creating option
     *
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param bool $creating
     *
     * @return array
     */
    protected function rules(Model $model = null, bool $creating = true): array
    {
        return (array) $this->config('rules', []);
    }
}
