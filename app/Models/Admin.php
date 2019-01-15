<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = array('id');

    protected $fillable = [
        'password',
        'name',
        'area_id',
        'group',
        'active',
        'gender',
        'permissions',
        'phone',
        'avatar',
        'lang'
    ];

    protected $hidden = [
        'password',
        'last_login',
        'permissions',
        'remember_token',
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    protected $appends = ['avatar'];

    public function getAvatarAttribute()
    {

        $val = isset($this->attributes['avatar']) ? $this->attributes['avatar'] : null;
        if (empty($val)) {
            return asset('uploads/avatar') . '/user.png';
        }

        $val = asset('uploads/avatar') . '/' . $val;

        return $val;
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    static public function getOnlyAdmins($type = 'pluck')
    {
        $admins = Admin::where([['group', '<>', 'manager'], ['active', 1]])->orderBy('id');
        if ($type == 'pluck') {
            $admins = $admins->pluck('full_name', 'id');
        } else {
            $admins = $admins->get();
        }
        return $admins;
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function authorized($permission = null)
    {
        @$pers = @json_decode($this->role->permissions, true);
        if (is_array($pers)) {
            return in_array($permission, $pers);
        } else {
            return 0;
        }
    }

}
