<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user=\App\Models\User::create([
            'name' => 'Fahril Refiandi',
            'username' => 'fahril',
            'password' => bcrypt('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

        // $user=DB::table('users')->insert([
        //     'name' => 'Fahril Refiandi',
        //     'username' => 'fahril',
        //     'password' => bcrypt('password'),
        //     'remember_token' => \Illuminate\Support\Str::random(10),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        
        $user->createToken('authToken');
    }
}
