<?php

use App\Models\Size;

class SizeSeeder extends DatabaseSeeder
{

    public function run()
    {
        Size::truncate();
        factory(Size::class, 4)->create();

    }
}
