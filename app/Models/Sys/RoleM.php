<?php

namespace App\Models\Sys;

use App\Models\People\EmpM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleM extends Model
{
    public $timestamps = false;
    protected $table = 'role';
    protected $fillable = [
        'id',
        'name',
        'code',
        'permission',
        'note',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    protected $hidden = [
        // 'id',
        // 'name',
        // 'code',
        // 'note',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    protected $casts = [
        'name' => 'array',
        'permission' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function CBy()
    {
        return $this->hasOne(EmpM::class, 'id', 'created_by');
    }
    public function UBy()
    {
        return $this->hasOne(EmpM::class, 'id', 'updated_by');
    }
    public function Emps()
    {
        return $this->hasMany(EmpM::class, 'role_id', 'id');
    }
}
