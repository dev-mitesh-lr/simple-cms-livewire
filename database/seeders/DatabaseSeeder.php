<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PagesTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::updateOrCreate(['email' => 'admin@malinator.com'],[
            'name' => 'Admin',
            'email' => 'admin@malinator.com',
            'password' => Hash::make('Admin@123'),
        ]);

        $this->call([
            PagesTableSeeder::class
        ]);
    }
}
