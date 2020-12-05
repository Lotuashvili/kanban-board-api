<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected array $states = [
        'Planned',
        'In Progress',
        'Ready for Review',
        'Completed',
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!User::count()) {
            User::factory(20)->create();
        }

        if (!State::count()) {
            foreach ($this->states as $order => $name) {
                State::create(compact('name', 'order'));
            }
        }
    }
}
