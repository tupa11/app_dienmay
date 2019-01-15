<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Voucher extends Model
{
    protected $guarded = array('id');
    protected $table = 'vouchers';

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function codevochers()
    {
        return $this->hasMany(CodeVoucher::class);
    }

    public function codevocherokes()
    {
        return $this->hasMany(CodeVoucher::class)->whereNull('member_id');
    }
}
