<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Building;
use App\Models\Task;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Criar usuários
        $owner = User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@email.com',
            'password' => Hash::make('owner')
        ]);

        $user1 = User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => Hash::make('user1')
        ]);

        $user2 = User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@email.com',
            'password' => Hash::make('user2')
        ]);

        // Criar prédios
        $building1 = Building::factory()->create([
            'name' => 'Predio1',
            'address' => 'Endereço1'
        ]);

        $building2 = Building::factory()->create([
            'name' => 'Predio2',
            'address' => 'Endereço2'
        ]);

        // Criar tasks com comentários associados
        $task1 = Task::create([
            'title' => 'Task 1',
            'description' => 'Descrição da Task 1',
            'created_by' => $owner->id,
            'assigned_to_building' => $building1->id,
            'assigned_to_user' => $user1->id,
            'status' => 'Open'
        ]);

        $comment1 = Comment::create([
            'task_id' => $task1->id,
            'created_by' => $owner->id,
            'content' => 'Comentário da Task 1'
        ]);

        $task2 = Task::create([
            'title' => 'Task 2',
            'description' => 'Descrição da Task 2',
            'created_by' => $owner->id,
            'assigned_to_building' => $building2->id,
            'assigned_to_user' => $user2->id,
            'status' => 'Rejected'
        ]);

        $comment2 = Comment::create([
            'task_id' => $task2->id,
            'created_by' => $user1->id,
            'content' => 'Comentário da Task 2'
        ]);
    }
}
