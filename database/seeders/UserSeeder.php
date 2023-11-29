<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'admin';
        $user->email = 'testAdmin@mail.ru';
        $user->role_id = '3';
        $user->email_verified_at = now();
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = Str::random(10);
        $user->save();

        $user = new User;
        $user->name = 'manager';
        $user->email = 'testManager@mail.ru';
        $user->role_id = '2';
        $user->email_verified_at = now();
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = Str::random(10);
        $user->save();

        $user = new User;
        $user->name = 'user';
        $user->email = 'testUser@mail.ru';
        $user->role_id = '1';
        $user->email_verified_at = now();
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = Str::random(10);
        $user->save();
    }
}
