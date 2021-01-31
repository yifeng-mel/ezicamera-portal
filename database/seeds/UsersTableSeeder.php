<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'admin@ezicamera.com',
            'password' => Hash::make('521wx521zyfIotcamera'),
        ]);
    }
}
