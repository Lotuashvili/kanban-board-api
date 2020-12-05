<?php

namespace App\Http\Traits;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait SortableResourceTrait
{
    use CrudUtilities;

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function reorder(int $id, Request $request)
    {
        $model = $this->fetchModel($id);

        $request->validate([
            'order' => 'required|min:0',
        ]);

        $order = $request->input('order');

        $model->updateOrder($order);

        $baseQuery = $this->model()::where('id', '!=', $id)
            ->when(
                is_a($model, Task::class),
                fn(Builder $query) => $query->where('state_id', $model->state_id)
            );

        // Check if item with current order exists
        // If not, then there's no point incrementing other items' orders
        if ((clone $baseQuery)->where('order', $order)->exists()) {
            // Increment other models' orders
            // Doing SQL way to avoid extra operations by PHP in case of many records
            (clone $baseQuery)->where('order', '>=', $order)
                ->update([
                    'order' => DB::raw('`order` + 1'),
                ]);
        }

        return $this->decorate($model);
    }
}
