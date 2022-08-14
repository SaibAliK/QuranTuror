@extends('layouts.tutor')
@section('title', 'Packages')

@section('content')

    <div class="card ">

        <div class="card-body">
            <div class="col-lg-12 mb-3 text-center  ">
                <h2 class="text-center has-line text-dark line-primary">Packages</h2>
            </div>
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item waves-effect   waves-light">
                    
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="col-lg-12 p-3">
                        <div class="text-right mb-3">
                            <a href="{{ route('tutor.packages.add') }}" class="btn btn-primary">Add</a>
                        </div>
                        
                        <table class="table w-100 display" >
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Hours</th>
                                <th>Amount / Hour</th>
                                <th>Total Amount</th>
                                <th>Package Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->hours }}</td>
                                    <td>${{ $item->per_hour_amount }}</td>
                                    <td>${{ $item->total_amount }}</td>
                                    <td>
                                        @if($item->type=='1')
                                            Basic
                                        @elseif($item->type=='2')
                                            Profession
                                        @elseif($item->type=='3')
                                            Ultimate
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('tutor.packages.edit',$item->id) }}" type="button"  rel="tooltip" class="btn btn-info rounded-circle btn-round" title="Edit Package">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-href="{{ route('tutor.packages.delete',$item->id) }}" type="button"  rel="tooltip" class="btn btn-danger rounded-circle btn-round delete_package" title="Edit Package">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
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

        <!-- delete modal session -->
    <div class="modal fade rounded" id="deletePackageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Are you sure to delete ?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group col-12 mt-3">
                        <a href="" class="btn btn-primary w-100 rounded-sm delete_package_btn" type="submit">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- delete modal -->

@endsection
@section('js')

    <script>
        $(document).on("click",".delete_package",function(){
            $url=$(this).attr("data-href");
            $(".delete_package_btn").attr('href',$url);
            $("#deletePackageModal").modal("show");
        });
    </script>
    
@endsection
