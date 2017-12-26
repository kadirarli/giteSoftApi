<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        DB::table('users')->delete();
        $users = array(
            ['name' => 'Kadir Arlı', 'email' => 'kadirarli@gmail.com', 'password' => Hash::make('123456')],
            ['name' => 'Test User', 'email' => 'test@test.com', 'password' => Hash::make('123456')],
        );
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            User::create($user);
        }
        Model::reguard();
    }
}
