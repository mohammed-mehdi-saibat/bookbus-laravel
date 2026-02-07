<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::factory()->create([
            'name' => 'Admin BookBus',
            'email' => 'admin@bookbus.ma',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'is_super_admin' => true,
        ]);

        Client::factory(10)->create();

        $this->call([
            TransportSeeder::class,
        ]);
    }
}