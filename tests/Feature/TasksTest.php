<?php

namespace Tests\Feature;

use App\Models\State;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TasksTest extends TestCase
{
    public function testCreateTask()
    {
        $data = $this->taskData();

        $this->postJson('tasks', $data)->assertCreated();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testTaskValidationFails()
    {
        $this->postJson('tasks')->assertJsonValidationErrors([
            'state_id',
            'priority',
            'name',
        ]);
    }

    public function testTaskReorder()
    {
        $task = $this->randomTask();

        $this->postJson('tasks/reorder/' . $task->id, [
            'order' => $order = $this->faker->numberBetween(0, 20),
        ])->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'order' => $order,
        ]);
    }

    public function testTaskStateChange()
    {
        $task = $this->randomTask();
        $state = State::inRandomOrder()->where('id', '!=', $task->state_id)->first();

        $this->postJson('tasks/state/' . $task->id, [
            'state_id' => $state->id,
        ])->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'state_id' => $state->id,
        ]);
    }

    protected function randomTask(): Task
    {
        return Task::inRandomOrder()->firstOr(fn() => Task::create($this->taskData()));
    }

    protected function taskData(): array
    {
        return [
            'name' => $this->faker->text(20),
            'priority' => $this->faker->randomElement(['-1', '0', '1']),
            'state_id' => State::inRandomOrder()->firstOr(fn() => State::create(['name' => $this->faker->name]))->id,
            'user_id' => User::inRandomOrder()->firstOr(fn() => User::create([
                'name' => $this->faker->name,
                'email' => $this->faker->safeEmail,
            ]))->id,
            'deadline_at' => now()->addDay(),
        ];
    }
}
