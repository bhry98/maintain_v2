<?php

namespace App\Models\Task;

use App\Models\Org\DepM;
use App\Models\Org\MachM;
use App\Models\Org\WShopM;
use App\Models\People\ClientM;
use App\Models\People\EmpM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskM extends Model
{
    protected $table = 'task';
    protected $fillable = [
        'id',
        'task_id',
        'mach_id',
        'cli_id',
        'order_time',
        'tittle',
        'details',
        'dep_id',
        'main_ok',
        'main_ok_id',
        'main_ok_time',
        'workshop_id',
        'emp_ok',
        'emp_id',
        'emp_start_time',
        'hold_time',
        'emp_end_time',
        'emp_done',
        'emp_done_note',
        'status',
        'cli_done',
        'is_close',

    ];
    protected $casts = [
        // 'hold_time' => 'datetime',
        'order_time' => 'datetime',
        'main_ok_time' => 'datetime',
        'emp_start_time' => 'datetime',
        // 'hold_time.*' => 'datetime',
        'emp_end_time' => 'datetime',
    ];
    protected $hidden = [];
    public $timestamps = false;
    // public function HoldTime($hold_time)
    // {
    //     foreach ($hold_time as $k => $v) {
    //         $st = strtotime($v['start']);
    //         $time[$k]['start'] =  date(config('app.date.format'), $st);
    //         if ($v['end']) {
    //             $en = strtotime($v['end']);
    //             $time[$k]['end'] =  date(config('app.date.format'), $en);
    //         } else {
    //             $time[$k]['end'] = null;
    //         }
    //     }
    //     return $time;
    // }
    public function HoldTime()
    {
        return $this->hasMany(TaskHoldM::class, 'task_id', 'id');

    }
    public function Status($stat)
    {
        if ($stat == '1') {
            return '<span class="badge bg-orange">' . __("app.task.status.$stat") . '</span>';
        } else if ($stat == '2') {
            return '<span class="badge bg-azure">' . __("app.task.status.$stat") . '</span>';
        } else if ($stat == '3') {
            return '<span class="badge bg-red">' . __("app.task.status.$stat") . '</span>';
        } else if ($stat == '4') {
            return '<span class="badge bg-green">' . __("app.task.status.$stat") . '</span>';
        } else {
            return __("app.Errors.SWW");
        }
    }
    public function LiveTime()
    {
        if ($this->emp_start_time && $this->emp_start_time != null) {
            // $h = $this->emp_start_time->format('h');
            // $m = $this->emp_start_time->format('m');
            // $s = $this->emp_start_time->format('s');
            $sec = $this->emp_start_time->diffInSeconds(config('app.date.now'));
            // $minu = $this->emp_start_time->diffInMinutes(config('app.date.now'));
            // $houre = $this->emp_start_time->diffInHours(config('app.date.now'));
            $minu = 0;
            $houre = 0;
            // $sec = date('s');
            $now_h = date('h');
            $now_m = date('m');
            $now_s = date('s');
            if ($sec >= 60) {
                $minu = $sec % 60;
            }
            if ($minu >= 60) {
                $houre = $minu % 60;
            }
            // return $h . ":" .$m%60  . ":" .$s ;
            return $houre . ":" . $minu  . ":" . $now_s;
        }
    }
    public function Prog()
    {
        return $this->hasMany(TaskProgM::class, 'task_id', 'id')->orderBy('id', 'desc');
    }
    public function SupTasks()
    {
        return $this->hasMany(TaskM::class, 'task_id', 'id');
    }
    public function OldTask()
    {
        return $this->hasOne(TaskM::class, 'id', 'task_id');
    }
    public function Mach()
    {
        return $this->hasOne(MachM::class, 'id', 'mach_id');
    }
    public function EmpH()
    {
        // if ($this->attributes->task_id == null) {
        // return $this->hasOne(ClientM::class, 'id', 'cli_id');
        // } else {
        return $this->hasOne(EmpM::class, 'id', 'cli_id');
        // }
    }
    public function Client()
    {
        // if ($this->attributes->task_id == null) {
        return $this->hasOne(ClientM::class, 'id', 'cli_id');
        // } else {
        //     return $this->hasOne(EmpM::class, 'id', 'cli_id');
        // }
    }
    public function Dep()
    {
        return $this->hasOne(DepM::class, 'id', 'dep_id');
    }
    public function MainOk()
    {
        return $this->hasOne(EmpM::class, 'id', 'main_ok_id');
    }
    public function WShop()
    {
        return $this->hasOne(WShopM::class, 'id', 'workshop_id')->with('Emps');
    }
    public function Emp()
    {
        return $this->hasOne(EmpM::class, 'id', 'emp_id');
    }
}
