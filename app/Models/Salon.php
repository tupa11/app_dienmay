<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Salon extends Model
{
    protected $guarded = array('id');

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(Area::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
