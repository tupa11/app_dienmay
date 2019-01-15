<?php

use App\Models\Category;

class DumCategorysSeeder extends DatabaseSeeder
{
    public function run()
    {
        Category::truncate();

        Category::create([
            'name' => 'Giảm giá',
            'meta_title' => 'Giảm giá',
            'meta_description' => 'Giảm giá',
            'parent_id' => 0,
        ]);
        Category::create([
            'name' => 'Điện tử',
            'meta_title' => 'Điện tử',
            'meta_description' => 'Điện tử',
            'parent_id' => 0,
        ]);
        Category::create([
            'name' => 'Điện lạnh',
            'meta_title' => 'Điện lạnh',
            'meta_description' => 'Điện lạnh',
            'parent_id' => 0,
        ]);

        Category::create([
            'name' => 'Điện gia dụng',
            'meta_title' => 'Điện gia dụng',
            'meta_description' => 'Điện gia dụng',
            'parent_id' => 0,
        ]);

        Category::create([
            'name' => 'Máy ảnh',
            'meta_title' => 'Máy ảnh',
            'meta_description' => 'Máy ảnh',
            'parent_id' => 2,
        ]);
    }
}
