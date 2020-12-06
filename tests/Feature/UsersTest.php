<?php

namespace Tests\Feature;

use Tests\TestCase;

class UsersTest extends TestCase
{
    public function testUserCreate()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
        ];

        $this->postJson('users', $data)->assertCreated();
        $this->assertDatabaseHas('users', $data);
    }

    public function testUserValidationFails()
    {
        $this->postJson('users')->assertJsonValidationErrors([
            'name',
            'email',
        ]);
    }
}
