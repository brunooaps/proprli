<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_comment()
    {
        $user = User::factory()->owner()->create();

        $this->actingAs($user);

        $task = Task::factory()->create();

        $data = [
            'task_id' => $task->id,
            'created_by' => $user->id,
            'comment' => 'task comment test',
        ];

        $response = $this->post(route('comments.store'), $data);

        $response->assertRedirect(route('tasks.edit', $task->id))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('comments', [
            'task_id' => $task->id,
            'created_by' => $user->id,
            'content' => 'task comment test',
        ]);
    }
}
