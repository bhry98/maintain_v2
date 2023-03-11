<div>
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div dir="ltr" class="card-body">
                    <div id="chart-tasks-overview"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h3 class="card-title">اكثر الأقسام طلباً للصيانة</h3>
                        {{-- <div class="ms-auto">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item active" href="#">Last 7 days</a>
                                    <a class="dropdown-item" href="#">Last 30 days</a>
                                    <a class="dropdown-item" href="#">Last 3 months</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="chart-active-users-2"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="divide-y divide-y-fill">
                                <div class="px-3">
                                    <div class="text-muted">
                                        <span class="status-dot bg-primary"></span> Mobile
                                    </div>
                                    <div class="h2">11,425</div>
                                </div>
                                <div class="px-3">
                                    <div class="text-muted">
                                        <span class="status-dot bg-azure"></span> Desktop
                                    </div>
                                    <div class="h2">6,458</div>
                                </div>
                                <div class="px-3">
                                    <div class="text-muted">
                                        <span class="status-dot bg-green"></span> Tablet
                                    </div>
                                    <div class="h2">3,985</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="chart-demo-pie"></div>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    @php
        foreach ($last_14_day as $key => $value) {
            $i[] = $value->id;
        }
    @endphp
    {{-- @foreach ($last_14_day as $item)
        {{ $item }}
        <br>
        <hr>
    @endforeach --}}
    @section('js')
        <script src="{{ url('assets/js/chart.js') }}"></script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-tasks-overview'), {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 320,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [{
                        name: [44, 32, 48, 72, 60, 16, 44, 32, 78, 50, 68, 34, 26, 48],
                        data: [44, 32, 48, 72, 60, 16, 44, 32, 78, 50, 68, 34, 26, 48]

                    }, ],
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        categories: ['25/02/2023', '26/02/2023', '27/02/2023', '28/02/2023', '29/02/2023',
                            '01/03/2023',
                            '2/03/2023', '3/03/2023', '4/03/2023', '5/03/2023', '6/03/2023',
                            '5/03/2023',
                            '6/03/2023', '7/03/2023'
                        ],
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    colors: [tabler.getColor("primary"), tabler.getColor("danger")],
                    legend: {
                        show: false,
                    },
                })).render();
            });
            // @formatter:on
        </script>
        @php
            
            if (count($all_task_pie) > 0) {
                foreach ($all_task_pie as $v) {
                    $pie['series'][] = $v->tasks;
                    $pie['labels'][] = $v->name;
                }
            } else {
                $pie['series'] = [];
                $pie['labels'] = [];
            }
            
            // @json($pie)
            
        @endphp

        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
                    chart: {
                        type: "donut",
                        fontFamily: 'inherit',
                        height: 240,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: {{ json_encode($pie['series']) }},
                    labels: {{ json_encode($pie['labels']) }},
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor(
                        "primary", 0.6), tabler.getColor("gray-300")],
                    legend: {
                        show: true,
                        position: 'bottom',
                        offsetY: 12,
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 100,
                        },
                        itemMargin: {
                            horizontal: 8,
                            vertical: 8
                        },
                    },
                    tooltip: {
                        fillSeriesColor: false
                    },
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users-2'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 288,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "Mobile",
                        data: [4164, 4652, 4817, 4841, 4920, 5439, 5486, 5498, 5512, 5538, 5841,
                            5877, 6086, 6146, 6199, 6431, 6704, 7939, 8127, 8296, 8322, 8389,
                            8411, 8502, 8868, 8977, 9273, 9325, 9345, 9430
                        ]
                    }, {
                        name: "Desktop",
                        data: [2164, 2292, 2386, 2430, 2528, 3045, 3255, 3295, 3481, 3604, 3688,
                            3840, 3932, 3949, 4003, 4298, 4424, 4869, 4922, 4973, 5155, 5267,
                            5566, 5689, 5692, 5758, 5773, 5799, 5960, 6000
                        ]
                    }, {
                        name: "Tablet",
                        data: [1069, 1089, 1125, 1141, 1162, 1179, 1185, 1216, 1274, 1322, 1346,
                            1395, 1439, 1564, 1581, 1590, 1656, 1815, 1868, 2010, 2133, 2179,
                            2264, 2265, 2278, 2343, 2354, 2456, 2472, 2480
                        ]
                    }],
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25',
                        '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30',
                        '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05',
                        '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10',
                        '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15',
                        '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20'
                    ],
                    colors: [tabler.getColor("primary"), tabler.getColor("azure"), tabler.getColor(
                        "green")],
                    legend: {
                        show: false,
                    },
                })).render();
            });
            // @formatter:on
        </script>
    @endsection
</div>
