@extends('layouts.admin')
@section('title', 'Tutor Earning')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon"><i class="material-icons">monetization_on</i></div>
                    <p class="card-category">Paid Amount</p>
                    <h3 class="card-title">${{ $paid_amount }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats"><i class="material-icons">emoji_events</i> Total paid amount</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon"><i class="material-icons">monetization_on</i></div>
                    <p class="card-category">Un Paid Amount</p>
                    <h3 class="card-title">${{ $unpaid_amount }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats"><i class="material-icons">highlight_off</i> Total unpaid amount</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">filter_alt</i>
                    </div>
                    <h5 class="card-title">Filter</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tutor.earning') }}" method="GET" class="filter-form">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control datepicker filter_by" name="from_date" placeholder="From Date" readonly value="{{ $req->from_date }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control datepicker filter_by" name="to_date" placeholder="To Date" readonly value="{{ $req->to_date }}">
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-danger pull-right clear btn-sm">Clear</button>
                            </div>
                        </div>
                    </form>
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
                            <i class="material-icons">info</i> Unpaid
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="security-tab" href="#security" role="tablist">
                            <i class="material-icons">lock</i> Paid
                        </a>
                    </li>
                </ul>
                <div class="tab-content tab-space tab-subcategories">
                    <div class="tab-pane active" id="general">
                        <div class="card">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">list</i>
                                </div>
                                <h5 class="card-title">Un Paid Earning</h5>
                            </div>
                            <div class="card-body">
                                <div class="material-datatables">
                                    <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Tutor</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($unpaid as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at ?? "" }}</td>
                                                <td>{{ $item->tutor->FullName }}</td>
                                                <td>${{ $item->amount }}</td>
                                                <td>
                                                    <span class="badge badge-warning">Unpaid</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.tutor.earning.change_status',['id'=>$item->id]) }}" class="btn btn-success btn-sm">Change Status</a>
                                                </td>
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
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">list</i>
                                </div>
                                <h5 class="card-title">Paid Earning</h5>
                            </div>
                            <div class="card-body">
                                <div class="material-datatables">
                                    <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Tutor</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($paid as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->created_at ?? "" }}</td>
                                                    <td>{{ $item->tutor->FullName }}</td>
                                                    <td>${{ $item->amount }}</td>
                                                    <td>
                                                        <span class="badge badge-warning">Paid</span>
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
    </script>

@endsection
