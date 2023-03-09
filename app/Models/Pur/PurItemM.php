<?php

namespace App\Models\Pur;

use App\Models\People\EmpM;
use App\Models\Task\TaskM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurItemM extends Model
{
    protected $table = 'pur_item';
    protected $fillable = [
        'id',
        'order_id',
        'name',
        'q',
        'note',
    ];
    protected $casts = [];
    protected $hidden = [];
    public $timestamps = false;

    public function Order()
    {
        return $this->hasOne(PurOrderM::class, 'id', 'order_id');
    }
}
