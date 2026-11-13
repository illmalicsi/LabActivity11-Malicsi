<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Lola Malicsi',
            'email' => 'lola.malicsi@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawadAuthor = Author::where('email', 'kagawad.malicsi@bulletin.test')->first();

        $kagawad = User::create([
            'name' => $kagawadAuthor->name,
            'email' => 'kagawad.malicsi@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawadAuthor->update(['user_id' => $kagawad->id]);

        User::factory(8)->create();
    }
}
