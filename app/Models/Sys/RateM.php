<?php

namespace App\Models\Sys;

use App\Models\People\ClientM;
use App\Models\People\EmpM;
use App\Models\Task\TaskM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateM extends Model
{
    protected $table = 'rateing';
    protected $fillable = [
        'id',
        'emp_id',
        'task_id',
        'rate',
        'cli_id',
        'note',
    ];
    protected $casts = [];
    protected $hidden = [];
    public $timestamps = false;

    public function Emp()
    {
        return $this->hasOne(EmpM::class, 'id', 'emp_id');
    }
    public function Task()
    {
        return $this->hasOne(TaskM::class, 'id', 'task_id');
    }
    public function Client()
    {
        return $this->hasOne(ClientM::class, 'id', 'cli_id');
    }
}
