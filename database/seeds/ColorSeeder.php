<?php

use App\Models\Color;

class ColorSeeder extends DatabaseSeeder
{

    public function run()
    {
        Color::truncate();
        factory(Color::class, 7)->create();

    }
}
