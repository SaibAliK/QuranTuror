@extends('layouts.admin')
@section('title', 'Dashboard')
@section('nav-title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.tutor.list') }}">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon"><i class="material-icons">groups</i></div>
                        <p class="card-category">Tutors</p>
                        <h3 class="card-title">{{ $tutor_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">groups</i> Total # of tutors</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.student.list') }}">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon"><i class="material-icons">how_to_reg</i></div>
                        <p class="card-category">Students</p>
                        <h3 class="card-title">{{ $student_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">how_to_reg</i> Total # of students</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.request_tutor.list') }}">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon"><i class="material-icons">equalizer</i></div>
                        <p class="card-category">Requests</p>
                        <h3 class="card-title">{{ $request_count }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">equalizer</i> Total # of requests</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.earning.list') }}">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon"><i class="material-icons">monetization_on</i></div>
                        <p class="card-category">Total Income</p>
                        <h3 class="card-title">${{ $earning }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"><i class="material-icons">monetization_on</i> Total Earning</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-pills-rose nav-pills-icons" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" id="general-tab" href="#general" role="tablist">
                        <i class="material-icons p-0">emoji_events</i>
                        <h3 class="m-0 p-0">{{ $win_jobs->count() }}</h3>
                        Today Win Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="security-tab" href="#security" role="tablist">
                        <i class="material-icons p-0">highlight_off</i>
                        <h3 class="m-0 p-0">{{ $lost_jobs->count() }}</h3>
                        Today Lost Jobs
                    </a>
                </li>
            </ul>
            <div class="tab-content tab-space tab-subcategories">
                <div class="tab-pane active" id="general">
                    <div class="card">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list</i>
                            </div>
                            <h5 class="card-title">Win Jobs</h5>
                        </div>
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
                                    @foreach ($win_jobs->get() as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') ?? '' }}</td>
                                            <td>{{ $item->tutor->FullName ?? '' }}</td>
                                            <td>{{ $item->student->FullName ?? '' }}</td>
                                            <td>
                                                <span class="badge badge-success">
                                                    Win
                                                </span>
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
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list</i>
                            </div>
                            <h5 class="card-title">Lost Jobs</h5>
                        </div>
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
                                    @foreach ($lost_jobs->get() as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') ?? '' }}</td>
                                            <td>{{ $item->tutor->FullName ?? '' }}</td>
                                            <td>{{ $item->student->FullName ?? '' }}</td>
                                            <td>
                                                <span class="badge badge-danger">
                                                    Lost
                                                </span>
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
</div>
@endsection

