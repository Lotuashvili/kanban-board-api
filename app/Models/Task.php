<?php

namespace App\Models;

use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $state_id
 * @property int|null $user_id
 * @property int $order
 * @property int $priority
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deadline_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $priority_formatted
 * @property-read \App\Models\State $state
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeadlineAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUserId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'state_id',
        'user_id',
        'priority',
        'name',
        'description',
        'deadline_at',
    ];

    protected $dates = [
        'deadline_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Returns priority name based on value (-1, 0, 1)
     *
     * @return string
     */
    public function getPriorityFormattedAttribute(): string
    {
        return [
            '-1' => 'Low',
            '0' => 'Medium',
            '1' => 'High',
        ][$this->priority <=> 0];
    }
}
