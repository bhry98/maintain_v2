<?php

namespace App\Http\Controllers\web\dash;

use App\Http\Controllers\Controller;
use App\Models\Org\TaskM;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class emp extends Controller
{
  public function ViewDash()
  {
    $chart_options = [
      'chart_title' => 'Users by names',
      'report_type' => 'group_by_string',
      'model' => 'App\Models\Org\TaskM',
      'group_by_field' => 'emp_id',
      'chart_type' => 'line',
      // 'filter_field' => 'emp_id',
      'filter_period' => 'month', // show users only registered this month
    ];
    $chart_Task = [
      'chart_title' => 'الطلبات خلال اليوم',
      'report_type' => 'group_by_string', //group_by_string || group_by_date
      'model' => 'App\Models\Org\TaskM',
      'group_by_field' => 'workshop_id',
      'group_by_period' => 'day',
      'chart_type' => 'bar', // bar || pie || line
      'filter_days' => 10, // show only last 30 days
    ];
    // $chart_Task_not_done = [
    //   'chart_title' => 'الطلبات الجارية',
    //   'report_type' => 'group_by_string', //group_by_string || group_by_date
    //   'model' => 'App\Models\Org\TaskM',
    //   'group_by_field' => 'emp_ok',
    //   // 'group_by_period' => 'day',
    //   'chart_type' => 'bar', // bar || pie || line
    //   'filter_days' => 10, // show only last 30 days
    // ];
    // $chart_Task_done = [
    //   'chart_title' => 'الطلبات المنتهية',
    //   'report_type' => 'group_by_string', //group_by_string || group_by_date
    //   'model' => 'App\Models\Org\TaskM',
    //   'group_by_field' => 'order_time',
    //   'group_by_period' => 'day',
    //   'chart_type' => 'bar', // bar || pie || line
    //   'filter_days' => 10, // show only last 30 days
    // ];
    $data = [
      // 'chart' => new LaravelChart($chart_options),
      // 'chart_task' => new LaravelChart($chart_Task),
      // 'task' => $this->GetAllTask(),
    ];
    return view('dash.emp', $data);
  }
}
