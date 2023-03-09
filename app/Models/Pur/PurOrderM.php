<?php

namespace App\Models\Pur;

use App\Models\People\EmpM;
use App\Models\Task\TaskM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurOrderM extends Model
{
    protected $table = 'pur_order';
    protected $fillable = [
        'id',
        'task_id',
        'note',
        'main_ok',
        'main_ok_id',
        'main_ok_time',
        'main_done',
        'main_done_id',
        'main_done_time',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',

    ];
    protected $casts = [
        'main_ok_time' => 'datetime',
        'main_done_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function Items()
    {
        return $this->hasMany(PurItemM::class, 'order_id', 'id');
    }
    public function Task()
    {
        return $this->hasOne(TaskM::class, 'id', 'task_id');
    }
    public function MainOk()
    {
        return $this->hasOne(EmpM::class, 'id', 'main_ok_id');
    }
    public function MainDone()
    {
        return $this->hasOne(EmpM::class, 'id', 'main_done_id');
    }
    public function CBy()
    {
        return $this->hasOne(EmpM::class, 'id', 'created_by');
    }
    public function UBy()
    {
        return $this->hasOne(EmpM::class, 'id', 'updated_by');
    }
}
