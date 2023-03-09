<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use App\Traits\AuthTrait;
use App\Traits\ClientTrait;
use App\Traits\DepTrait;
use App\Traits\EmailTrait;
use App\Traits\EmpTrait;
use App\Traits\MachTrait;
use App\Traits\NoteTrait;
use App\Traits\PurTrait;
use App\Traits\ReportTrait;
use App\Traits\RoleTrait;
use App\Traits\SysTrait;
use App\Traits\TaskTrait;
use App\Traits\WorkShopTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use
        MachTrait,
        NoteTrait,
        DepTrait,
        ApiTrait,
        EmailTrait,
        PurTrait,
        ReportTrait,
        TaskTrait,
        ClientTrait,
        WorkShopTrait,
        EmpTrait,
        RoleTrait,
        SysTrait,
        AuthTrait;
}
