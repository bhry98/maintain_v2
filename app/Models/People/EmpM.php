<?php

namespace App\Models\People;

use App\Models\Org\WShopM;
use App\Models\Sys\RoleM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmpM extends Authenticatable
{
    protected $table = 'emp';
    protected $fillable = [
        'id',
        'name',
        'code',
        'email',
        'username',
        'password',
        'is_mang',
        'mang_id',
        'workshop_id',
        'role_id',
        'active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function WShop()
    {
        return $this->hasOne(WShopM::class, 'id', 'workshop_id');
    }
    public function Mang()
    {
        return $this->hasOne(EmpM::class, 'id', 'mang_id');
    }
    //////
    public function Role()
    {
        return $this->hasOne(RoleM::class, 'id', 'role_id');
    }
    public function hasApility($permission)
    {
        $role = $this->Role;
        if (!$role) {
            return false;
        }
        foreach ($this->Role->permission as $P) {
            if (is_array($P) && in_array($P, $permission)) {
                return true;
            } else if (is_string($P) && strcmp($permission, $P) == 0) {
                return true;
            }
            if ($P == $permission) {
                return $P;
            }
            // return ;
        }
        return false;
    }
}
