<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can customize this depending on your app's user model fields
        $farmers = [
            [
                'name' => 'John Moyo',
                'email' => 'john.moyo@example.com',
                'phone' => '+263771234567',
                'role' => 'farmer',
                'password' => Hash::make('password123'),
                'address' => 'Gweru, Midlands',
            ],
            [
                'name' => 'Sarah Ncube',
                'email' => 'sarah.ncube@example.com',
                'phone' => '+263783214567',
                'role' => 'vet',
                'password' => Hash::make('password123'),
                'address' => 'Bulawayo, Matabeleland South',
            ],
            [
                'name' => 'Tendai Chiweshe',
                'email' => 'tendai.chiweshe@example.com',
                'phone' => '+263719876543',
                'role' => 'farmer',
                'password' => Hash::make('password123'),
                'address' => 'Mutare, Manicaland',
            ],
            [
                'name' => 'Rudo Mutsvairo',
                'email' => 'rudo.mutsvairo@example.com',
                'phone' => '+263785678912',
                'role' => 'farmer',
                'password' => Hash::make('password123'),
                'address' => 'Marondera, Mashonaland East',
            ],
        ];

        foreach ($farmers as $farmer) {
            User::updateOrCreate(
                ['email' => $farmer['email']],
                $farmer
            );
        }
    }
}
