<?php

namespace App\Models\Traits;

trait Sortable
{
    public function initializeSortable()
    {
        $this->casts['order'] = 'integer';
    }

    /**
     * Automatically sets latest order
     */
    public static function bootSortable()
    {
        static::creating(function (self $model) {
            if (empty($model->order)) {
                $order = self::select('order')->latest('order')->first()->order ?? null;

                $model->order = $order ? $order + 1 : 0;
            }
        });
    }
}
