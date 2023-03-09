<?php

namespace App\Models\Org;

use App\Models\People\ClientM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepM extends Model
{
    protected $table = 'dep';
    protected $fillable = [
        'id',
        'mang_id',
        'name',
        'code',
        'level',
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

    public function Mang()
    {
        return $this->hasOne(ClientM::class, 'id', 'mang_id');
    }
}
