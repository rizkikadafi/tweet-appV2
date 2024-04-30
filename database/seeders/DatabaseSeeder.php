<?php

namespace Database\Seeders;

use App\Models\Friendship;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->has(Post::factory()->count(3))
            ->create([
                'name' => 'Kadafi',
                'username' => 'kadafi',
                'email' => 'kadafi@gmail.com',
                'password' => Hash::make('rizkikadafi'),
            ]);

        // Add another spesific user
        // User::factory()
        //     ->has(Post::factory()->count(3))
        //     ->create([
        //         'name' => 'Kadafi',
        //         'username' => 'kadafi',
        //         'email' => 'kadafi@gmail.com',
        //         'password' => Hash::make('rizkikadafi'),
        //     ]);

        User::factory(5)->has(Post::factory(5))->create();

        Friendship::factory(20)->create();
    }
}
