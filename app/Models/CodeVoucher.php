<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CodeVoucher extends Model
{
    protected $guarded = array('id');
    protected $table = 'code_vouchers';

//    protected $primaryKey = 'code';

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

}
