@extends('layouts.admin')
@section('title', 'Tutor Requests')
@section('css')
<style>
    .bmd-form-group [class^='bmd-label'], .bmd-form-group [class*=' bmd-label']
    {
        position: relative !important;
    }
</style>
@endsection
@section('nav-title', 'Tutor Requests')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon"><i class="material-icons">emoji_events</i></div>
                        <p class="card-category">Win Requests</p>
                        <h3 class="card-title">{{ $win_jobs_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">emoji_events</i> Total # of win job requests</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon"><i class="material-icons">highlight_off</i></div>
                        <p class="card-category">Lost Requests</p>
                        <h3 class="card-title">{{ $lost_jobs_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">highlight_off</i> Total # of lost job requests</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon"><i class="material-icons">equalizer</i></div>
                        <p class="card-category">Pending</p>
                        <h3 class="card-title">{{ $pending_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">equalizer</i> Total # of pending requests</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon"><i class="material-icons">cached</i></div>
                        <p class="card-category">Cancelled</p>
                        <h3 class="card-title">{{ $cancelled_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">cached</i> Total cancelled requests</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon"><i class="material-icons">list</i></div>
                        <h5 class="card-title">Tutor Requests</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.request_tutor.list') }}" method="GET" class="filter-form">
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
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Tutor</th>
                                    <th>Student</th>
                                    <th>Message</th>
                                    <th>Class Date</th>
                                    <th>Slot</th>
                                    <th>Winning Status</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $item->tutor->FullName }}</td>
                                        <td>{{ $item->student->FullName }}</td>
                                        <td>{{ $item->message }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->slot }}</td>
                                        <td>
                                            @if($item->accept_status=='2' || $item->accept_status=='0')
                                                <span class="badge badge-danger">No</span>
                                            @else
                                                <span class="badge badge-success">Yes</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status=='approved')
                                                <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                            @elseif($item->status=='pending')
                                                <span class="badge badge-info">{{ ucfirst($item->status) }}</span>
                                            @elseif($item->status=='cancelled')
                                                <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            @if($item->payment_type=='permanent' && $item->status=='approved')
                                                <a href="{{ route('admin.request_tutor.schedule.list',$item->id) }}">
                                                    <button type="button" class="btn btn-info btn-round" data-id="{{ $item->id }}">
                                                        <i class="material-icons">alarm</i>
                                                    </button>
                                                </a>
                                            @endif
                                            @if($item->status!='cancelled')

                                                <button type="button"  onclick="alertMessage('{{ route('admin.request_tutor.status.cancel',$item->id) }}','You are cancelling request')"  rel="tooltip" class="btn btn-primary btn-round delete-btn" data-original-title="Refund" title="Delete">
                                                    Cancel
                                                </button>
                                            @endif
                                            <button type="button"  onclick="deleteAlert('{{ route('admin.request_tutor.delete', $item->id) }}')"  rel="tooltip" class="btn btn-danger btn-round delete-btn" data-original-title="Delete" title="Delete">
                                                <i class="material-icons">close</i>
                                            </button>
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

    <!-- Modal -->
    <div class="modal fade" id="editRequestTutor" tabindex="" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">

    </div>
    <!-- /Modal -->
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

