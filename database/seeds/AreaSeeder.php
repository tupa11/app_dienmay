<?php

use App\Models\Area;

class AreaSeeder extends DatabaseSeeder
{

    public function run()
    {
        Area::truncate();
        factory(Area::class, 5)->create();

    }
}
