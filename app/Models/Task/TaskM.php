<?php

namespace App\Models\Task;

use App\Models\Org\DepM;
use App\Models\Org\MachM;
use App\Models\Org\WShopM;
use App\Models\People\ClientM;
use App\Models\People\EmpM;
use DateTime;
use DateTimeZone;
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
    public function TotalTime()
    {
        $time_hold = $this->HoldTime;
        if (count($time_hold) > 0) {
            foreach ($time_hold as $k => $v) {
                $v->end == null ? $hend = $this->emp_end_time : $hend = $v->end;
                $starthold = new DateTime($v->start, new DateTimeZone(config('app.timezone')));
                $endhold = new DateTime($hend, new DateTimeZone(config('app.timezone')));
                $diff_ = $starthold->diff($endhold);
                $diff_hold[] = $diff_->format('%H:%I:%S');
            }
            $sum = strtotime('00:00:00');
            $totaltime = 0;

            foreach ($diff_hold as $element) {

                // Converting the time into seconds
                $timeinsec = strtotime($element) - $sum;

                // Sum the time with previous value
                $totaltime = $totaltime + $timeinsec;
            }

            // Totaltime is the summation of all
            // time in seconds

            // Hours is obtained by dividing
            // totaltime with 3600
            $h = intval($totaltime / 3600);

            $totaltime = $totaltime - ($h * 3600);

            // Minutes is obtained by dividing
            // remaining total time with 60
            $m = intval($totaltime / 60);

            // Remaining value is seconds
            $s = $totaltime - ($m * 60);

            // Printing the result
            return "$h:$m:$s";
        } else {
            return null;
        }
        // Array containing time in string format
        // $time = [
        //     '00:04:04', '00:02:02',
        // ];


    }
    public function LiveTime()
    {



        $start = new DateTime($this->emp_start_time, new DateTimeZone(config('app.timezone')));
        $end = new DateTime($this->emp_end_time, new DateTimeZone(config('app.timezone')));
        $diff = $start->diff($end);
        if ($diff->format('%D') > 00) {
            return  $diff->format('( %D ) | %H:%I:%S');
        } else {
            return  $diff->format('%H:%I:%S');
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
