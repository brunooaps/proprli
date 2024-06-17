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
        $owner = User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@email.com',
            'password' => Hash::make('owner'),
            'role' => 'owner'
        ]);

        $user1 = User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => Hash::make('user1'),
            'role' => 'user'
        ]);

        $user2 = User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@email.com',
            'password' => Hash::make('user2'),
            'role' => 'user'
        ]);

        $building1 = Building::factory()->create([
            'name' => 'Building1',
            'address' => 'Address1'
        ]);

        $building2 = Building::factory()->create([
            'name' => 'Building2',
            'address' => 'Address2'
        ]);

        $task1 = Task::create([
            'title' => 'Task 1',
            'description' => 'Task 1 description',
            'created_by' => $owner->id,
            'assigned_to_building' => $building1->id,
            'assigned_to_user' => $user1->id,
            'status' => 'open'
        ]);

        $comment1 = Comment::create([
            'task_id' => $task1->id,
            'created_by' => $owner->id,
            'content' => 'Task 1 comment'
        ]);

        $task2 = Task::create([
            'title' => 'Task 2',
            'description' => 'Task 2 description',
            'created_by' => $owner->id,
            'assigned_to_building' => $building2->id,
            'assigned_to_user' => $user2->id,
            'status' => 'rejected'
        ]);

        $comment2 = Comment::create([
            'task_id' => $task2->id,
            'created_by' => $user1->id,
            'content' => 'Task 2 comment'
        ]);
    }
}
