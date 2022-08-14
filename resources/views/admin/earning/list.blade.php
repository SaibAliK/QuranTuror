@extends('layouts.admin')
@section('title', 'Earnings')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-info" data-header-animation="true">
                        <div class="ct-chart" id="adminEarning"></div>
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
                        <h4 class="card-title">Total Income ( ${{ $adminEarning->data->sum('amount') ?? '' }} )</h4>
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
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon"><i class="material-icons">list</i></div>
                        <h5 class="card-title">Earning Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.earning.list') }}" method="GET" class="filter-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control datepicker filter_by" name="from_date" placeholder="From Date" readonly value="{{ $req->from_date ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control datepicker filter_by" name="to_date" placeholder="To Date" readonly value="{{ $req->to_date ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-danger pull-right clear btn-sm">Clear</button>
                                </div>
                            </div>
                        </form>
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Tutor</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at ?? "" }}</td>
                                            <td>{{ $item->tutor->FullName ?? '' }}</td>
                                            <td>${{ $item->amount }}</td>
                                            <td>
                                                @if($item->type=='1')
                                                    <span class="badge badge-info">For One Time</span>
                                                @else
                                                    <span class="badge badge-primary">For Package</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-success">Captured</span>
                                            </td>
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
    </script>
    <script>
        $(document).ready(function() {
            adminEarning();
        });
        function adminEarning()
        {
            dataChart = {
                labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                series: [[
                    <?php for($i = 0;$i < $adminEarning->limit;$i++): ?>
                        <?php echo $adminEarning->data->where('day' , $i)->sum('amount') ?? 0; ?>
                    <?php if($i < ($adminEarning->limit-1)): ?> , <?php endif;endfor; ?>
                ]]
            };

          optionsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: '{{ $adminEarning->min }}',
            high: '{{ $adminEarning->max }}', // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
            },
          }

          var OutputChart = new Chartist.Line('#adminEarning', dataChart, optionsChart);

          md.startAnimationForLineChart(OutputChart);
        }
        
    </script>
@endsection
