<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Manufacturer extends Model
{
    protected $guarded = array('id');
    protected $table = 'manufacturers';

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
