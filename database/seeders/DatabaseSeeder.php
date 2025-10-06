<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        if (!User::where('id',1)->exists()){
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.co.zw',
                'password' => bcrypt('admin@admin.co.zw'),
            ]);
        }

        $this->call([
            FarmerSeeder::class,
        ]);
    }

}
