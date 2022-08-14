@extends('layouts.admin')
@section('title', 'Tutor History')
@section('nav-title', 'Tutor History')

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
                    <div class="ct-chart" id="tutorIncome"></div>
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
                    <h4 class="card-title">Tutor Income ( ${{ $tutorIncome->data->sum('amount') }} )</h4>
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
                <div class="card-header card-header-info" data-header-animation="true">
                    <div class="ct-chart" id="tutorEarned"></div>
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
                    <h4 class="card-title">Tutor Earned ( ${{ $tutorEarned->data->sum('amount') }} )</h4>
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
                    <div class="ct-chart" id="incomeAverage"></div>
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
                    <h4 class="card-title">Average Income ( ${{ $incomeAverage->data->avg('amount') ?? '0' }} )</h4>
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
                <div class="card-header card-header-info" data-header-animation="true">
                    <div class="ct-chart" id="tutorTutions"></div>
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
                    <h4 class="card-title">Tutor Tutions ( {{ $tutorTutions->data->count() }} )</h4>
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
                    <div class="ct-chart" id="profitToAdmin"></div>
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
                    <h4 class="card-title">Admin Profit ( ${{ $profitToAdmin->data->sum('amount') ?? '' }} )</h4>
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
                    <div class="ct-chart" id="winningJobs"></div>
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
                    <h4 class="card-title">Winning Jobs ( {{ $winningJobs->data->count() ?? '0' }} )</h4>
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
                    <div class="ct-chart" id="lostJobs"></div>
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
                    <h4 class="card-title">Lost Jobs ( {{ $lostJobs->data->count() ?? '0' }} )</h4>
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
    <div class="row">
        <div class="col-md-12">
            <div class="page-categories">
                <ul class="nav nav-pills nav-pills-rose nav-pills-icons" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" id="general-tab" href="#general" role="tablist">
                            <i class="material-icons">emoji_events</i> Win Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="security-tab" href="#security" role="tablist">
                            <i class="material-icons">highlight_off</i> Lost Jobs
                        </a>
                    </li>
                </ul>
                <div class="tab-content tab-space tab-subcategories">
                    <div class="tab-pane active" id="general">
                        <div class="card">
                            <div class="card-body">
                                <div class="material-datatables">
                                    <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Tutor</th>
                                            <th>Student</th>
                                            <th>Status</th>
                                            <th>Message</th>
                                            <th>Class Date</th>
                                            <th>Slot</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($win_jobs as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') ?? '' }}</td>
                                                <td>{{ $item->tutor->FullName ?? '' }}</td>
                                                <td>{{ $item->student->FullName ?? '' }}</td>
                                                <td>
                                                    <span class="badge badge-success">Win</span>
                                                </td>
                                                <td>{{ $item->message ?? '' }}</td>
                                                <td>{{ $item->date ?? '' }}</td>
                                                <td>{{ $item->slot ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="security">
                        <div class="card">
                            <div class="card-body">
                                <div class="material-datatables">
                                    <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Tutor</th>
                                            <th>Student</th>
                                            <th>Status</th>
                                            <th>Message</th>
                                            <th>Class Date</th>
                                            <th>Slot</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($lost_jobs as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') ?? '' }}</td>
                                                <td>{{ $item->tutor->FullName ?? '' }}</td>
                                                <td>{{ $item->student->FullName ?? '' }}</td>
                                                <td>
                                                    <span class="badge badge-danger">Lost</span>
                                                </td>
                                                <td>{{ $item->message ?? '' }}</td>
                                                <td>{{ $item->date ?? '' }}</td>
                                                <td>{{ $item->slot ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

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
        // Graphs Work
        $(document).ready(function() {
            tutorIncome();
            tutorEarned();
            incomeAverage();
            tutorTutions();
            profitToAdmin();
            winningJobs();
            lostJobs();
        });
        function tutorIncome()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $tutorIncome->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($tutorIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $tutorIncome->limit;$i++): ?>
                        <?php echo $tutorIncome->data_array[$i]; ?>
                    <?php if($i < ($tutorIncome->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $tutorIncome->min }}',
            high: '{{ $tutorIncome->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#tutorIncome', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }
        function tutorEarned()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $tutorEarned->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($tutorEarned->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $tutorEarned->limit;$i++): ?>
                        <?php echo $tutorEarned->data_array[$i]; ?>
                    <?php if($i < ($tutorEarned->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $tutorEarned->min }}',
            high: '{{ $tutorEarned->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#tutorEarned', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function incomeAverage()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $incomeAverage->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($incomeAverage->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $incomeAverage->limit;$i++): ?>
                        <?php echo $incomeAverage->data_array[$i]; ?>
                    <?php if($i < ($incomeAverage->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $incomeAverage->min }}',
            high: '{{ $incomeAverage->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#incomeAverage', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function tutorTutions()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $tutorTutions->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($incomeAverage->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $tutorTutions->limit;$i++): ?>
                        <?php echo $tutorTutions->data_array[$i]; ?>
                    <?php if($i < ($tutorTutions->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $tutorTutions->min }}',
            high: '{{ $tutorTutions->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#tutorTutions', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function profitToAdmin()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $profitToAdmin->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($profitToAdmin->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $profitToAdmin->limit;$i++): ?>
                        <?php echo $profitToAdmin->data_array[$i]; ?>
                    <?php if($i < ($profitToAdmin->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $profitToAdmin->min }}',
            high: '{{ $profitToAdmin->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#profitToAdmin', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function winningJobs()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $winningJobs->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($winningJobs->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $winningJobs->limit;$i++): ?>
                        <?php echo $winningJobs->data_array[$i]; ?>
                    <?php if($i < ($winningJobs->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $winningJobs->min }}',
            high: '{{ $winningJobs->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#winningJobs', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }

        function lostJobs()
        {
            dataChart = {
                labels: [
                    <?php for($i = 0;$i < $lostJobs->limit;$i++): ?>
                        <?php echo $i; ?>
                    <?php if($i < ($lostJobs->limit-1)): ?> , <?php endif;endfor; ?>
                ],
                series: [[
                    <?php for($i = 0;$i < $lostJobs->limit;$i++): ?>
                        <?php echo $lostJobs->data_array[$i]; ?>
                    <?php if($i < ($lostJobs->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $lostJobs->min }}',
            high: '{{ $lostJobs->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#lostJobs', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }
        
    </script>

@endsection
