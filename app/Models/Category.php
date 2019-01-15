<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $guarded = array('id');
    protected $table = 'categories';

    public function user()
    {
        return $this->belongsTo(Member::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('published', 1);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
