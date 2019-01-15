<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->call('RoleTableSeeder');
        $this->call('SizeSeeder');
        $this->call('ColorSeeder');
        $this->call('AreaSeeder');
        $this->call('ManufacturerSeeder');
        $this->call('SettingsSeeder');
        $this->call('DumAccountSeeder');
        $this->call('DumCategorysSeeder');


        Model::reguard();
    }
}
