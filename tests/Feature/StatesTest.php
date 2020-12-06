<?php

namespace Tests\Feature;

use App\Models\State;
use Tests\TestCase;

class StatesTest extends TestCase
{
    public function testStateCreate()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $this->postJson('states', $data)->assertCreated();

        $this->assertDatabaseHas('states', $data);
    }

    public function testStateValidationFails()
    {
        $this->postJson('states')->assertJsonValidationErrors([
            'name',
        ]);
    }

    public function testStateReorder()
    {
        $state = State::inRandomOrder()->first();

        $this->postJson('states/reorder/' . $state->id, [
            'order' => $order = $this->faker->numberBetween(0, 20),
        ])->assertOk();

        $this->assertDatabaseHas('states', [
            'id' => $state->id,
            'order' => $order,
        ]);
    }
}
