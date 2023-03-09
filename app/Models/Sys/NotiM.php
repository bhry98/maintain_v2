<?php

namespace App\Models\Sys;

use App\Models\People\ClientM;
use App\Models\People\EmpM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotiM extends Model
{
    protected $table = 'notification';
    protected $fillable = [
        'id',
        'for_client',
        'url',
        'tittle',
        'is_show',
        'time_show',
        'from',
        'to',
        'time_send',
    ]; 
    protected $casts = [
        'time_show' => 'datetime',
        'time_send' => 'datetime',
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function To()
    {
        if ($this->for_client == 1) {
            return $this->hasOne(ClientM::class, 'id', 'to');
        } else {
            return $this->hasOne(EmpM::class, 'id', 'to');
        }
    }
    public function From()
    {
        if ($this->for_client == 1) {
            return $this->hasOne(ClientM::class, 'id', 'from');
        } else {
            return $this->hasOne(EmpM::class, 'id', 'from');
        }
    }
}
