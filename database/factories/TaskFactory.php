<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'assigned_to_user' => User::factory()->create()->id,
            'assigned_to_building' => Building::factory()->create()->id,
            'status' => 'open',
            'created_by' => User::factory()->create()->id,
        ];
    }
}
