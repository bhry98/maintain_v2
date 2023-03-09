<?php

namespace App\Models\People;

use App\Models\Org\DepM;
use App\Models\Sys\RoleM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ClientM extends Authenticatable
{
    protected $table = 'client';
    protected $fillable = [
        'id',
        'name',
        'is_mang',
        'mang_id',
        'dep_id',
        'username',
        'email',
        'password',
        'code',
        'role_id',
        'active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    protected $casts = [
        'dep_id' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function Dep()
    {
        $deps = $this->dep_id;
        if (!$deps) {
            return [];
        }
        foreach ($deps as $v) {
            $depM[] = DepM::where('id', '=', $v)->firstOrFail();
        }
        return $depM;
    }
    public function Mang()
    {
        return $this->hasOne(ClientM::class, 'id', 'mang_id');
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
        foreach ($this->Role->permission as $key => $P) {
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
