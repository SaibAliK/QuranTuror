@extends('layouts.admin')
@section('title', 'Packages')
@section('nav-title', 'Packages')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon"><i class="material-icons">list</i></div>
                        <h5 class="card-title">Packages</h5>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Package Type</th>
                                    <th>Percentage</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>
                                            @if($item->type==1)
                                                Basic
                                            @elseif($item->type==2)
                                                Profession
                                            @else
                                                Ultimate
                                            @endif
                                        </td>
                                        <td>{{ $item->percentage }}%</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('admin.package.edit',$item->id) }}">
                                                <button type="button" class="btn btn-info btn-round">
                                                    <i class="material-icons">edit</i>
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

