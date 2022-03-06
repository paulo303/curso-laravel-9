<?php

namespace Database\Seeders;

use App\Models\Preference;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name'      => 'Paulo Cavalcanti',
            'email'     => 'paulo@mxntech.com.br',
            'password'  => bcrypt('123456'),
        ]);

        Preference::create([
            'user_id'      => User::first()->id,
        ]);
    }
}
