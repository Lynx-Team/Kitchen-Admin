<?php

use Illuminate\Database\Seeder;

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
    }

    private function insert_role(string $role_name)
    {
        DB::table('roles')->insert([
            'name' => $role_name
        ]);
    }
}
