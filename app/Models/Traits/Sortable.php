<?php

namespace App\Models\Traits;

trait Sortable
{
    /**
     * Card order attribute as integer
     */
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
                $model->updateOrder();
            }
        });
    }

    /**
     * @param int|null $order
     *
     * @return $this
     */
    public function updateOrder(?int $order = null): self
    {
        if (filled($order)) {
            return $this->forceFill(compact('order'));
        }

        $order = self::select('order')->latest('order')->first()->order ?? null;

        return $this->forceFill([
            'order' => is_int($order) ? $order + 1 : 0,
        ]);
    }
}
