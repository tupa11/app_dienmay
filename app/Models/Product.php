<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
    protected $table = 'products';


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'product_image');
    }


    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image', 'product_id', 'image_id');
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'is_variant')->with('subProduct');
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    public function date_format()
    {
        return settings('date_format');
    }

    public function setSaleFromAttribute($date)
    {
        $this->attributes['sale_from'] = $date ? Carbon::createFromFormat($this->date_format(),
            $date)->format('Y-m-d') : null;
    }

    public function getSaleFromAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function setSaleToAttribute($date)
    {
        $this->attributes['sale_to'] = $date ? Carbon::createFromFormat($this->date_format(),
            $date)->format('Y-m-d') : null;
    }

    public function getSaleToAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }


}
