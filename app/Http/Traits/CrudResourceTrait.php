<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait CrudResourceTrait
{
    use CrudUtilities;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Throwable
     */
    public function index()
    {
        return $this->decorate($this->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        return $this->insertOrUpdate($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \App\Http\Resources\StateResource
     * @throws \Throwable
     */
    public function show(int $id)
    {
        return $this->decorate($this->fetchModel($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(Request $request, int $id)
    {
        return $this->insertOrUpdate($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function destroy(int $id)
    {
        $this->fetchModel($id)->delete();

        return response()->noContent();
    }
}
