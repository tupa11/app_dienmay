<?php

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('roles')->truncate();
//        DB::table('admin_role')->truncate();
        $role_employee = new Role();
        $role_employee->name = 'manager';
        $role_employee->description = 'A manager';
        $role_employee->save();

        $role_employee = new Role();
        $role_employee->name = 'saler';
        $role_employee->description = 'A Saler User';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'A Admin User';
        $role_manager->save();
        Model::reguard();
    }
}
