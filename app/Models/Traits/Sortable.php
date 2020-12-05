<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

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
     * Adds scope to automatically add sorting query
     */
    public static function bootSortable()
    {
        static::creating(function (self $model) {
            if (empty($model->order)) {
                $model->updateOrder(null, false);
            }
        });

        static::addGlobalScope(fn(Builder $query) => $query->oldest('order'));
    }

    /**
     * @param int|null $order
     * @param bool $save
     *
     * @return $this
     */
    public function updateOrder(?int $order = null, bool $save = true): self
    {
        if (filled($order)) {
            $this->forceFill(compact('order'));

            return $save ? tap($this)->save() : $this;
        }

        $order = self::select('order')->latest('order')->first()->order ?? null;

        $this->forceFill([
            'order' => is_int($order) ? $order + 1 : 0,
        ]);

        return $save ? tap($this)->save() : $this;
    }
}
