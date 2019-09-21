<?php

use Illuminate\Database\Seeder;
use Silver\Bounceer\Bouncer;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create();
    }
}