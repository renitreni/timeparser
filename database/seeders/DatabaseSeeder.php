<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@site.com',
            'email_verified_at'  => now(),
            'password'          => Hash::make('info1234'),
            'remember_token'    => Str::random(10),
        ]);
        User::factory(10)->create();
        $this->call(PermissionsTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
    }
}
