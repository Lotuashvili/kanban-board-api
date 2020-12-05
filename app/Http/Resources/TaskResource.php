<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order' => $this->order,
            'name' => $this->name,
            'description' => $this->description,
            'priority' => $this->priority_formatted,
            'deadline_at' => optional($this->deadline_at)->toAtomString(),
            'user' => new UserResource($this->whenLoaded('user')),
            'state' => new StateResource($this->whenLoaded('state')),
        ];
    }
}
