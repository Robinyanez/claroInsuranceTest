<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('users')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $users_all = [];

        $users = User::create([
            'name'                  => 'Admin',
            'slug'                  => 'admin',
            'is_admin'              => true,
            'identification_card'   => '123456789',
            'email'                 => 'admin@example.com',
            'phone'                 => '0987008611',
            'date_of_birth'         => '1994-04-12',
            'id_cities'             => '1',
            'password'              => Hash::make('123456789'),
        ]);

        $users_all[] = $users->id;
    }
}
