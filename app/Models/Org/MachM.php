<?php

namespace App\Models\Org;

use App\Models\Task\TaskM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachM extends Model
{
    protected $table = 'mach';
    protected $fillable = [
        'id',
        'name',
        'code',
        'dep_id',
        'details',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function Tasks()
    {
        return $this->hasMany(TaskM::class, 'mach_id', 'id');
    }
    public function Dep()
    {
        return $this->hasOne(DepM::class, 'id', 'dep_id');
    }
}
