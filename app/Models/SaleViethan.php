<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class SaleViethan extends Model
{
    protected $guarded = array('id');
    protected $table = 'sale_viethans';

    public function date_format()
    {
        return settings('date_format');
    }

    public function setTimeStartAttribute($date)
    {
        $this->attributes['time_start'] = $date ? Carbon::createFromFormat($this->date_format(),
            $date)->format('Y-m-d') : null;
    }

    public function getTimeStartAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function setTimeEndAttribute($date)
    {
        $this->attributes['time_end'] = $date ? Carbon::createFromFormat($this->date_format(),
            $date)->format('Y-m-d') : null;
    }

    public function getTimeEndAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }
}
