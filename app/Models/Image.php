<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded  = array('id');
    protected $table = 'images';

    protected $appends = ['full_path', 'thumb_path'];

    public function getFullPathAttribute()
    {
        return url('uploads/' . $this->attributes['path'] . '/' . $this->attributes['name']);
    }
    
    public function getThumbPathAttribute() 
    {
        return url('uploads/' . $this->attributes['path'] . '/thumb_' . $this->attributes['name']);
    }

    public function banner() {
        return $this->belongsToMany(Banner::class, 'banner_image', 'image_id', 'banner_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_image', 'image_id', 'product_id');
    }

    public function product() {
        return $this->hasMany(Product::class, 'product_image');
    }

}
