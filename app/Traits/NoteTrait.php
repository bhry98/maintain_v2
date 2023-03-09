<?php

namespace App\Traits;

use App\Models\Sys\NotiM;
use Illuminate\Support\Facades\Auth;

/**
 * 
 */
trait NoteTrait
{
    public function SendNewNoti($from, $to, $tittle, $url, $for_client)
    {
        return  NotiM::create([
            'for_client' => $for_client,
            'url' => $url,
            'tittle' => $tittle,
            'is_show' => 0,
            'time_show' => null,
            'from' => $from,
            'to' => $to,
            'time_send' => config('app.date.now'),
           
        ]);
    }
    public function GetAllNotiForEmpByShow($emp_id, $show = 0)
    {
        return  NotiM::where('for_client', '=', 0)->where('to', '=', $emp_id)
            ->where('is_show', '=', $show)
            ->get();
    }
    public function GetAllNotiForEmp($emp_id)
    {
        return  NotiM::where('for_client', '=', 0)
            ->where('to', '=', $emp_id)
            ->get();
    }
    public function GetAllNotiForCliByShow($cli_id, $show = 0)
    {
        return  NotiM::where('for_client', '=', 1)
            ->where('is_show', '=', $show)
            ->where('to', '=', $cli_id)
            ->get();
    }
    public function SetShowByNotiId($nori_id)
    {
        return  NotiM::where('id', '=', $nori_id)
            ->firstOrFail()
            ->update([
                'is_show' => 1,
                'time_show' => config('app.date.now'),
            ]);
    }
}
