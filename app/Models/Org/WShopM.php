<?php

namespace App\Models\Org;

use App\Models\People\ClientM;
use App\Models\People\EmpM;
use App\Models\Task\TaskM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WShopM extends Model
{
    protected $table = 'workshop';
    protected $fillable = [
        'id',
        'name',
        'mang_id',
        'note',
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
        return $this->hasMany(TaskM::class, 'workshop_id', 'id');
    }
    public function Mang()
    {
        return $this->hasOne(EmpM::class, 'id', 'mang_id');
    }
    public function Emps()
    {
        return $this->hasMany(EmpM::class, 'workshop_id', 'id');
    }
}
