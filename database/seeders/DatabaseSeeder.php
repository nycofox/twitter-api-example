<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Bruker En',
             'email' => fake()->safeEmail(),
             'token' => '1111111111'
         ]);

        \App\Models\User::factory()->create([
            'name' => 'Bruker To',
            'email' => fake()->safeEmail(),
            'token' => '2222222222'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Bruker Tre',
            'email' => fake()->safeEmail(),
            'token' => '3333333333'
        ]);

        \App\Models\Post::factory()->create([
            'user_id' => 1,
            'body' => 'Innlegg nummer en',
        ]);

        \App\Models\Post::factory()->create([
            'user_id' => 2,
            'body' => 'Innlegg nummer to',
        ]);

        \App\Models\Post::factory()->create([
            'user_id' => 3,
            'body' => 'Innlegg nummer tre',
        ]);
    }
}
