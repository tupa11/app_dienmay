<?php

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DumAccountSeeder extends DatabaseSeeder
{
    public function run()
    {
        Model::unguard();
        DB::table('admins')->truncate();

        $role_manager = Role::where('name', 'manager')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_saler = Role::where('name', 'saler')->first();

        $manager = new Admin();
        $manager->username = 'admin';
        $manager->password = bcrypt("admin");
        $manager->name = 'Lê thanh tùng';
        $manager->phone = "0963690597";
        $manager->lang = "vi";
        $manager->area_id = 1;
        $manager->active = 1;
        $manager->role_id = $role_manager->id;
        $manager->save();


        $manager2 = new Admin();
        $manager2->username = 'admin2';
        $manager2->password = bcrypt("admin");
        $manager2->name = 'admin thứ hai';
        $manager2->phone = "0963690597";
        $manager2->lang = "vi";
        $manager2->area_id = 1;
        $manager2->active = 1;
        $manager2->role_id = $role_admin->id;
        $manager2->save();

        $manager3 = new Admin();
        $manager3->username = 'admin3';
        $manager3->password = bcrypt("admin");
        $manager3->name = 'saler thứ ba';
        $manager3->phone = "0963690597";
        $manager3->lang = "vi";
        $manager3->area_id = 1;
        $manager3->active = 1;
        $manager3->role_id = $role_saler->id;
        $manager3->save();

        Model::reguard();
    }
}
