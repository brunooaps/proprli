<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_task()
    {
        $user = User::factory()->owner()->create();

        $this->actingAs($user);

        // Simular dados da requisição para criar a tarefa
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'created_by' => $user->id,
            'assigned_to_user' => $user->id,
            'assigned_to_building' => Building::factory()->create()->id,
            'status' => 'open'
        ];

        $response = $this->post(route('tasks.store'), $data);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'created_by' => $user->id,
            'assigned_to_user' => $user->id,
            'assigned_to_building' => $data['assigned_to_building'],
            'status' => 'open',
        ]);

        $response->assertRedirect(route('buildings.index'))->assertSessionHas('success');
    }

    /** @test */
    public function it_updates_task_status()
    {
        $user = User::factory()->owner()->create();

        $this->actingAs($user);
        
        $task = Task::factory()->create(['status' => 'open']);

        $data = [
            'status' => 'completed',
        ];

        $response = $this->put(route('tasks.update', $task->id), $data);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'completed',
        ]);

        $response->assertRedirect(route('tasks.edit', $task->id))->assertSessionHas('success');
    }
}
