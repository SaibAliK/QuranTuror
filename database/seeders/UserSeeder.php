<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Last Name',
            'email' => 'admin@qurantutors.com',
            'password' => 'qurantutors123',
            'role' =>'admin'
        ]);
    }
}
