<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'     => 'Raj',
            'email'    => 'raj@mychat.com',
            'username' => 'raj',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
