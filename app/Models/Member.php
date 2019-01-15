<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $guarded = array('id');

    protected $fillable = [
        'username',
        'password',
        'name',
        'area_id',
        'admin_id',
        'gender',
        'active',
        'level',
        'phone',
        'avatar',
        'email',
        'address',
        'dateofbirth',
    ];

    protected $hidden = [
        'password',
        'last_login',
        'permissions',
        'remember_token',
        'updated_at',
        'created_at'
    ];

    public function date_format()
    {
        return settings('date_format');
    }

    public function setDateofbirthAttribute($date)
    {
        $this->attributes['dateofbirth'] = $date ? Carbon::createFromFormat($this->date_format(),
            $date)->format('Y-m-d') : null;
    }

    public function getDateofbirthAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function setLastLoginAttribute($date)
    {
        $this->attributes['last_login'] = $date ? Carbon::createFromFormat($this->date_format(),
            $date)->format('Y-m-d') : null;
    }

    public function getLastLoginAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
