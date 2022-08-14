@extends('layouts.admin')
@section('title', 'Locations')
@section('nav-title', 'Locations')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon"><i class="material-icons">list</i></div>
                        <h5 class="card-title">Locations</h5>
                    </div>
                    <div class="card-body">
                        <div class="toolbar text-right">
                            <a href="{{ route('admin.location.add') }}" class="btn btn-rose">+ Add</a>
                        </div>
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Flag</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name ?? '' }}</td>
                                        <td>
                                            <img src="{{ asset($item->flag) ?? '' }}" width="16" height="12">
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('admin.location.edit',$item->id) }}">
                                                <button type="button" class="btn btn-info btn-round">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </a>
                                            <a href="javascript:void(0);" onclick="alertMessage('{{ route('admin.location.delete',$item->id) }}','You are deleting location')">
                                                <button type="button" class="btn btn-danger btn-round">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </a>
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

@endsection

