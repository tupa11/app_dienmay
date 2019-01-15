<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = ['id'];
    protected $table = 'areas';


    protected $appends = ['name_address'];

    public function getNameAddressAttribute()
    {
        return ucwords($this->name . ' | ' . $this->address);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

}
