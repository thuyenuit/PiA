<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@maildrop.cc',
                'password' => bcrypt('123456'),
            ]
        ];

        foreach ($users as $user) {
            if (User::where('email', $user['email'])->count() == 0) {
                echo "+ Adding to user email " . $user['email'] . "\n";
                User::create($user);
            }
        }
    }
}
