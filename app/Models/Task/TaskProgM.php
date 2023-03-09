<?php

namespace App\Models\Task;

use App\Models\People\ClientM;
use App\Models\People\EmpM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProgM extends Model
{
    protected $table = 'task_prog';
    protected $fillable = [
        'id',
        'task_id',
        'who',
        'do',
        'time',
        'is_client',
    ];
    protected $casts = [
        'time' => 'datetime',
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function Emp()
    {
        return $this->hasOne(EmpM::class, 'id', 'who');
    }
    public function Cli()
    {
        return $this->hasOne(ClientM::class, 'id', 'who');
    }
    public function Task()
    {
        return $this->hasOne(TaskM::class, 'id', 'task_id');
    }
}
