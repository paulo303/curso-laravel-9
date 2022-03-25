<?php

namespace Database\Seeders;

use App\Models\Preference;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name'      => 'Paulo Cavalcanti',
            'email'     => 'paulocavalcanti303@gmail.com',
            'email_verified_at' => now(),
            'password'  => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);

        $user->preferences()->create();
    }
}
