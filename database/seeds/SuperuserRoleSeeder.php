<?php

use Illuminate\Database\Seeder;

class SuperuserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'superuser'
        ]);
    }
}
