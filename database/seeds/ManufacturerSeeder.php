<?php

use App\Models\Manufacturer;

class ManufacturerSeeder extends DatabaseSeeder
{

    public function run()
    {
        Manufacturer::truncate();
        factory(Manufacturer::class, 3)->create();
    }

}
