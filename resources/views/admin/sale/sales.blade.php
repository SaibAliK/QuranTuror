@extends('layouts.admin')
@section('title', 'Sales')
@section('nav-title', 'Sales')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="GET" class="filter-form">
                <input type="hidden" name="id" value="{{ $req->id ?? '' }}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control datepicker filter_by bg-white" name="from_date" placeholder="From Date" readonly value="{{ $req->from_date }}">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control datepicker filter_by bg-white" name="to_date" placeholder="To Date" readonly value="{{ $req->to_date }}">
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-danger pull-right clear btn-sm">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-info" data-header-animation="true">
                    <div class="ct-chart" id="adminRevenue"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <!-- <i class="material-icons">build</i> Fix Header! -->
                        </button>
                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                        <!-- <i class="material-icons">refresh</i> -->
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                        <!-- <i class="material-icons">edit</i> -->
                        </button>
                    </div>
                    <h4 class="card-title">Admin Revenue ( ${{ $adminRevenue->tutor_data->sum('amount') ?? 0 +  $adminRevenue->admin_data->sum('amount') ?? 0 }} )</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <!-- <i class="material-icons">access_time</i> campaign sent 2 days ago -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-danger" data-header-animation="true">
                    <div class="ct-chart" id="adminIncome"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <!-- <i class="material-icons">build</i> Fix Header! -->
                        </button>
                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                        <!-- <i class="material-icons">refresh</i> -->
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                        <!-- <i class="material-icons">edit</i> -->
                        </button>
                    </div>
                    <h4 class="card-title">Admin Income ( ${{ $adminIncome->data->sum('amount') ?? '0' }} )</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <!-- <i class="material-icons">access_time</i> campaign sent 2 days ago -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-primary" data-header-animation="true">
                    <div class="ct-chart" id="tutorsIncome"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <!-- <i class="material-icons">build</i> Fix Header! -->
                        </button>
                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                        <!-- <i class="material-icons">refresh</i> -->
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                        <!-- <i class="material-icons">edit</i> -->
                        </button>
                    </div>
                    <h4 class="card-title">Tutors Income ( ${{ $tutorsIncome->data->sum('amount') ?? '0' }} )</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <!-- <i class="material-icons">access_time</i> campaign sent 2 days ago -->
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-warning" data-header-animation="true">
                    <div class="ct-chart" id="adminPaidIncome"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <!-- <i class="material-icons">build</i> Fix Header! -->
                        </button>
                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                        <!-- <i class="material-icons">refresh</i> -->
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                        <!-- <i class="material-icons">edit</i> -->
                        </button>
                    </div>
                    <h4 class="card-title">Paid Income ( ${{ $adminPaidIncome->data->sum('amount') ?? '0' }} )</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <!-- <i class="material-icons">access_time</i> campaign sent 2 days ago -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-success" data-header-animation="true">
                    <div class="ct-chart" id="adminUnpaidIncome"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <!-- <i class="material-icons">build</i> Fix Header! -->
                        </button>
                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                        <!-- <i class="material-icons">refresh</i> -->
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                        <!-- <i class="material-icons">edit</i> -->
                        </button>
                    </div>
                    <h4 class="card-title">Unpaid Income ( ${{ $adminUnpaidIncome->data->sum('amount') ?? '0' }} )</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <!-- <i class="material-icons">access_time</i> campaign sent 2 days ago -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-danger" data-header-animation="true">
                    <div class="ct-chart" id="adminProfit"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <!-- <i class="material-icons">build</i> Fix Header! -->
                        </button>
                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                        <!-- <i class="material-icons">refresh</i> -->
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                        <!-- <i class="material-icons">edit</i> -->
                        </button>
                    </div>
                    <h4 class="card-title">Admin Profit ( ${{ $adminProfit->data->sum('amount') ?? '0' }} )</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <!-- <i class="material-icons">access_time</i> campaign sent 2 days ago -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

    <script>
        $('.clear').on('click',function(e){
            e.preventDefault();
            $('.filter_by').val('');
            $('.filter-form').submit();
        });
        $(document).on('change','.filter_by',function(e){
            e.preventDefault();
            $('.filter-form').submit();
        });

        // Graph Work
        $(document).ready(function() {
            adminRevenue();
            adminIncome();
            tutorsIncome();
            adminPaidIncome();
            adminUnpaidIncome();
            adminProfit();
        });
        function adminRevenue()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $adminRevenue->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($adminRevenue->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $adminRevenue->limit;$i++): ?>
                        <?php echo $adminRevenue->data_array[$i]; ?>
                    <?php if($i < ($adminRevenue->limit-1)): ?> , <?php endif;endfor; ?>
                ]],
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $adminRevenue->min }}',
            high: '{{ $adminRevenue->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#adminRevenue', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function adminIncome()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $adminIncome->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($adminIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $adminIncome->limit;$i++): ?>
                        <?php echo $adminIncome->data_array[$i]; ?>
                    <?php if($i < ($adminIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $adminIncome->min }}',
            high: '{{ $adminIncome->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#adminIncome', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function tutorsIncome()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $tutorsIncome->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($tutorsIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $tutorsIncome->limit;$i++): ?>
                        <?php echo $tutorsIncome->data_array[$i]; ?>
                    <?php if($i < ($tutorsIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $tutorsIncome->min }}',
            high: '{{ $tutorsIncome->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#tutorsIncome', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function adminPaidIncome()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $adminPaidIncome->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($adminPaidIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $adminPaidIncome->limit;$i++): ?>
                        <?php echo $adminPaidIncome->data_array[$i]; ?>
                    <?php if($i < ($adminPaidIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $adminPaidIncome->min }}',
            high: '{{ $adminPaidIncome->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#adminPaidIncome', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function adminUnpaidIncome()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $adminUnpaidIncome->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($adminUnpaidIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $adminUnpaidIncome->limit;$i++): ?>
                        <?php echo $adminUnpaidIncome->data_array[$i]; ?>
                    <?php if($i < ($adminUnpaidIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $adminUnpaidIncome->min }}',
            high: '{{ $adminUnpaidIncome->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#adminUnpaidIncome', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function adminProfit()
        {
            dataChart = {
                labels: [[
                    <?php for($i = 0;$i < $adminProfit->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($adminProfit->limit-1)): ?> , <?php endif;endfor; ?>
                ]],
                series: [[
                    <?php for($i = 0;$i < $adminProfit->limit;$i++): ?>
                        <?php echo $adminProfit->data_array[$i]; ?>
                    <?php if($i < ($adminProfit->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $adminProfit->min }}',
            high: '{{ $adminProfit->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#adminProfit', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }
        
    </script>

@endsection