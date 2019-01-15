<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = array('id');
    protected $table = 'roles';

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function hasAccess($permission)
    {
        @$pers = @json_decode($this->permissions, true);
        if (is_array($pers)) {
            return in_array($permission, $pers);
        } else {
            return 0;
        }
    }
}
