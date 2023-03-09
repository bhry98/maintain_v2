<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHoldM extends Model
{
    protected $table = 'task_hold';
    protected $fillable = [
        'id',
        'task_id',
        'start',
        'end',
        'why',
     

    ];
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        
    ];
    protected $hidden = [];
    public $timestamps = false;
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
}
