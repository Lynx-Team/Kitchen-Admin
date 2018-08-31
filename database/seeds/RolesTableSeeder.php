<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insert_role('admin');
        $this->insert_role('kitchen');
        $this->insert_role('manager');
        $this->insert_role('superuser');
        $this->insert_role('customer');
    }

    private function insert_role(string $role_name)
    {
        if (!DB::table('roles')->where('name', $role_name)->exists()){
            DB::table('roles')->insert([
                'name' => $role_name
            ]);
        }
    }
}
